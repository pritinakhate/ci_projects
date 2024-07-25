<?php

class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('Admin_model');
     
    }

    

    public function admin1(){

        $this->load->view("loginadmin");
    }

    public function admin_action(){

        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required') ;
        if($this->form_validation->run() == FALSE){
            $this->load->view('loginadmin');
        }else{
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $getall = $this->Admin_model->getdata("admins", "", "email='".$email."'", "", "1");
            
            if(empty($getall)){
                $this->session->set_flashdata('error', 'Invalid credentials');
                redirect('admin_controller/adminlogin');
            }else{
                // Assuming $getall returns only one row as per the query
                $admin = $getall[0];

                if($admin->password == $password){
                    $data = array(
                        'id' => $admin->id,
                        'name' => $admin->name,
                        'email' => $admin->email,
                        'gender' => $admin->gender,
                        'status' => $admin->status
                    );

                    $this->session->set_userdata($data);
                    redirect('welcome/admin');
                }else{
                    $this->session->set_flashdata('error', 'Invalid Password');
                    redirect('admin_controller/adminlogin');
                }
            }
        }
    
    }
    
}

?>