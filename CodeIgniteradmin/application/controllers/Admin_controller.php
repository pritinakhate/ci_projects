<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('Admin_model');
    }

    public function adminlogin(){
        $this->load->view('loginadmin');
    }

    public function adminlogin_action(){
        //Admin validation
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run()==FALSE){
            $this->load->view('login');
        }else{
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $getall = $this->Admin_model->getdata("users","","email='".$email."'","","1");
            
            if(empty($getall)){
                $this->session->set_flashdata('error','invalid credentials');
                $this->load->view('login');
            }else{
                if($getall->password==$password){
                    $data=array(
                        'id' =>$getall->id,
                        'name'=>$getall->name,
                        'email' =>$getall->email,
                        'gender'=>$getall->gender,
                        'status'=>$getall->status,

                    );
                    $this->session->set_userdata($data);
                    redirect('Welcome/admin');
                }else{
                    $this->session->set_flashdata('error','Invalid Password.');
                    redirect('Welcome');
                }
            }
        }
    }

    public function logoutadmin(){
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        return redirect('Welcome');
    }
    
}
?>