<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cities_model');
		if($this->session->userdata('role')=='User')
		{
			$this->session->set_flashdata('error','Unauthorized Access!!'); 
			redirect('Users/index');
		}
	}
	public function index()
	{
		// Manage/List page from Cities folder
		$allcities = $this->Cities_model->GetCitiesData("cities","cities.id,cities.token,cities.city_name,cities.status,states.state_name","cities.state_id=states.id");
		/* print_r($this->db->last_query($allcities)); exit(); */
		$data = array(
			'allcities' => $allcities,
			'page_title' => 'Manage-Cities',
			'heading' => 'Guestbook',
			'screen' => 'MANAGE CITIES',
			'button' => 'Create',
			'button_action' => site_url('Cities/create'),
			'export' => 'Export',
			'export_action'=> site_url('Cities/export'),
			'records' => 'City Records',
			'importbutton' => 'Import',
			'record' => 'Import Cities',
			'importdata' => site_url('Cities/import'),
			'sample' => site_url('Cities/sample'),
			'samplebutton' => 'Sample.csv',
			
		);
		$this->load->view('cities/index',$data);
	}
	public function create()
	{
		// call form.php from Cities folder
		$allstates = $this->Cities_model->GetData("states","id,state_name","status='Active'","state_name","","");
		$data = array(
			'allstates' => $allstates,
			'page_title' => 'Create - Manage-Cities',
			'heading' => 'Guestbook',
			'screen' => 'Create City',
			'action' => site_url('Cities/create_action'),
			'button' => 'Create',
			'cancel' => 'Cancel',
			'cancel_action' => site_url('Cities/index'),
			'state_id' => set_value('state_id',$this->input->post('state_id',TRUE)),
			'city_name' => set_value('city_name',$this->input->post('city_name',TRUE)),
			'status' => set_value('status',$this->input->post('status',TRUE))
		);
		$this->load->view('cities/form',$data);
	}
	public function create_action()
	{
		if(isset($_POST) && !empty($_POST))
		{
			$this->validate();
			if($this->form_validation->run()==FALSE)
			{
				$this->create();
			}
			else
			{
				$checkcityname=$this->Cities_model->GetData("cities","","city_name='".$this->input->post('city_name',TRUE)."' and state_id='".$this->input->post('state_id',TRUE)."'","","","","");
				if(!empty($checkcityname))
				{
					$this->session->set_flashdata('warning','City is already exist');
					redirect('Cities/create');
				}
				else
				{
					$data = array(
						'token' => md5('Cities-token'.time().rand(1000,9999)),
						'state_id' => $this->input->post('state_id',TRUE),
						'city_name' => ucwords($this->input->post('city_name',TRUE)),
						'status' => $this->input->post('status',TRUE)
					);
					$this->Cities_model->SaveData('cities',$data);
					$this->session->set_flashdata('success','City has been created successfully');
					redirect('Cities/index');
				}
			}
		}
		else
		{
			redirect("Cities/create");
		}
	}
	public function update($id)
	{
		$getsinglecities= $this->Cities_model->GetData("cities","","token='".base64_decode($id)."'","","","","single");
		if(!empty($getsinglecities)){		
			$allstates = $this->Cities_model->GetData("states","id,state_name","status='Active'","state_name","","");
			$data = array(
				'allstates' => $allstates,
				'page_title' => 'Update - Manage-Cities',
				'heading' => 'Guestbook',
				'screen' => 'Update City',
				'action' => site_url('Cities/update_action/'.$id),
				'button' => 'Update',
				'cancel' => 'Cancel',
				'cancel_action' => site_url('Cities/index'),
				'state_id' => set_value('state_id',$getsinglecities->state_id),
				'city_name' => set_value('city_name',$getsinglecities->city_name),
				'status' => set_value('status',$getsinglecities->status)
			);
			$this->load->view('cities/form',$data);
		}
		else
		{
			redirect("Cities/index");
		}
	}
	public function update_action($id)
	{
		if(isset($_POST) && !empty($_POST))
		{
			
			$this->validate($id);
			if($this->form_validation->run()==FALSE)
			{
				$this->update($id);
			}
			else
			{
				$checkcityname=$this->Cities_model->GetData("cities","","city_name='".$this->input->post('city_name',TRUE)."' and state_id='".$this->input->post('state_id',TRUE)."' and token !='".base64_decode($id)."'","","","","");
				//print_r($this->db->last_query()); exit();
				if(!empty($checkcityname))
				{
					$this->session->set_flashdata('warning','City is already exist');
					redirect('Cities/update/'.$id);
				}
				else
				{
					$data = array(
						'state_id' => $this->input->post('state_id',TRUE),
						'city_name' => ucwords($this->input->post('city_name',TRUE)),
						'status' => $this->input->post('status',TRUE)
					);
					$this->Cities_model->SaveData('cities',$data,"token='".base64_decode($id)."'");
					$this->session->set_flashdata('success','City has been updated successfully');
					redirect('Cities/index');
				} 
			}
		}
		else
		{
			redirect("Cities/update/".$id);
		}
	}
	public function delete_action($id)
	{
		//call delete function from model with id/token
		$getcity = $this->Cities_model->GetData("cities","id","token='".base64_decode($id)."'","","","","1");
		$getcitymapdata=$this->Cities_model->GetData("guests","id","city_id ='".$getcity->id."'","","","","");
		if(!empty($getcitymapdata))
		{
			$this->session->set_flashdata('warning','City is already mapped');
			redirect('Cities/index');
		}
		else
		{
			$this->Cities_model->DeleteData("cities","id ='".$getcity->id."'");
			$this->session->set_flashdata('error','City has been deleted successfully');
			redirect('Cities/index');
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
				{	$del=0;$nondel=0;
					for($i=0;$i<count($token);$i++)
					{
						$getcity = $this->Cities_model->GetData("cities","id","token='".base64_decode($token[$i])."'","","","","");
						foreach($getcity as $getcitydata)
						{
							$getcitymapdata=$this->Cities_model->GetData("guests","id","city_id ='".$getcitydata->id."'","","","","");
							if(!empty($getcitymapdata))
							{
								$nondel++;
							}
							else
							{
								$this->Cities_model->DeleteData("cities","id ='".$getcitydata->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." City record has been deleted"."<br/>".$nondel." City record not deleted";
					$this->session->set_flashdata('error',$massage);
					redirect('Cities/index');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect('Cities/index');
			}
		}
	}
	public function export()
	{
		$id = $this->input->post('cityidcollect');
		$this->Cities_model->ExportData("cities","state_name,city_name,status,created",$id);
	}
	public function sample()
	{
		$this->Cities_model->SampleData("countries","state_name,city_name");
	}
	public function import()
	{
		//Import file submit or not
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
					redirect('Cities/index');
				}else{
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					//reading upload file
					$file = fopen("assets/files/".$filename,"r");
					$i = 0;
					$numberOfFields = 2; // total number of fields
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
					$skip = 0; $dup = 0; $stateexist = 0;
					//insert import data
					foreach($importData_arr as $cityData){
						//skip first row
						if($skip != 0){
							$checkstateexist = $this->Cities_model->GetData("states","id,state_name","state_name = '".$cityData[0]."'","","","","");
							//print_r($this->db->last_query()); exit();
							if(empty($checkstateexist))
							{
								$stateexist++;
							}
							else
							{
								$cityduplication = $this->Cities_model->GetCitiesData("cities","cities.city_name,states.state_name","cities.city_name='".$cityData[1]."' and states.state_name='".$cityData[0]."'");
								if(!empty($cityduplication))
								{
									$dup++;
								}
								else
								{
									 foreach($checkstateexist as $stateexists)
									{										
										$cityData[0] = $stateexists->id;
									} 
									$this->Cities_model->ImportData($cityData);
								}
							}
						}
						$skip++;
					}
					$totalrecords = count(file("assets/files/".$filename));
					$this->session->set_flashdata("warning",$dup." duplicate cities record found");
					if(!empty($stateexist))
					{	
						$this->session->set_flashdata("error",$stateexist." State not found");
					}
					if(!empty($checkstateexist->id) || $i > 0 )
					{
						$recordimport = ($totalrecords-1)-$dup-$stateexist;
						$this->session->set_flashdata("success",$recordimport." Records imported");
					}
					$this->session->set_flashdata("info",($totalrecords-1)." Total records");
					redirect('Cities/index');
				}
			}else{
				$this->session->set_flashdata("error","Please select csv file");	
				redirect('Cities/index');
			}
		}
	}
	
	/* 
		==================================
		Validation For
		1. Create Cities
		2. Update Cities
		==================================
	*/
	
	public function validate($id='')
	{
		if($id!='')
		{
			$this->form_validation->set_rules('state_id','State','required');
			$this->form_validation->set_rules('city_name','City Name','required|trim|regex_match[/^[a-zA-Z-]*$/]|alpha');
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
		else
		{
			$this->form_validation->set_rules('state_id','State','required');
			$this->form_validation->set_rules('city_name','City Name','required|trim|regex_match[/^[a-zA-Z-]*$/]|alpha');
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
	}
}
?>