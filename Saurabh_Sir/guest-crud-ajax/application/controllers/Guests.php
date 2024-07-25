<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guests extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Guests_model');		
	}
	public function index()
	{
		// Manage/List page from guests folder
		$allguests = $this->Guests_model->GetGuestsData("guests","guests.token,guests.id,guests.name,guests.email_address,guests.address,guests.details_about_guest,guests.dob,guests.gender,guests.photo,guests.status,users.name as username,guests.created,countries.country_name,states.state_name,cities.city_name,hobbies.hobby_title","guests.user_id='".$this->session->userdata('id')."'","guests.created DESC");
		$data = array(
			'page_title' => 'Manage-Guests ',
			'heading' => ' Guestbook',
			'screen' => 'MANAGE GUESTS list',
			'button' => 'Create',
			'button_action' => site_url('Guests/create'),
			'export' => 'Export',
			'export_action'=> site_url('Guests/export'),
			'records' => 'Guest Records',
			'allguests' => $allguests,
			'importbutton' => 'Import',
			'record' => 'Import Guests',
			'importdata' => site_url('Guests/import'),
			'sample' => site_url('Guests/sample'),
			'samplebutton' => 'Sample.csv',
		);
		$this->load->view('guests/index',$data);
	}
	public function totalguestbyuser($id)
	{
		// Manage/List page from guests folder
		$allguests = $this->Guests_model->GetGuestsData("guests","guests.token,guests.name,guests.email_address,guests.address,guests.details_about_guest,guests.dob,guests.gender,guests.photo,guests.status,users.name as username,guests.created,countries.country_name,states.state_name,cities.city_name,hobbies.hobby_title","guests.user_id='".base64_decode($id)."'","guests.created DESC");
		$data = array(
			'page_title' => 'Manage-Guests',
			'heading' => ' Guestbook',
			'screen' => 'MANAGE GUESTS',
			'button' => 'Create',
			'button_action' => site_url('Guests/create'),
			'records' => 'Guest Records',
			'allguests' => $allguests
		);
		$this->load->view('guests/guests',$data);
	}
	public function maleguestbyuser($id)
	{
		// Manage/List page from guests folder
		$allguests = $this->Guests_model->GetGuestsData("guests","guests.token,guests.name,guests.email_address,guests.address,guests.details_about_guest,guests.dob,guests.gender,guests.photo,guests.status,users.name as username,guests.created,countries.country_name,states.state_name,cities.city_name,hobbies.hobby_title","guests.user_id='".base64_decode($id)."' and guests.gender='Male'","guests.created DESC");
		$data = array(
			'page_title' => 'Manage-Guests',
			'heading' => ' Guestbook',
			'screen' => 'MANAGE GUESTS',
			'button' => 'Create',
			'button_action' => site_url('Guests/create'),
			'records' => 'Guest Records',
			'allguests' => $allguests
		);
		$this->load->view('guests/guests',$data);
	}
	public function femaleguestbyuser($id)
	{
		// Manage/List page from guests folder
		$allguests = $this->Guests_model->GetGuestsData("guests","guests.token,guests.name,guests.email_address,guests.address,guests.details_about_guest,guests.dob,guests.gender,guests.photo,guests.status,users.name as username,guests.created,countries.country_name,states.state_name,cities.city_name,hobbies.hobby_title","guests.user_id='".base64_decode($id)."' and guests.gender='Female'","guests.created DESC");
		$data = array(
			'page_title' => 'Manage-Guests',
			'heading' => ' Guestbook',
			'screen' => 'MANAGE GUESTS',
			'button' => 'Create',
			'button_action' => site_url('Guests/create'),
			'records' => 'Guest Records',
			'allguests' => $allguests
		);
		$this->load->view('guests/guests',$data);
	}
	public function guest_log_record($id)
	{
		// Manage/List page from guests folder
		$allguestslog = $this->Guests_model->GetGuestsLog("guest_logs","guest_logs.guest_id,guest_logs.name,guest_logs.email_address,guest_logs.address,guest_logs.details_about_guest,guest_logs.dob,guest_logs.gender,countries.country_name,states.state_name,cities.city_name,guest_logs.hobby_id,hobbies.hobby_title,guest_logs.photo,guest_logs.status,guest_logs.created","guest_logs.guest_id='".$id."'","guest_logs.created DESC");
		$data = array(
			'page_title' => 'Manage-Guests',
			'heading' => ' Guestbook',
			'screen' => 'GUEST LOGS',
			'cancel' => 'Back',
			'cancel_action' => site_url('Guests/index'),
			'records' => 'Guest Records',
			'allguestslog' => $allguestslog
		);
		$this->load->view('guests/guest_logs',$data);
	}
	public function create()
	{
		// call form.php from guests folder
		$allhobbies = $this->Guests_model->GetData("hobbies","id,hobby_title","status='Active'","hobby_title","","");
		
		$allcountries = $this->Guests_model->GetData("countries","id,country_name","status='Active'","country_name","","");
		
		$allstates = $this->Guests_model->GetData("states","id,state_name","status='Active'","state_name","","");
		
		$allcities = $this->Guests_model->GetData("cities","id,city_name","status='Active'","city_name","","");
		$data = array(
			'allhobbies' => $allhobbies,
			'allcountries' => $allcountries,
			'allstates' => $allstates,
			'allcities' => $allcities,
			'page_title' => 'Create - Manage-Guests',
			'heading' => 'Guestbook',
			'screen' => 'Create Guest',
			'action' => site_url('Guests/create_action'),
			'button' => 'Create',
			'cancel' => 'Cancel',
			'cancel_action' => site_url('Guests/index'),
			'name' =>  set_value('name',$this->input->post('name',TRUE)),
			'email_address' =>  set_value('email_address',$this->input->post('email_address',TRUE)),
			'address' =>  set_value('address',$this->input->post('address',TRUE)),
			'details_about_guest' =>  set_value('details_about_guest',$this->input->post('details_about_guest',TRUE)),
			'dob' =>  set_value('dob',$this->input->post('dob',TRUE)),
			'gender' => set_value('gender',$this->input->post('gender',TRUE)),
			'country_id' =>  set_value('country_id',$this->input->post('country_id',TRUE)),
			'state_id' =>  set_value('state_id',$this->input->post('state_id',TRUE)),
			'city_id' =>  set_value('city_id',$this->input->post('city_id',TRUE)),
			'hobby_id' =>  set_value('hobby_id',$this->input->post('hobby_id',TRUE)),
			'status' =>  set_value('status',$this->input->post('status',TRUE))
		);
		$this->load->view('guests/form',$data);
	}
	public function create_action()
	{
		if(isset($_POST) && !empty($_POST))
		{
			$this->validate();
			if ($this->form_validation->run() == FALSE)
			{
				$this->create();
			}else
			{

				
				$config['file_name'] 	 = $_FILES['photo']['name'];
				$config['encrypt_name']  = TRUE;
				$config['upload_path'] 	 = 'uploads/guests_photo/';
				$config['allowed_types'] = 'jpg|png|jpeg';			
				// $config['max_size']  	 = 100;
				// $config['max_width']     = 500;
				// $config['max_height']    = 500;
				$config['is_image'] = 1;	
				$config['remove_spaces'] = TRUE;				

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				
				if (!$this->upload->do_upload('photo'))
				{
					$this->session->set_flashdata('error',$this->upload->display_errors());

					//print_r($this->upload->display_errors()); exit;
					redirect("guests/create");
				}
				else
				{
					$data = array(
					'token' => md5('Guests-token'.time().rand(1000,9999)),
					'user_id' => $this->session->userdata('id'),
					'name' => ucwords($this->input->post('name',TRUE)),
					'email_address' =>  strtolower($this->input->post('email_address',TRUE)),
					'address' => ucwords($this->input->post('address',TRUE)),
					'details_about_guest' => ucwords($this->input->post('details_about_guest',TRUE)),
					'gender' => $this->input->post('gender',TRUE),
					'dob' => date('Y-m-d',strtotime($this->input->post('dob',TRUE))),
					'country_id' => $this->input->post('country_id',TRUE),
					'state_id' => $this->input->post('state_id',TRUE),
					'city_id' => $this->input->post('city_id',TRUE),
					'hobby_id' =>implode(", ",$this->input->post('hobby_id',TRUE)),
					'photo' => $this->upload->data('file_name'),
					'status' => $this->input->post('status',TRUE)
					);

					//print_r($data); exit;
					$this->Guests_model->SaveData('guests',$data);
					$this->session->set_flashdata('success','Guest has been created successfully');
					redirect('Guests/index');
				}	
			}
		}
		else
		{
			redirect("Guests/create");
		}
	}
	public function update($id)
	{
		// call form.php with data against id/token
		$getsingleguests = $this->Guests_model->GetData("guests","","token='".base64_decode($id)."'","","","","single");
		if(!empty($getsingleguests))
		{
			$allhobbies = $this->Guests_model->GetData("hobbies","id,hobby_title","status='Active'","hobby_title","","");
			$allcountries = $this->Guests_model->GetData("countries","id,country_name","status='Active'","country_name","","");
			$allstates = $this->Guests_model->GetData("states","id,state_name","status='Active'","state_name","","");
			$allcities = $this->Guests_model->GetData("cities","id,city_name","status='Active'","city_name","","");
			$data = array(
				'allhobbies' => $allhobbies,
				'allcountries' => $allcountries,
				'allstates' => $allstates,
				'allcities' => $allcities,
				'page_title' => 'Update - Manage-Guests',
				'heading' => 'Guestbook',
				'screen' => 'Update Guest',
				'action' => site_url('Guests/update_action/'.$id),
				'button' => 'Update',
				'cancel' => 'Cancel',
				'cancel_action' => site_url('Guests/index'),
				'name' =>  set_value('name',$getsingleguests->name),
				'email_address' =>  set_value('email_address',$getsingleguests->email_address),
				'address' =>  set_value('address',$getsingleguests->address),
				'details_about_guest' =>  set_value('details_about_guest',$getsingleguests->details_about_guest),
				'dob' =>  set_value('dob',$getsingleguests->dob),
				'gender' => set_value('gender',$getsingleguests->gender),
				'country_id' =>  set_value('country_id',$getsingleguests->country_id),
				'state_id' =>  set_value('state_id',$getsingleguests->state_id),
				'city_id' =>  set_value('city_id',$getsingleguests->city_id),
				'hobby_id' =>  set_value('hobby_id',explode(", ",$getsingleguests->hobby_id)),
				"photo"=>set_value('photo',$getsingleguests->photo),
				'status' =>  set_value('status',$getsingleguests->status)
			);
			$this->load->view('guests/form',$data);
		}
		else
		{
			redirect("Guests/index");
		}
	}
	public function update_action($id)
	{
		$getsingle = $this->Guests_model->GetData("guests","","token='".base64_decode($id)."'","","","","single");
		if(isset($_POST) && !empty($_POST))
		{
			$this->validate($id);
			if($this->form_validation->run()==FALSE)
			{
				$this->update($id);
			}	
			else
			{ 
				if($_FILES['photo']['error']==0)
				{
					$config['file_name'] 	 = $_FILES['photo']['name'];
					$config['encrypt_name']  = TRUE;
					$config['upload_path'] 	 = 'uploads/guests_photo/';
					$config['allowed_types'] = 'jpeg|jpg|png';			
					$config['max_size']  	 = 100;
					$config['max_width']     = 500;
					$config['max_height']    = 500;
					$config['is_image'] = 1;	
					$config['remove_spaces'] = TRUE;				

					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('photo'))
					{
						$error = array('error' => $this->upload->display_errors());
						redirect("Guests/update/".id);
					}
					else
					{
						
						$getsingleguests = $this->Guests_model->GetData("guests","photo","token='".base64_decode($id)."'","","","","single");
						$new_photo = $this->upload->data('file_name');
						if( !is_null($getsingleguests->photo))
						{
							unlink("uploads/guests_photo/".$getsingleguests->photo);
						}
					}
				}
				else
				{
					$new_photo = $this->input->post("old_photo",TRUE);
				}
				$data = array(
				'name' => ucwords($this->input->post('name',TRUE)),
				'email_address' =>  strtolower($this->input->post('email_address',TRUE)),
				'address' => ucwords($this->input->post('address',TRUE)),
				'details_about_guest' => ucwords($this->input->post('details_about_guest',TRUE)),
				'gender' => $this->input->post('gender',TRUE),
				'dob' => date('Y-m-d',strtotime($this->input->post('dob',TRUE))),
				'country_id' => $this->input->post('country_id',TRUE),
				'state_id' => $this->input->post('state_id',TRUE),
				'city_id' => $this->input->post('city_id',TRUE),
				'hobby_id' =>implode(", ",$this->input->post('hobby_id',TRUE)),
				'photo' => $new_photo,
				'status' => $this->input->post('status',TRUE)
				);
				$datalog = array(
				'token' => $getsingle->token,
				'guest_id'=> $getsingle->id,
				'name' =>  $getsingle->name,
				'email_address' => $getsingle->email_address,
				'address' =>  $getsingle->address,
				'details_about_guest' =>  $getsingle->details_about_guest,
				'dob' => $getsingle->dob,
				'gender' => $getsingle->gender,
				'country_id' => $getsingle->country_id,
				'state_id' =>  $getsingle->state_id,
				'city_id' =>  $getsingle->city_id,
				'hobby_id' => $getsingle->hobby_id,
				// "photo"=> $getsingle->photo,
				'status' => $getsingle->status
			);
			$this->Guests_model->SaveData('guest_logs',$datalog);
			$this->Guests_model->SaveData('guests',$data,"token='".base64_decode($id)."'");
			$this->session->set_flashdata('success','Guest has been updated successfully');
			redirect('Guests/index');
			}
		}
		else
		{
			redirect("Guests/update/".$id);
		}
				
	}
	public function view_action($id)
	{ //print_r($id);exit;
		
		//call view.php with data against id/token
		$guestdata = $this->Guests_model->GetGuestsData("guests","guests.name,guests.email_address,guests.address,guests.details_about_guest,guests.dob,guests.gender,guests.hobby_id,guests.photo,guests.status,users.name as username,guests.created,countries.country_name,states.state_name,cities.city_name","guests.token ='".base64_decode($id)."'");
		if(empty($guestdata))
		{
			redirect('Guests/index');
		}
		else
		{
			$data = array(
				'page_title' => 'View Guest',
				'heading' => ' Guestbook',
				'screen' => 'VIEW GUESTS',
				'records' => 'Guest Detail',
				'cancel' => 'Back',
				'cancel_action' => site_url('Guests/index'),
				'guestdata' => $guestdata
			);
			$this->load->view('guests/view',$data);
		}
	}
	public function delete_action($id)
	{
		// Fetch attachment from table against id/token
		$getguest = $this->Guests_model->GetData("guests","id,photo","token='".base64_decode($id)."'","","","","1");
		$photo = $getguest->photo;
		//If record found or not
		if(empty($getguest))
		{
			redirect('Guests/index');
		}
		else
		{
			if(!empty($photo))
			{ 
				//Remove record from table
				$this->Guests_model->DeleteData("guests","id ='".$getguest->id."'");
				// Remove attachment from folder 
				unlink("uploads/guests_photo/".$photo);
				$this->session->set_flashdata('error','Guest record has been deleted successfully');
				redirect('Guests/index');
			}
			else
			{
				$this->Guests_model->DeleteData("guests","id ='".$getguest->id."'");
				$this->session->set_flashdata('error','Guest record has been deleted successfully');
				redirect('Guests/index');
			} 
		}
	}
	public function deleteall_action()
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
						$getallguest=$this->Guests_model->GetData("guests","id,photo","token='".base64_decode($token[$i])."'","","","","");
						foreach($getallguest as $getguest)
						{
							$this->Guests_model->DeleteData("guests","id ='".$getguest->id."'");
							unlink("uploads/guests_photo/".$getguest->photo);
						}
						$del++;
					}  
				}
				$massage= count($token)." Guest records has been deleted successfully";
				$this->session->set_flashdata('error',$massage);
				redirect('Guests/index');
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect('Guests/index');
			}
		}
	}
	public function export()
	{
		$id = $this->input->post('guestidcollect');
		//print_r($id); exit;
		$this->Guests_model->ExportData("guests","username,name,email_address,address,details_about_guest,dob,gender,country,state,city,hobby",$id);
	}
	public function sample()
	{
		$this->Guests_model->SampleData("guests","name,email_address,address,details_about_guest,dob,gender,country_name,state_name,city_name,hobby_title");
	}
	public function import()
	{
		if($this->input->post('upload') != NULL){
			//$data = array();
			if($_FILES['file']['name']){
				$config['upload_path'] = 'assets/files';
				$config['allowed_types'] = 'csv';
				$config['max_size'] = '1000';
				$config['file_name'] = $_FILES['file']['name'];
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
                if (!$this->upload->do_upload('file')){
					$this->session->set_flashdata("error","File not uploaded");
					redirect('Guests/index');
				}else{
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					//reading upload file
					$file = fopen("assets/files/".$filename,"r");
					$i = 0;
					$numberOfFields = 10; // total number of fields
					$importData_arr = array();
					while(($filedata = fgetcsv($file, 1000, ",")) !== FALSE)
					{
						$num = count($filedata );
						if($numberOfFields == $num){
							for($c=0; $c < $num; $c++)
							{
								$importData_arr[$i][] = $filedata[$c];
							}
						}
						$i++;
					}		
					fclose($file);				
					$skip = 0; $dup = 0; $countryexist = 0; $stateexist = 0; $cityexist = 0; $hobbyexist = 0;
					//insert import data
					foreach($importData_arr as $guestData){
						//skip first row
						if($skip != 0){
							$checkemailduplication = $this->Guests_model->GetData("guests","email_address","email_address= '".$guestData[1]."'");
							if(!empty($checkemailduplication))
							{
								$dup++;
							}
							else
							{
								$checkcountryexist = $this->Guests_model->GetData("countries","id,country_name","country_name = '".$guestData[6]."'","","","","1");

								$checkstateexist = $this->Guests_model->GetData("states","id,state_name","state_name = '".$guestData[7]."'","","","","1");
								
								$checkcityexist = $this->Guests_model->GetData("cities","id,city_name","city_name = '".$guestData[8]."'","","","","1");
								
								$allhobby = explode(",",$guestData[9]);
								$hobbycount = count($allhobby);
								$gethobby ='';
								for($j=0; $j< $hobbycount;$j++){
									$hobbycollect = $this->Guests_model->GetData("hobbies","id","hobby_title = '".trim($allhobby[$j])."'","","","","1");
									foreach($hobbycollect as $hobbyrow)
									{
										if(!empty($hobbycollect->id)){
											$gethobby .=$hobbycollect->id;
										}
									}
									if($j<$hobbycount-1)
									{
										if(!empty($hobbycollect)){
											$gethobby .= ", ";
										}
									} 
								}
								
								if(empty($gethobby)){
									$hobbyexist++;
								}else if(empty($checkcountryexist)){
									$countryexist++;
								}else if(empty($checkstateexist)){
									$stateexist++;
								}else if(empty($checkcityexist)){
									$cityexist++;
								}else{
									$guestData[6] = $checkcountryexist->id;
									$guestData[7] = $checkstateexist->id;
									$guestData[8] = $checkcityexist->id;
									$guestData[9] = $gethobby;
									$this->Guests_model->ImportData($guestData);
								}
							}
						}
						$skip++;
					}
						$totalrecords = count(file("assets/files/".$filename));
						$this->session->set_flashdata("warning",$dup." duplicate guests record found");
						if(!empty($countryexist) || !empty($stateexist) || !empty($cityexist))
						{	
							$this->session->set_flashdata("error",
									$countryexist." Country not found"."<br/>".
									$stateexist." State not found"."<br/>".
									$cityexist." City not found"."<br/>");
						} 
						if(!empty($hobbyexist))
						{
							$this->session->set_flashdata("hobbyerror",$hobbyexist." Hobby not found");
						}
						if(!empty($checkcountryexist->id) || !empty($checkstateexist->id) || !empty($checkcityexist->id) || !empty($gethobby) || $i > 0 )
						{
							$recordimport = (((((($totalrecords-1)-$dup)-$countryexist)-$stateexist)-$cityexist)-$hobbyexist);
							$this->session->set_flashdata("success",$recordimport." Records imported");
						}
						$this->session->set_flashdata("info",($totalrecords-1)." Total records");
						redirect('Guests/index');
				}
			}else{
				$this->session->set_flashdata("error","Please select csv file");	
				redirect('Guests/index');
			}
		}
	}
	
	public function getStates()
    {
	  $getStates = $this->Guests_model->GetData("states","id,state_name","country_id='".$_POST['country_id']."'","","","","");


      if(!empty($getStates))
      {
      $response = '<option value="">Select State skdlfjsdkjfkl dkflsj lfdasjklf</option>';
      foreach ($getStates as $getState) 
      {
        $response .= '<option value="'.$getState->id.'">'.ucfirst($getState->state_name).'</option>';
      }
      }
      else
      {
       $response = '<option value="0">Select State</option>';
      }
      echo $response;exit;
    }

	/* 
	==================================
	Validation For 
	1. Create Guest
	2. Update Guest
	==================================
	*/
	public function validate($id='')
	{
		if($id!='')
		{
			$this->form_validation->set_rules('name','Name','required|regex_match[/^[a-zA-Z- ]*$/]');
			$this->form_validation->set_rules('email_address','Email Address','required|valid_email');
			$this ->form_validation->set_rules('address','Address','required');
			$this ->form_validation->set_rules('details_about_guest','About guest','required');
			$this ->form_validation->set_rules('gender','Gender','required');
			$this ->form_validation->set_rules('dob','Date of Birth','required');
			$this ->form_validation->set_rules('country_id','Country','required');
			$this ->form_validation->set_rules('state_id','State','required');
			$this ->form_validation->set_rules('city_id','City','required');
			if(empty($this->input->post('hobby_id')))
			{
				$this ->form_validation->set_rules('hobby_id','Hobby','required');
			} 
			$this ->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
		else
		{ 
			//Validation for create
			$this->form_validation->set_rules('name','Name','required|regex_match[/^[a-zA-Z- ]*$/]');
			$this->form_validation->set_rules('email_address','Email Address','required|valid_email|is_unique[guests.email_address]');
			$this ->form_validation->set_rules('address','Address','required');
			$this ->form_validation->set_rules('details_about_guest','About guest','required');
			$this ->form_validation->set_rules('gender','Gender','required');
			$this ->form_validation->set_rules('dob','Date of Birth','required');
			$this ->form_validation->set_rules('country_id','Country','required');
			$this ->form_validation->set_rules('state_id','State','required');
			$this ->form_validation->set_rules('city_id','City','required');
			if(empty($this->input->post('hobby_id')))
			{
				$this ->form_validation->set_rules('hobby_id','Hobby','required');
			} 
			// if($_FILES['photo']['error']==4)
			// {
			// 	$this ->form_validation->set_rules('photo','Photo','required|allowed_types');
			// }
			$this ->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
	} 
}
?>