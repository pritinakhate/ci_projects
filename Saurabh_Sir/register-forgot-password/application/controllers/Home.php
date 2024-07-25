<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->library('user_agent');
	}

	
	public function index()
	{
		// before submit button get clicked
		 $data = array(
			'page_title' => 'Login',
			'screen' => 'LOGIN PANEL',
			'heading' => 'Guestbook',
			'action' => site_url('Home/login_action'),
			'loginheading' => 'Login',
			'login_button' => 'Login',
			'register_button' => 'Register',
			'register_button_action' => site_url('Home/signup'),
			'forgot_password_button' => 'Forgot Password',
			'forgot_password_button_action' => site_url('Home/forgot_password'),
			'email_address' => set_value('email_address',$this->input->post('email_address'))
		); 
		$this->load->view('login',$data);
	}
	public function login_action()
	{
		// after submit button get clicked
		$this->validate_login();
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
			//$this->load->view('index');
		}
		else
		{
			$email = $this->input->post("email_address",TRUE);
			$password = md5($this->input->post("password",TRUE));
			$checkemail = $this->Users_model->GetData("users","id,token,name,email_address,password,role,gender,status","email_address='".$email."'","","","","1");	
			if(empty($checkemail))
			{
				$this->session->set_flashdata('massage','Invalid Credentials');
				redirect('Home/index');
			}
			else
			{
				if($checkemail->password == $password)
				{
					if($checkemail->status == "Pending")
					{
						$this->session->set_flashdata('warn','Your account pending for approval');
						redirect('Home/index');
					}
					else if($checkemail->status == "Active")
					{
						$loguser = array(
							"user_id" => $checkemail->id,
							"user_login" =>date("Y-m-d H:i:s"),
							"ip_address"=>$_SERVER['REMOTE_ADDR'],
							// "access_details"=>$_SERVER['HTTP_USER_AGENT']
							 "access_details"=>$this->agent->browser().' '.$this->agent->version()
						);
						$this->Users_model->SaveData("user_access_logs",$loguser);
						$lastlog = array(
							"last_login" =>date("Y-m-d H:i:s"),
							"last_ip"=>$_SERVER['REMOTE_ADDR'],
							 "access_details"=>$this->agent->browser().' '.$this->agent->version()
						);
						$this->Users_model->savedata("users",$lastlog,"id ='".$checkemail->id."'");
						$sessiondata = array(
							"id" => $checkemail -> id, 
							"token" => $checkemail -> token, 
							"name" => $checkemail -> name, 
							"email_address" => $checkemail -> email_address,
							"role" => $checkemail -> role, 
							"gender"=>$checkemail->gender,							
							"status" => $checkemail -> status,
						);
						$this->session->set_userdata($sessiondata);
						redirect('Users/index');
					}
					else
					{
						$this->session->set_flashdata('massage','Your account has been blocked please contact admin');
						redirect('Home/index');
					}
				}
				else
				{
					$this->session->set_flashdata('massage','Incorrect password');
					redirect('Home/index');
				}
			}
		}			
	}
	public function logout()
	{
		$alluseraccesslog = $this->Users_model->GetData("user_access_logs","","user_id = '".$this->session->userdata('id')."'","user_login DESC","","","","");
		foreach($alluseraccesslog as $alluserlogs)
		{
			$data = array(
				'user_logout' => date('Y-m-d H:i:s'),
			);
			$this->Users_model->SaveData("user_access_logs",$data,"user_id = '".$this->session->userdata('id')."' and user_login = '".$alluserlogs->user_login."'");
			$array_item = array('id','token','name','email_address','role','gender','status');
			$this->session->unset_userdata($array_item);
			redirect('Home/index');
			session_destroy();
		}
	}
	public function autologout()
	{
		$getcreatedtime = $this->Users_model->GetData("user_access_logs","","user_logout Is Null","","","","");
		foreach($getcreatedtime as $getcreated){
			$current_time = strtotime(date('Y-m-d H:i:s'));
			$logouttime = strtotime(date('Y-m-d 23:58:00'));
			$created = strtotime($getcreated->created);
			$time_difference = $current_time  - $created;
			$seconds = $time_difference;
			$hour = round($seconds/3600);
			if($hour > 12 && $created < $logouttime)
			{ 
				$date = date('Y-m-d');
				$data = array(
					'user_logout' => date('Y-m-d H:i:s')
				);
				$this->Users_model->SaveData("user_access_logs",$data,"user_logout Is NULL");
				$array_item = array('id','token','name','email_address','role','gender','status');
				$this->session->unset_userdata($array_item);
				redirect('Home/index');
				session_destroy(); 
			}
		}
		echo "1";
	} 
	public function signup()
	{
		$data = array(
			'page_title' => 'Signup',
			'screen' => 'SIGNUP SCREEN',
			'heading' => 'Guestbook',
			'action' => site_url('Home/signup_action'),
			'signupheading' => 'Signup',
			'signup_button' => 'Signup',
			'cancel' => 'Back to Login',
			'cancel_action' => site_url('Home/index'),
			'name' => ucwords($this->input->post('name',TRUE)),
			'email_address' => $this->input->post('email_address',TRUE)
		);
		// before submit button get clicked
		$this->load->view('signup',$data);
	}
	public function signup_action()
	{
		$this->validate_signup();
		if ($this->form_validation->run() == FALSE)
		{
			$this->signup();
		}
		else
		{
			$data = array(
				'token' => md5('Users-token'.time().rand(1000,9999)),
				'name' => ucwords($this->input->post('name',TRUE)),
				'email_address' => strtolower($this->input->post('email_address',TRUE)),
				'password' => md5($this->input->post('password',TRUE))
			);
			$this->Users_model->SaveData('users',$data);
			$this->session->set_flashdata('massage','Account added successfully');
			redirect('Home/signup');
		}
	}
	public function forgot_password()
	{
		// after submit button get clicked
		$data = array(
			'page_title' => 'Forgot Password',
			'screen' => 'FORGOT PASSWORD SCREEN',
			'heading' => 'Guestbook',
			'action' => site_url('Home/forgot_password_action'),
			'forgotpasswordheading' => 'Forgot Password',
			'button' => 'Submit',
			'cancel' => 'Back to Login',
			'cancel_action' => site_url('Home/index'),
			'email_address' => set_value('email_address',$this->input->post('email_address'))
		);
		$this->load->view('forgot-password',$data);	
	}
	public function forgot_password_action()
	{
		// after submit button get clicked
		$this->validate_forgot();
		if ($this->form_validation->run() == FALSE)
		{
			$this->forgot_password();
		}
		else
		{ 
			$checkemail = $this->Users_model->GetData("users","email_address,status","email_address = '".$this->input->post('email_address')."'","","","","1");
			if(!empty($checkemail->email_address) && ($checkemail->email_address = $this->input->post('email_address')))
			{
				if($checkemail->status=="Active" || $checkemail->status=="Pending")
				{
					$data = array(
						'token_link' => md5("token_link".$checkemail->email_address.rand(0000,9999)),
						'token_created'=> date('Y-m-d H:i:s')
					);
					$this->Users_model->SaveData("users",$data,"email_address='".$checkemail->email_address."'");
					redirect('Home/linkpage/'.base64_encode($checkemail->email_address));
				}
				else if($checkemail->status=="Block")
				{
					$data = array(
							'massage'=> 'Your account has been blocked',
							'page_title' => 'Forgot Password',
							'screen' => 'FORGOT PASSWORD SCREEN',
							'heading' => 'Guestbook',
							'action' => site_url('Home/forgot_password_action'),
							'forgotpasswordheading' => 'Forgot Password',
							'button' => 'Submit',
							'cancel' => 'Back to Login',
							'cancel_action' => site_url('Home/index'),
							'email_address' => set_value('email_address',$this->input->post('email_address',TRUE))
							);
							$this->load->view('forgot-password',$data);
					
				}
			}
			else
			{
				$data = array(
					'massage'=> 'Please enter valid email address',
					'page_title' => 'Forgot Password',
					'screen' => 'FORGOT PASSWORD SCREEN',
					'heading' => 'Guestbook',
					'action' => site_url('Home/forgot_password_action'),
					'forgotpasswordheading' => 'Forgot Password',
					'button' => 'Submit',
					'cancel' => 'Back to Login',
					'cancel_action' => site_url('Home/index'),
					'email_address' => set_value('email_address',$this->input->post('email_address',TRUE))
					);
					$this->load->view('forgot-password',$data);
					//redirect('Home/forgot_password');	
			}
		}
	}
	public function linkpage($email)
	{
		$checktoken = $this->Users_model->GetData("users","token_link","email_address='".base64_decode($email)."'","","","","1");
		if(!empty($checktoken->token_link))
		{
			$data =  
					array(
							'page_title' => 'Forgot Password',
							'screen' => 'FORGOT PASSWORD SCREEN',
							'heading' => 'Guestbook',
							'forgotpasswordheading' => 'Forgot Password',
							'link_action' => site_url('Home/changenewpassword/'.base64_encode($checktoken->token_link)),
							'cancel' => 'Back to Login',
							'cancel_action' => site_url('Home/index'),
						 ); 
						$this->load->view("forgotpasswordlinkpage",$data);
		}
		else
		{
			$data = array(
					'massage'=> 'This link has been expired.',
					'page_title' => 'Forgot Password',
					'screen' => 'FORGOT PASSWORD SCREEN',
					'heading' => 'Guestbook',
					'action' => site_url('Home/forgot_password_action'),
					'forgotpasswordheading' => 'Forgot Password',
					'button' => 'Submit',
					'cancel' => 'Back to Login',
					'cancel_action' => site_url('Home/index'),
					'email_address' => set_value('email_address',$this->input->post('email_address',TRUE))
					);
					$this->load->view('forgot-password',$data);
		}
	}
	public function changenewpassword($tokenlink)
	{
		$checktoken = $this->Users_model->GetData("users","token_link","token_link='".base64_decode($tokenlink)."'","","","","1");
		if(!empty($checktoken->token_link))
		{
			$data = array(
				'page_title' => 'Forgot Password',
				'heading' => 'Guestbook',
				'screen' => 'FORGOT PASSWORD SCREEN',
				'action' => site_url('Home/changenewpassword_action/'.$tokenlink),
				'forgotpasswordheading' => 'Forgot Password',
				'button' => 'Submit',
				'cancel' => 'Back',
				'cancel_action' => site_url('Home/forgot_password'),
				);
				$this->load->view('newconfirmpassword',$data);
		}
		else
		{
			$data = array(
					'massage'=> 'This link has been expired.',
					'page_title' => 'Forgot Password',
					'screen' => 'FORGOT PASSWORD SCREEN',
					'heading' => 'Guestbook',
					'action' => site_url('Home/forgot_password_action'),
					'forgotpasswordheading' => 'Forgot Password',
					'button' => 'Submit',
					'cancel' => 'Back to Login',
					'cancel_action' => site_url('Home/index'),
					'email_address' => set_value('email_address',$this->input->post('email_address',TRUE))
					);
					$this->load->view('forgot-password',$data);
		}
		
	}
	public function changenewpassword_action($tokenlink)
	{
		$this->validate_newforgot();
		if ($this->form_validation->run() == FALSE)
		{
			$this->changenewpassword($tokenlink);
		}
		else
		{ 
			$checkpass = $this->Users_model->GetData("users","password","token_link='".base64_decode($tokenlink)."'","","","","1");
			if(md5($this->input->post('password')) == $checkpass->password)
			{
				$fortokenexpired = $this->Users_model->GetData("users","email_address","token_link='".base64_decode($tokenlink)."'","","","","1");
				$tokenexired = array(
					'token_link' => ""
				);
				$this->Users_model->SaveData("users",$tokenexired,"email_address='".$fortokenexpired->email_address."'");
				$data =array(
					'massage' => "This Password already Saved",
					'page_title' => 'Forgot Password',
					'screen' => 'FORGOT PASSWORD SCREEN',
					'heading' => 'Guestbook',
					'action' => site_url('Home/forgot_password_action'),
					'forgotpasswordheading' => 'Forgot Password',
					'button' => 'Submit',
					'cancel' => 'Back to Login',
					'cancel_action' => site_url('Home/index'),
					'email_address' => set_value('email_address',$this->input->post('email_address',TRUE))
				);
				$this->load->view('forgot-password',$data);
			}
			else
			{
				if($this->input->post('password') == $this->input->post('repeatpassword')){
					$data = array(
						'password' => md5($this->input->post('password',TRUE))
					);
					$fortokenexpired = $this->Users_model->GetData("users","email_address","token_link='".base64_decode($tokenlink)."'","","","","1");
					$this->Users_model->SaveData("users",$data,"token_link='".base64_decode($tokenlink)."'");
					$tokenexired = array(
						'token_link' => "",
						'token_created ' => date("00:00:00"),
					);
					//print_r($tokenexired); exit();
					$this->Users_model->SaveData("users",$tokenexired,"email_address='".$fortokenexpired->email_address."'");
					$this->session->set_flashdata('save','Password saved successfully.');
					redirect('Home/index');		
				}
				else
				{
					$this->session->set_flashdata('massage','New password not matched with confirm password');
					redirect('Home/changenewpassword/'.$tokenlink);
				}
			}
		}
	}
	public function linktokenexpire()
	{
		$tokentime = $this->Users_model->GetData("users","token_link,email_address,token_created","token_link != ''","","","","");
		foreach($tokentime as $checktokentime)
		{ 
			$current_time = strtotime(date('H:i:s'));
			$tokencreated = strtotime($checktokentime->token_created);
			$time_difference = $current_time  - $tokencreated;
			$seconds = $time_difference;
			$minutes = round($seconds/60);
			if($minutes > 10 && !empty($checktokentime->email_address) && !empty($checktokentime->token_link)){
			$data = array(
				'token_link' => '',
			);
			$this->Users_model->SaveData("users",$data,"email_address='".$checktokentime->email_address."'");
			}
		 } 
		echo "1";
	}
	/* ==========================================
		All Validation Function Forgot
		1. Signup ============> (view/signup.php)
		2. Login =============> (view/index.php)
		3. Forgot Password ===> (view/forgot-password.php)
	   ==========================================	*/
	public function validate_signup()
	{
		$this->form_validation->set_rules('name','Name','required|regex_match[/^[a-zA-Z- ]*$/]');
		$this->form_validation->set_rules('email_address','Email Address','required|valid_email|is_unique[users.email_address]');
		$this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[16]' );
		$this->form_validation->set_rules('repeatpassword','Repeat Password','required|min_length[8]|max_length[16]|matches[password]');
		$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
	}
	public function validate_login()
	{
		$this->form_validation->set_rules('email_address','Email Address','required|valid_email');
		$this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[16]' );
		$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
	}
	public function validate_forgot()
	{
		$this->form_validation->set_rules('email_address','Email Address','required|valid_email');
		$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
	}
	public function validate_newforgot()
	{
		$this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[16]' );
		$this->form_validation->set_rules('repeatpassword','Repeat Password','required|min_length[8]|max_length[16]|matches[password]');
		$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
	}
}
?>
