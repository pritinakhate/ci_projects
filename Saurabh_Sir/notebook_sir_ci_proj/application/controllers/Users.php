<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
	}
	public function index()
	{

		$maleguest = $this->Users_model->GetData("guests","","user_id='".$this->session->userdata('id')."' and gender='Male'","created DESC","","5","");
		
		$femaleguest = $this->Users_model->GetData("guests","","user_id='".$this->session->userdata('id')."' and gender='Female'","created DESC","","5","");
		
		$activeusers = $this->Users_model->GetData("users","","role='Admin' and status='Active'","created DESC","","5","");
		$blockusers = $this->Users_model->GetData("users","","role='User' and status='Block'","created DESC","","5","");
		$pendingusers = $this->Users_model->GetData("users","","role='User' and status='Pending'","created DESC","","5","");
		//Guest chart count
		$totalguestschart = '';
		$monthcount = 12;
		for($i=1; $i<=$monthcount; $i++)
		{
			$gettotalguestschart = $this->Users_model->GetData("guests","count(id) as totalguests","month(created) = '".$i."' and year(created) = '".date('Y')."' and user_id='".$this->session->userdata('id')."'","","","","1");
			$totalguestschart .= $gettotalguestschart->totalguests;
			if($i<=$monthcount - 1)
			{
				$totalguestschart .= ", ";
			}
		}
		$maleguestchart ='';
		for($j=1; $j<=$monthcount; $j++)
		{
			$getmaleguestchart = $this->Users_model->GetData("guests","count(id) as maleguests","month(created) = '".$j."' and year(created) = '".date('Y')."' and gender='Male' and user_id='".$this->session->userdata('id')."'","","","","1");
			$maleguestchart .= $getmaleguestchart->maleguests;
			if($j<=$monthcount - 1)
			{
				$maleguestchart .= ", ";
			}
		}
		$femaleguestchart ='';
		for($k=1; $k<=$monthcount; $k++)
		{
			$getfemaleguestschart = $this->Users_model->GetData("guests","count(id) as femaleguests","month(created) = '".$k."' and year(created) = '".date('Y')."' and gender='female' and user_id='".$this->session->userdata('id')."'","","","","1");
			$femaleguestchart .= $getfemaleguestschart->femaleguests;
			if($k<=$monthcount - 1)
			{
				$femaleguestchart .= ", ";
			}
		}
		//User Chart count
		$totaluserchart= '';
		for($a=1; $a<=$monthcount; $a++)
		{
			$gettotaluserchart = $this->Users_model->GetData("users","count(id) as totaluser","month(created)='".$a."' and year(created) = '".date('Y')."' and role='User'","","","","1");
			$totaluserchart .= $gettotaluserchart -> totaluser;
			if($a<=$monthcount - 1)
			{
				$totaluserchart .= ", ";
			}
		}
		$activeuserchart= '';
		for($b=1; $b<=$monthcount; $b++)
		{
			$getactiveuserchart = $this->Users_model->GetData("users","count(id) as activeuser","month(created)='".$b."' and year(created) = '".date('Y')."' and role='Admin' and status='Active'","","","","1");
			$activeuserchart .= $getactiveuserchart -> activeuser;
			if($b<=$monthcount - 1)
			{
				$activeuserchart .= ", ";
			}
		}
		$blockuserchart= '';
		for($c=1; $c<=$monthcount; $c++)
		{
			$getblockuserchart = $this->Users_model->GetData("users","count(id) as aciveuser","month(created)='".$c."' and year(created) = '".date('Y')."' and role='User' and status='Block'","","","","1");
			$blockuserchart .= $getblockuserchart -> aciveuser;
			if($c<=$monthcount - 1)
			{
				$blockuserchart .= ", ";
			}
		}
		$pendinguserchart= '';
		for($d=1; $d<=$monthcount; $d++)
		{
			$getpendinguserchart = $this->Users_model->GetData("users","count(id) as pendinguser","month(created)='".$d."' and year(created) = '".date('Y')."' and role='User' and status='Pending'","","","","1");
			$pendinguserchart .= $getpendinguserchart -> pendinguser;
			if($d<=$monthcount - 1)
			{
				$pendinguserchart .= ", ";
			}
		}
		// After Login User
		$data = array(
			'page_title' => 'Dashboard',
			'heading' => 'Guestbook',
			'screen' => 'DASHBOARD',
			'totalguests' => $this->Users_model->GetTotalguests(),
			'maleguests' => $this->Users_model->GetMaleguests(),
			'femaleguests' => $this->Users_model->GetFemaleguests(),
			'totalusers' => $this->Users_model->TotalUsers(),
			'maleguest'=>$maleguest,
			'femaleguest'=>$femaleguest,
			'activeusers'=>$activeusers,
			'blockusers'=>$blockusers,
			'pendingusers'=>$pendingusers,
			'totalguestchart' => $totalguestschart,
			'maleguestchart' => $maleguestchart,
			'femaleguestchart' => $femaleguestchart,
			'totaluserchart' => $totaluserchart,
			'activeuserchart' => $activeuserchart,
			'blockuserchart' => $blockuserchart,
			'pendinguserchart' => $pendinguserchart,
		);
		$this->load->view('users/index',$data);
	}
	public function users_manage()
	{
		$allusers = $this->Users_model->GetData("users","","role='User'","","","","");	
		$data=array(
			'allusers'=>$allusers,
			'page_title' => 'Manage-Users',
			'heading' => 'Guestbook',
			'screen' => 'MANAGE USERS',
			'records' => 'User Records',
			'action' => site_url('Users/users_deleteall_action'),
			'export' => 'Export',
			'export_action'=> site_url('Users/export')
		);
		$this->load->view('users/user_manage',$data);
	}	
	public function users_view($id)
	{
		//call view.php with data against id/token
		$userdata = $this->Users_model->GetData("users","name,email_address,dob,gender,photo,role,status","token ='".base64_decode($id)."'","","","","");
		if(empty($userdata))
		{
			redirect('Users/users_manage');
		}
		else
		{
			$data = array(
				'page_title' => 'View User',
				'heading' => ' Guestbook',
				'screen' => 'VIEW USER',
				'records' => 'User Detail',
				'cancel' => 'Back',
				'cancel_action' => site_url('Users/users_manage'),
				'userdata' => $userdata
			);
			$this->load->view('users/view',$data);
		}
	}
	public function users_update($id)
	{
		$getusersdata = $this->Users_model->GetData("users","","token ='".base64_decode($id)."'","","","","single");
		if(!empty($getusersdata))
		{
			$data = array(
				'page_title' => 'Update- Manage-Users',
				'heading' => ' Guestbook',
				'record' => 'Update User',
				'button' => 'Update',
				'action' => site_url('Users/users_update_action/'.$id),
				'cancel' => 'Cancel',
				'cancel_action' => site_url('Users/users_manage'), 
				'name' => set_value('name',$getusersdata->name),
				'email_address' => set_value('email_address',$getusersdata->email_address),
				'dob' => set_value('dob',$getusersdata->dob),
				'gender' => set_value('gender',$getusersdata->gender),
				'photo' => set_value('photo',$getusersdata->photo),
				'status' => set_value('status',$getusersdata->status),
			);
			$this->load->view('users/users_update_form',$data);
		}
		else
		{
			redirect("Users/users_manage");
		}
	}
	public function users_update_action($id)
	{
		if(isset($_POST) && !empty($_POST))
		{
			$this->validate_users();
			if($this->form_validation->run()==FALSE)
			{
				$this->users_update($id);
			}
			else
			{
				if($_FILES['photo']['error']==0){
					$config['file_name'] = $_FILES['photo']['name'];
					$config['encrypt_name'] = TRUE;
					$config['upload_path'] = 'uploads/users_photo';
					$config['allowed_types'] = 'jpeg|jpg|png';
					$config['max_size']	= '100';
					$config['max_width']  = '500';
					$config['max_height']  = '500';
					$config['remove_spaces']  = TRUE;
					$config['is_image']  = 1;
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('photo'))
					{
						$this->session->set_flashdata('error',$this->upload->display_errors());
						redirect("Users/users_update/".$id);
					}
					else
					{
						$getuserphoto = $this->Users_model->GetData("users","id,photo","token='".base64_decode($id)."'","","","","1");
						$new_photo = $this->upload->data('file_name');
						unlink("uploads/users_photo/".$getuserphoto->photo);
					}
				}
				else
				{
					$new_photo = $this->input->post("old_photo",TRUE);
				}

				$data = array(
					"name"=>ucwords($this->input->post("name",TRUE)),
					"email_address"=>$this->input->post("email_address",TRUE),
					"dob"=>date("Y-m-d",strtotime($this->input->post("dob",TRUE))),
					"gender"=>$this->input->post("gender",TRUE),
					"photo"=>$new_photo,					
					"status"=>$this->input->post("status",TRUE),			
				);
				$this->Users_model->SaveData('users',$data,"token='".base64_decode($id)."'");
				$this->session->set_flashdata('success',"User has been updated successfully");
				redirect("users/users_manage");	
			}
		}
		else
		{
			redirect("Users/users_update/".$id);
		}
	}
	public function users_delete($id)
	{
		// Fetch attachment from table against id/token
		$getuser = $this->Users_model->GetData("users","id,photo","token='".base64_decode($id)."'","","","","1");
		$photo = $getuser->photo;
		//If record found or not
		if(empty($getuser))
		{
			redirect('Users/users_manage');
		}
		else
		{
			
			if(!empty($photo))
			{ 
				//Remove record from table
				$this->Users_model->DeleteData("users","id ='".$getuser->id."'");
				// Remove attachment from folder 
				unlink("uploads/users_photo/".$photo);
				$this->session->set_flashdata('error','User record has been deleted successfully');
				redirect('Users/users_manage');
			}
			else
			{
				//Remove record from table
				$this->Users_model->DeleteData("users","id ='".$getuser->id."'");
				$this->session->set_flashdata('error','User record has been deleted successfully');
				redirect('Users/users_manage');
			} 
		}
	}
	public function users_deleteall_action()
	{
		if(isset($_POST['deleteall']))
		{
			if(!empty($this->input->post('selector')))
			{
				$token = $this->input->post('selector');
				if(!empty($token))
				{	$del=0;
					for($i=0;$i<count($token);$i++)
					{
						$getalluser=$this->Users_model->GetData("users","id,photo","token='".base64_decode($token[$i])."'","","","","");
						foreach($getalluser as $getuser)
						{
							$this->Users_model->DeleteData("users","id ='".$getuser->id."'");
							unlink("uploads/users_photo/".$getuser->photo);
						}
						$del++;
					}  
				}
				$massage= $del." User record has been deleted successfully";
				$this->session->set_flashdata('error',$massage);
				redirect('Users/users_manage');
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect('Users/users_manage');
			}
		}
	}
	public function profile($token)
	{
		$getuserdata = $this->Users_model->GetData("users","name,email_address,dob,gender,photo","token ='".base64_decode($token)."'","","","","1");
		if(!empty($getuserdata))
		{
			$data = array(
				'page_title' => 'Profile',
				'heading' => ' Guestbook',
				'record' => 'Update Profile',
				'button' => 'Update',
				'action' => site_url('Users/profile_action/'.$token),
				'cancel' => 'Cancel',
				'cancel_action' => site_url('Users/index'), 
				'name' => set_value('name',$getuserdata->name),
				'email_address' => set_value('email_address',$getuserdata->email_address),
				'dob' => set_value('dob',$getuserdata->dob),
				'gender' => set_value('gender',$getuserdata->gender),
				'photo' => set_value('photo',$getuserdata->photo),
			);
			$this->load->view('users/profile',$data);
		}
		else
		{
			redirect('Users/index');
		}
	}
	public function profile_action($id)
	{
		if(isset($_POST) && !empty($_POST))
		{
			$this->validate_profile();
			if($this->form_validation->run()==FALSE)
			{
				$this->profile($id);
			}
			else
			{
				if($_FILES['photo']['error']==0){
					$config['file_name'] = $_FILES['photo']['name'];
					$config['encrypt_name'] = TRUE;
					$config['upload_path'] = 'uploads/users_photo';
					$config['allowed_types'] = 'jpeg|jpg|png';
					// $config['max_size']	= '100';
					// $config['max_width']  = '500';
					// $config['max_height']  = '500';
					$config['remove_spaces']  = TRUE;
					$config['is_image']  = 1;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('photo'))
					{
						$this->session->set_flashdata('error',$this->upload->display_errors());
						redirect("Users/profile/".$id);
					}
					else
					{
						$getprofilephoto = $this->Users_model->GetData("users","","token ='".base64_decode($id)."'","","","","1");
						$new_photo = $this->upload->data('file_name');
						// unlink('uploads/users_photo/'.$getprofilephoto->photo);
					}
				}
				else
				{
					$new_photo = $this->input->post("old_photo",TRUE);
				}

				$data = array(
					"name"=>ucwords($this->input->post("name",TRUE)),
					"email_address"=>$this->input->post("email_address",TRUE),
					"dob"=>date("Y-m-d",strtotime($this->input->post("dob",TRUE))),
					"gender"=>$this->input->post("gender",TRUE),
					"photo"=>$new_photo,						
				);

				// print_r($data); exit;
				$this->Users_model->SaveData('users',$data,"token='".base64_decode($id)."'");
				$this->session->set_flashdata('success','Profile has been updated successfully');
				$this->session->set_userdata($data);
				redirect("users/index");
			}
		}
		else
		{
			redirect("Users/index");
		}
	}
	public function changepassword()
	{
		$data = array(
			'page_title' => 'Change Password',
			'heading' => 'Guestbook',
			'screen' => 'Change Password',
			'action' => site_url('Users/changepassword_action'),
			'button' => 'Submit',
			'cancel' => 'Back',
			'cancel_action' => site_url('Users/index'),
 		);
		$this->load->view('users/changepassword',$data);
	}
	public function changepassword_action()
	{
		$this->validate_changepassword();
		if($this->form_validation->run()==FALSE)
		{
			$this->changepassword();
		}
		else
		{
			$checkpassword = $this->Users_model->GetData("users","password","id='".$this->session->userdata('id')."'","","","","single");
			$old_password = $checkpassword->password;
			if($old_password != md5($this->input->post('oldpassword')))
			{
				$this->session->set_flashdata('olderror','You have entered incorrect old password');
				redirect('Users/changepassword');
			}
			else
			{
				if($this->input->post('password') == $this->input->post('repeatpassword'))
				{
					$data = array(
							"password"=>md5($this->input->post("password",TRUE)),		
						);
							
					$this->Users_model->SaveData("users",$data,"id='".$this->session->userdata('id')."'");
					$this->session->set_flashdata('success','Password saved successfully.');
					redirect('Users/index');					
				}
				else
				{
					$this->session->set_flashdata('passworderror','Repeat Password does not match New Password');
					redirect('Users/changepassword');					
				}
			}
		}
	}
	public function activitylog()
	{
		$allactivitylog = $this->Users_model->GetData("user_access_logs","left(user_login,10) as login_date, count(id) as user_count, min(user_login) as start_login, max(user_logout) as end_login,ip_address,access_details","user_id='".$this->session->userdata('id')."'","","left(user_login,10)");
		//print_r($this->db->last_query()); exit();
		$data=array(
			'allactivitylog'=>$allactivitylog,
			'page_title' => 'Activity Log',
			'heading' => 'Guestbook',
			'screen' => 'Activity Log',
			'records' => 'User Access Log'
		);
		$this->load->view('users/activitylog',$data);
	}
	public function daily_log($id)
	{
		$timestamp = base64_decode($id);
		$splitTimestamp = explode(" ",$timestamp);
		$date = $splitTimestamp[0];
		$time = $splitTimestamp[1];
		$log = $this->Users_model->GetData("user_access_logs","user_id,user_login,user_logout,ip_address,access_details","user_id='".$this->session->userdata('id')."' and user_login like '%".$date."%'","","","","");
		/* print_r($this->db->last_query()); exit(); */
		$data = array(
			'log'=>$log,
			'page_title' => 'Activity Log',
			'screen' => 'Activity Log',
			'records' => 'User Access Log'
		);
		$this->load->view('users/daily_log',$data);
	}
	public function export()
	{
		$this->Users_model->ExportData("users","name,email_address,dob,gender,status,created","");
	}
	
	public function validate_users()
	{
		$this->form_validation->set_rules('name','Name','required|regex_match[/^[a-zA-Z- ]*$/]');
		$this->form_validation->set_rules('email_address','Email Address','required|valid_email');
		/* $this->form_validation->set_rules('dob','Date Of Birth','required');
		$this->form_validation->set_rules('gender','Gender','required'); */
		$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
	}
	public function validate_profile()
	{
		$this->form_validation->set_rules('name','Name','required|regex_match[/^[a-zA-Z- ]*$/]');
		$this->form_validation->set_rules('email_address','Email Address','required|valid_email');
		$this->form_validation->set_rules('dob','Date Of Birth','required');
		$this->form_validation->set_rules('gender','Gender','required');
		$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');		
	}
	public function validate_changepassword()
	{
		$this->form_validation->set_rules('oldpassword','Old Password','required|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('password','New Password','required|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('repeatpassword','Repeat Password','required|min_length[8]|max_length[16]');
		$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
	}
}
?>