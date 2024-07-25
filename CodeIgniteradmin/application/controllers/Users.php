<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('User');
        $this->load->model('Login_model');
        $this->load->database();
        //$this->load->library('database');


    }
    public function userlist()
    {
        $this->load->view('userlist');
    }

    public function guestlist()
    {
        $this->load->view('guestlist');
    }
    // Create guest
    public function create()
    {
        $this->load->view('create');
    }


    public function create_action()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|alpha|is_unique[guests.name]');
        $this->form_validation->set_rules('mobile', 'mobile', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[guests.email]');
        //$this->form_validation->set_rules('image','Image','required');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[10]');
        $this->form_validation->set_rules('dob', 'DOB', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('hobby[]', 'Hobby', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_message('is_unique', 'The {field} is already eists.');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('create');
        } else {

            //image uplode
            $image = '';

            if ($_FILES['image']['error'] == 0) {

                $config['upload_path'] = "./uploads/guest_images";
                $config['allowed_types'] = "gif|jpg|png|jpeg|pdf";
                $config['max_size'] = "2048"; //2MB size of image
                $config['max_height'] = "102422";
                $config['max_width'] = "768222";

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->session->set_flashdata('error', 'Unable to upload image');
                } else {
                    $data = array('image' => $this->upload->data());
                    $image = $data['image']['file_name'];
                }
            }

            $hobby = $this->input->post('hobby[]');
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'dob' => $this->input->post('dob'),
                'password' => md5($this->input->post('password')),
                'address' => $this->input->post('address'),
                'gender' => $this->input->post('gender'),
                'hobby' => implode(',', $hobby),
                'user_id' => $this->session->userdata('id'),
                'image' => $image,
            );

            $this->User->add_guest($data);

            $this->session->set_flashdata('success', 'Guest detail successfully inserted');
            redirect('Users/create');
        }
    }

    //delete guest


    public function deleteguest($id)
    {

        $delete1 = $this->User->getdata("guests", "", "id='" . $id . "'", "", "1");

        // Assuming $delete1 is an object of stdClass
        $image = $delete1->image;

        if ($this->User->deleterecords($id)) {

            if (file_exists("./uploads/guest_images/" . $image)) {
                unlink("./uploads/guest_images/" . $image);
            }
            $this->session->set_flashdata('success', 'Guest deleted successfully.');
        }
        redirect(site_url('Users/guestdata'));
    }



    //fetch guests data in table


    public function guestdata()
    {
        $user_id = $this->session->userdata('id');

        $data['guest'] = $this->User->guestdata1('guests', '', 'Guest', '', 0, $user_id);



        $this->load->view('guestlist', $data);
    }


    //update guests

    public function updateguest($id)
    {
        $dataguest['id'] = $id;
        $dataguest['guest'] = $this->User->updatefetch($id);
        $this->load->view('update', $dataguest);
    }

    public function update_action()
    {

        $id = $this->input->post("id");

        //set validation
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required');
        //$this->form_validation->set_rules('image','Image','required');
        $this->form_validation->set_rules('dob', 'DOB', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('hobby[]', 'Hobby', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_message('is_unique', 'The {field} is already eists.');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('update');
        } else {

            // update image
            $guest = $this->User->updatefetch($id);
            $old_image = $guest['image'];

            if ($_FILES['image']['error'] == 0) {

                $config['upload_path'] = "./uploads/guest_images";
                $config['allowed_types'] = "gif|jpg|png|jpeg|pdf";
                $config['max_size'] = "204812"; //2MB size of image
                $config['max_height'] = "102422";
                $config['max_width'] = "768222";

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->session->set_flashdata('error', 'Unable to upload image');
                } else {
                    if (file_exists('./uploads/guest_images/' . $old_image)) {
                        unlink('./uploads/guest_images/' . $old_image);
                    }
                    $data = array('image' => $this->upload->data());
                    $image = $data['image']['file_name'];
                }
            } else {
                $image = $old_image;
            }

            $hobby = $this->input->post('hobby[]');
            $guestdata = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'dob' => $this->input->post('dob'),
                'address' => $this->input->post('address'),
                'gender' => $this->input->post('gender'),
                'hobby' => implode(',', $hobby),
                'image' => $image,
            );

            if ($this->User->updateguest($guestdata, $id)) {
                $this->session->set_flashdata('success', 'Guest detail successfully updated');
                redirect(site_url('Users/guestdata'));
            } else {
                $this->session->set_flashdata('error', 'Guest can not be updated');
            }
        }
    }

    //update users

    public function updateuser($id)
    {
        $datauser['id'] = $id;
        $datauser['user'] = $this->User->userfetch($id);
        $this->load->view('updateuser', $datauser);
    }

    public function userupdate_action()
    {

        $id = $this->input->post("id");

        //set validation
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required');
        //$this->form_validation->set_rules('image','Image','required');
        $this->form_validation->set_rules('dob', 'DOB', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('hobby[]', 'Hobby', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_message('is_unique', 'The {field} is already eists.');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('updateuser');
        } else {

            // update image
            $user = $this->User->userfetch($id);
            $old_image = $user['image'];

            if ($_FILES['image']['error'] == 0) {

                $config['upload_path'] = "./uploads/user_images";
                $config['allowed_types'] = "gif|jpg|png|jpeg|pdf";
                $config['max_size'] = "204812"; //2MB size of image
                $config['max_height'] = "102422";
                $config['max_width'] = "768222";

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->session->set_flashdata('error', 'Unable to upload image');
                } else {
                    if (file_exists('./uploads/user_images/' . $old_image)) {
                        unlink(('./uploads/user_images/' . $old_image));
                    }
                    $data = array('image' => $this->upload->data());
                    $image = $data['image']['file_name'];
                }
            } else {
                $image = $old_image;
            }
            $hobby = $this->input->post('hobby[]');
            $insertuser = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'dob' => $this->input->post('dob'),
                'address' => $this->input->post('address'),
                'gender' => $this->input->post('gender'),
                'hobby' => implode(',', $hobby),
                'image' => $image,
            );

            if ($this->User->updateuser($insertuser, $id)) {
                $this->session->set_flashdata('success', 'user detail successfully updated');
                redirect(site_url('Login/all_data'));
            } else {
                $this->session->set_flashdata('error', 'user can not be updated');
            }
        }
    }

    //user delete

    public function deleteuser($id)
    {

        $delete2 = $this->User->getdata("users", "", "id='" . $id . "'", "", "1");

        // Assuming $delete1 is an object of stdClass
        $images = $delete2->image;

        if ($this->User->deleterecorduser($id)) {

            if (file_exists("./uploads/user_images/" . $images)) {
                unlink("./uploads/user_images/" . $images);
            }
            $this->session->set_flashdata('success', 'User deleted successfully.');
        }
        redirect(site_url('Login/all_data'));
    }
    //Guest View
    public function viewguest($id)
    {

        $view_data['guest_data'] = $this->User->viewfetch($id);
        $this->load->view('view_guest', $view_data);
    }
    //userview
    public function viewuser($id)
    {

        $viewuser_data['user_data'] = $this->User->viewuserfetch($id);
        $this->load->view('view_user', $viewuser_data);
    }

    //change password

    public function change_password()
    {
        $this->load->view('change_password');
    }

    public function change_passworduser()
    {
        $this->load->view('change_passwordadmin');
    }

    //change password user
    public function update_password()
    {

        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('change_password');
        } else {

            $id = $this->session->userdata('id');
            $current_pass = $this->input->post('current_password');
            $new_pass = $this->input->post('new_password');
            $confirm_pass = $this->input->post('confirm_password');

            if ($current_pass != $new_pass) {
                if ($new_pass == $confirm_pass) {
                    $res = $this->User->check_password($id, $current_pass);

                    if ($res) {
                        $data = ['password' => $new_pass,];
                        $result = $this->User->update_password($id, $data);
                        if ($result) {

                            $this->session->set_flashdata('success', 'Password Updated successfully');
                            //redirect('Users/change_password');
                            redirect('Welcome/admin');
                        } else {
                            $this->session->set_flashdata('warning', 'Something went wrong, Please try again');
                            redirect('Users/change_password');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Current password is invalid');
                        redirect('Users/change_password');
                    }
                } else {
                    $this->session->set_flashdata('error', 'New password and confirm password does not match. ');
                    redirect('Users/change_password');
                }
            } else {
                $this->session->set_flashdata('error', 'You are entering same password');
                redirect('Users/change_password');
            }
        }
    }

    //change password admin
    public function update_passwordadmin()
    {

        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('change_password');
        } else {

            $id = $this->session->userdata('id');
            $current_pass = $this->input->post('current_password');
            $new_pass = $this->input->post('new_password');
            $confirm_pass = $this->input->post('confirm_password');

            if ($current_pass != $new_pass) {

                if ($new_pass == $confirm_pass) {
                    $res = $this->User->check_password($id, $current_pass);

                    if ($res) {
                        $data = ['password' => $new_pass,];
                        $result = $this->User->update_password($id, $data);
                        if ($result) {

                            $this->session->set_flashdata('success', 'Password Updated successfully');
                            //redirect('Users/change_password');
                            //redirect('Welcome/admin'); for user page
                            redirect('Welcome/admin');
                        } else {
                            $this->session->set_flashdata('warning', 'Something went wrong, Please try again');
                            redirect('Users/change_passwordadmin');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Current password is invalid');
                        redirect('Users/change_passwordadmin');
                    }
                } else {
                    $this->session->set_flashdata('error', 'New password and confirm password does not match. ');
                    redirect('Users/change_passwordadmin');
                }
            } else {
                $this->session->set_flashdata('error', 'You are entering same password');
                redirect('Users/change_password');
            }
        }
    }
    //account detail

    public function account_detail()
    {
        $this->load->view('account_detail');
    }

    public function account_detailuser()
    {
        $this->load->view('account_detailuser');
    }

    //staus  update

    public function update_status()
    {
        $id = $this->input->post('id');



        $user = $this->User->get_user($id);


        if ($user->status == 'Pending') {
            $data = array(
                'status' => 'Active',

            );
        } elseif ($user->status == 'Active') {
            $data = array(
                'status' => 'Block',
            );
        } elseif ($user->status == 'Block') {
            $data = array(
                'status' => 'Active',
            );
        }
        if ($this->User->update_status1($id, $data)) {
            //$this->session->set_flashdata('success','User status updated successfully.') --for without ajax
            $response = array('status' => 'success', 'new_status' => $data['status']);
        } else {
            //$this->session->set_flashdata('error','User status not updateding.') --for without ajax
            $response = array('status' => 'error');
        }
        echo json_encode($response);
    }
}