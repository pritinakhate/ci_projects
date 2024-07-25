<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('Login_model');
    }

    //login create
    public function userlogin()
    {
        $this->load->view('login');
    }


    //login validation
    public function login_action()
    {
        //login validation
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {


            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $getall = $this->Login_model->getdata("users", "", "email='" . $email . "'", "", "1");
            // print_r($getall);
            // exit;

            if (empty($getall)) {
                $this->session->set_flashdata('error', 'Invalid credentials');
                $this->load->view('login');
            } else {

                if ($getall->password == $password) {

                    if ($getall->status == "Active") {

                        if ($getall->role == "Admin") {

                            $data = array(
                                'id' => $getall->id,
                                'name' => $getall->name,
                                'image' => $getall->image,
                                'role' => $getall->role,
                                'email' => $getall->email,
                                'gender' => $getall->gender,
                                'hobby' => $getall->hobby,
                                'address' => $getall->address,
                                'mobile' => $getall->mobile,
                                'dob' => $getall->dob,
                                'status' => $getall->status,

                            );

                            $this->session->set_userdata($data);
                            redirect(site_url('Welcome/admin'));
                        } elseif ($getall->role == "User") {

                            $data = array(
                                'id' => $getall->id,
                                'name' => $getall->name,
                                'image' => $getall->image,
                                'role' => $getall->role,
                                'email' => $getall->email,
                                'gender' => $getall->gender,
                                'hobby' => $getall->hobby,
                                'address' => $getall->address,
                                'mobile' => $getall->mobile,
                                'status' => $getall->status,

                            );
                            $this->session->set_userdata($data);
                            redirect('welcome/admin');
                        } else {
                            redirect('');
                        }
                    } elseif ($getall->status == "Pending") {

                        $this->session->set_flashdata('warning', "Your Status is pending please contact to admin");
                        redirect('Login/userlogin');
                    } else {
                        $this->session->set_flashdata('error', "your account has been blocked please contact to admin");
                        redirect('Login/userlogin');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Invalid password');
                    redirect('Login/userlogin');
                }
            }
        }
    }



    //registraion create
    public function registration()
    {
        $this->load->view('registration');
    }


    //create user
    public function signup()
    {
        $this->load->view('signup');
    }

    public function createuser()
    {
        $this->load->view('createuser');
    }

    public function signup_action()
    {
        //registration validation

        $this->form_validation->set_rules('name', 'Full Name', 'required|alpha|is_unique[users.name]');
        $this->form_validation->set_rules('mobile', 'Mobile no.', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('dob', 'DOB', 'required');
        $this->form_validation->set_rules('hobby[]', 'Hobby', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        //$this->form_validation->set_rules('image','Image','required');
        $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[10]');
        $this->form_validation->set_rules('confirmpassword', 'Password', 'required|max_length[10]|matches[password]');
        $this->form_validation->set_message('is_unique', 'This {field} is already exists.');

        if ($this->form_validation->run() == false) {

            $this->load->view('signup');
            //Getting Post Values

        } else {
            $image_path = '';
            if ($_FILES['image']['error'] == 0) {
                // $config['file_name'] = date('YmdHis')
                $config['upload_path'] = "./uploads/user_images";
                $config['allowed_types'] = "gif|jpg|png|jpeg|pdf";
                $config['max_size'] = "2048"; // Can be set to particular file size , here it is 2 MB(2048 Kb)
                $config['max_height'] = "102422";
                $config['max_width'] = "768222";



                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->session->set_flashdata('error', 'Unable to uplaod image');
                } else {
                    $data = array('image' => $this->upload->data());
                    $image_path = $data['image']['file_name'];
                }
            }


            $hobby = $this->input->post('hobby[]');
            $resdata = array(
                'name' => $this->input->post('name'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'dob' => $this->input->post('dob'),
                'hobby' => implode(',', $hobby),
                'gender' => $this->input->post('gender'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'image' => $image_path,

            );



            //lode model
            $this->Login_model->signup($resdata);

            $this->session->set_flashdata('success', 'User created Successfully');
            redirect('Login/signup');
        }
    }


    //fetch data in table user
    public function all_data()
    {
        $data['user'] = $this->Login_model->getdata1('users', '', 'User', '', 0);


        $this->load->view('userlist', $data);
    }

    //delete record

    public function deleteuser($id)
    {
        if ($this->Login_model->deletedata($id)) {
            $this->session->set_flashdata('success', 'Guest deleted successfully.');
            redirect('Login/all_data');
        }
    }

    //End user

    public function logout()
    {

        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        return redirect(site_url('Login/userlogin'));
    }

    //forgate password

    public function forgate_password()
    {
        $this->load->view('forgate_password');
    }
    public function forgate_password_action()
    {

        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect('Users/forgate_password');
        } else {

            $email = $this->input->post('email');



            $checkmail = $this->Login_model->getdata("users", "", "email='" . $email . "'", "", "1");



            if ($checkmail->status == "Active" || $checkmail->status == "Pending") {

                $otp = rand(100000, 999999);

                $data = array(
                    'otp' => $otp,
                    // 'otp_created' => date('Y-m-d H:i:s')
                );

                $this->Login_model->savedata("users", $data, "email='" . $checkmail->email . "'");


                $subject = "Password Reset OTP";
                $message = "Your otp for password reset is : " . $otp;

                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_port' => '465',
                    'smtp_timeout' => '7',
                    'smtp_user' => 'pritinakhate96@gmail.com',
                    'smtp_pass' => 'reoxyothhabbrsue',
                    'charset' => 'utf-8',
                    'newline' => "\r\n",
                    'mailtype' => 'text',
                    'validation' => TRUE
                );
                $this->email->initialize($config);

                $this->load->library('email', $config);

                $this->email->from('pritinakhate96@gmail.com', 'Priti');
                $this->email->to($checkmail->email);
                $this->email->subject($subject);
                $this->email->message($message);


                if (!$this->email->send()) {
                    $error = $this->email->print_debugger(array('headers'));
                    echo $error;

                    log_message('error', $error);
                    $this->session->set_flashdata('error', 'Failed to set email. Please try again.');
                    $this->load->view('forgate_password');
                } else {
                    $this->session->set_flashdata('success', 'OTP has been send to your mail.');
                    redirect('Login/changenewpassword');
                    // $this->load->view('forgate_password');

                }
            } elseif ($checkmail->status == "Block") {
                $this->session->set_flashdata('error', 'User name is blocked');
                $this->load->view('forgate_password');
            }
        }
    }

    // public function varifiedotp()
    // {
    //     $this->form_validation->set_rules('email', 'Email', 'required');
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('changenewpassword');
    //     } else {

    //         $otp = $this->input->post('otp');

    //         $checkotp = $this->Login_model->getdata("Users", "otp,", "otp='" . $otp . "'", "", "1");

    //         if ($checkotp->otp == $otp) {
    //             $this->session->set_flashdata('success', 'OTP varified successfully');
    //         } else {
    //             $this->session->set_flashdata('error', 'Please enter valid otp');
    //             $this->load->view('changenewpassword');
    //         }
    //     }
    // }

    public function changenewpassword()
    {

        $this->load->view('changenewpassword');
    }

    public function changenewpassword_action()

    {
        $this->form_validation->set_rules('otp', 'OTP', 'required');
        $this->form_validation->set_rules('password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('changenewpassword');
        } else {
            $otp = $this->input->post('otp');
            $password = $this->input->post('password');
            $confirm = $this->input->post('confirm');

            $checkotp = $this->Login_model->getdata("Users", "otp,password", "otp='" . $otp . "'", "", "1");
            if ($checkotp->password != $password) {
                if ($checkotp->otp == $otp) {
                    if ($password == $confirm) {
                        $data = array(
                            'password' => $password,
                        );
                        $this->Login_model->savedata("Users", $data, "otp='" . $otp . "'");
                        $this->session->set_flashdata('success', 'Password change sucsessfully');

                        redirect('Login/userlogin');
                    } else {
                        $this->session->set_flashdata('error', 'Please enter valid confirm password');
                        $this->load->view('changenewpassword');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Please enter valid otp');
                    $this->load->view('changenewpassword');
                }
            } else {
                $this->session->set_flashdata('error', 'You are  entering same password');
                $this->load->view('changenewpassword');
            }
        }
    }
}
