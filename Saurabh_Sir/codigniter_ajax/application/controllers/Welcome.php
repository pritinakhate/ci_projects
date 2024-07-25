<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->view('jquery_ajax_with_form_method');
	}
	public function save() {
        // Check if file was uploaded successfully
        if ($_FILES['profile_image']['error'] == 0) {
            $file_name = time() . '_' . $_FILES['profile_image']['name'];
            $config['file_name'] = $file_name;
            $config['upload_path'] = 'uploads/profile_images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('profile_image')) {
                $response = array(
                    'status' => 'error',
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                return;
            } else {
                $upload_data = $this->upload->data();
                $profile_image = $upload_data['file_name'];
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error uploading file. Code: ' . $_FILES['profile_image']['error']
            );
            echo json_encode($response);
            return;
        }

        // Prepare data for insertion
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'email' => $this->input->post('email', TRUE),
            'mobile' => $this->input->post('mobile', TRUE),
            'country' => $this->input->post('country', TRUE),
            'state' => $this->input->post('state', TRUE),
            'city' => $this->input->post('city', TRUE),
            'gender' => $this->input->post('gender', TRUE),
            'hobbies' => implode(',', $this->input->post('hobbies', TRUE)),
            'profile_image' => $profile_image,
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        );

        // Save data to the database
        $result = $this->common_model->SaveData("user_profile",$data);

        // Send JSON response
        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => 'Profile saved successfully!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'There was a problem saving the profile. Please try again.'
            );
        }
        echo json_encode($response);
    }
    public function ajax_with_append_form()
    {
        $this->load->view('jquery_ajax_with_append_form_method');
    }
    public function ajax_with_append_form_action() {
        // Check if file was uploaded successfully
        if ($_FILES['profile_image']['error'] == 0) {
            $file_name = time() . '_' . $_FILES['profile_image']['name'];
            $config['file_name'] = $file_name;
            $config['upload_path'] = 'uploads/profile_images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('profile_image')) {
                $response = array(
                    'status' => 'error',
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                return;
            } else {
                $upload_data = $this->upload->data();
                $profile_image = $upload_data['file_name'];
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error uploading file. Code: ' . $_FILES['profile_image']['error']
            );
            echo json_encode($response);
            return;
        }

        // Prepare data for insertion
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'email' => $this->input->post('email', TRUE),
            'mobile' => $this->input->post('mobile', TRUE),
            'country' => $this->input->post('country', TRUE),
            'state' => $this->input->post('state', TRUE),
            'city' => $this->input->post('city', TRUE),
            'gender' => $this->input->post('gender', TRUE),
            'hobbies' => $this->input->post('hobbies', TRUE),
            'profile_image' => $profile_image,
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        );

        // Save data to the database
        $result = $this->common_model->SaveData("user_profile",$data);

        // Send JSON response
        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => 'Profile saved successfully!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'There was a problem saving the profile. Please try again.'
            );
        }
        echo json_encode($response);
    }
    public function jquery_ajax_with_post_form()
    {
        $this->load->view('jquery_ajax_with_post_form_method');
    }
    public function jquery_ajax_with_post_form_method_action() {
        // Check if file was uploaded successfully
        if ($_FILES['profile_image']['error'] == 0) {
            $file_name = time() . '_' . $_FILES['profile_image']['name'];
            $config['file_name'] = $file_name;
            $config['upload_path'] = 'uploads/profile_images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('profile_image')) {
                $response = array(
                    'status' => 'error',
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                return;
            } else {
                $upload_data = $this->upload->data();
                $profile_image = $upload_data['file_name'];
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error uploading file. Code: ' . $_FILES['profile_image']['error']
            );
            echo json_encode($response);
            return;
        }

        // Prepare data for insertion
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'email' => $this->input->post('email', TRUE),
            'mobile' => $this->input->post('mobile', TRUE),
            'country' => $this->input->post('country', TRUE),
            'state' => $this->input->post('state', TRUE),
            'city' => $this->input->post('city', TRUE),
            'gender' => $this->input->post('gender', TRUE),
            'hobbies' => implode(',', $this->input->post('hobbies', TRUE)),
            'profile_image' => $profile_image,
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        );

        // Save data to the database
        $result = $this->common_model->SaveData("user_profile",$data);

        // Send JSON response
        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => 'Profile saved successfully!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'There was a problem saving the profile. Please try again.'
            );
        }
        echo json_encode($response);
    }
    public function jquery_ajax_with_get_form()
    {
        $this->load->view('jquery_ajax_with_get_form_method');
    }
    public function jquery_ajax_with_get_form_method_action() {
        $name = $this->input->get('name', TRUE);
        $email = $this->input->get('email', TRUE);
        $mobile = $this->input->get('mobile', TRUE);
        $country = $this->input->get('country', TRUE);
        $state = $this->input->get('state', TRUE);
        $city = $this->input->get('city', TRUE);
        $gender = $this->input->get('gender', TRUE);
        $hobbies = $this->input->get('hobbies', TRUE);

        $data = array(
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'gender' => $gender,
            'hobbies' => implode(',', $hobbies),
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        );

        // Save data to the database
        $result = $this->common_model->SaveData("user_profile", $data);

        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => 'Profile saved successfully!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'There was a problem saving the profile. Please try again.'
            );
        }
        echo json_encode($response);
    }
    public function jquery_ajax_with_single_userobject() {
        // Fetch user data by ID
        $this->load->view('jquery_ajax_with_single_userobject');
    }
    public function jquery_ajax_with_single_userobject_action($id) {
        // Fetch user data by ID
        $getUser = $this->common_model->GetData("user_profile","","id='".$id."'","","","","1");

        // Check if user data is found
        if ($getUser) {
            $response = array(
                'status' => 'success',
                'data' => $getUser
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'User not found'
            );
        }

        // Send JSON response
        echo json_encode($response);
    }
    public function jquery_ajax_with_all_user() {
            // Fetch user data by ID
            $this->load->view('jquery_ajax_with_all_user');
    }
    public function jquery_ajax_with_all_user_action() {
        // Fetch user data by ID
            $getUser = $this->common_model->GetData("user_profile","","","","","","");

            // Check if user data is found
            if ($getUser) {
                $response = array(
                    'status' => 'success',
                    'data' => $getUser
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'User not found'
                );
            }

            // Send JSON response
            echo json_encode($response);
    }
}
