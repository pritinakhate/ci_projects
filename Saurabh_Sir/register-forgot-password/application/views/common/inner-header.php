<?php 
	if(empty($this->session->userdata('id'))) 
	{
		redirect("Home/index");
	}
	$userstatuscheck = $this->Common_model->GetData("users","status","id='".$this->session->userdata('id')."'","","","","1");
	if($userstatuscheck->status == "Block"){
	$data = array(
					'page_title' => 'Login',
					'screen' => 'LOGIN SCREEN',
					'heading' => 'Guestbook',
					'action' => site_url('Home/login_action'),
					'loginheading' => 'Login',
					'login_button' => 'Login',
					'register_button' => 'Register',
					'register_button_action' => site_url('Home/signup'),
					'forgot_password_button' => 'Forgot Password',
					'forgot_password_button_action' => site_url('Home/forgot_password'),
					'massage'=> 'This user account has been blocked contact admin'					
				);
				session_destroy();
				$this->load->view('index',$data);
	}
	if($userstatuscheck->status == "Pending"){
	$data = array(
				'page_title' => 'Login',
				'screen' => 'LOGIN SCREEN',
				'heading' => 'Guestbook',
				'action' => site_url('Home/login_action'),
				'loginheading' => 'Login',
				'login_button' => 'Login',
				'register_button' => 'Register',
				'register_button_action' => site_url('Home/signup'),
				'forgot_password_button' => 'Forgot Password',
				'forgot_password_button_action' => site_url('Home/forgot_password'),
				'pendingwarn'=> 'This user account has been Pending'					
			);
			session_destroy();
			$this->load->view('index',$data);
	}
?> 
 <!-- Extraction of SEO -->
	<meta name="charset" content="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Integration of External Css file -->
	<link href="<?php echo base_url();?>assets/css/all.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
	<link href="<?php echo base_url();?>assets/css/toastr.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">