<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class States extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('States_model');
		if($this->session->userdata('role')=='User')
		{
			$this->session->set_flashdata('error','Unauthorized Access!!'); 
			redirect('Users/index');
		}
	}
	public function index()
	{
		// Manage/List page from states folder
		$allstates = $this->States_model->GetStatesData("states","states.id,states.token,states.state_name,states.status,countries.country_name","states.country_id=countries.id");
		$data = array(
			'allstates' => $allstates,
			'page_title' => 'Manage-States',
			'heading' => 'Guestbook',
			'screen' => 'MANAGE STATES',
			'button' => 'Create',
			'button_action' => site_url('States/create'),
			'export' => 'Export',
			'export_action'=> site_url('States/export'),
			'records' => 'State Records',
			'importbutton' => 'Import',
			'record' => 'Import States',
			'importdata' => site_url('States/import'),
			'sample' => site_url('States/sample'),
			'samplebutton' => 'Sample.csv',
		);
		$this->load->view('states/index', $data);
	}
	public function create()
	{
		// call form.php from states folder
		$allcountries = $this->States_model->GetData("countries","id,country_name","status='Active'","country_name","","");
		$data = array(
			'allcountries' => $allcountries,
			'page_title' => 'Create - Manage-States',
			'heading' => 'Guestbook',
			'screen' => 'Create State',
			'action' => site_url('States/create_action') ,
			'button' => 'Create',
			'cancel' => 'Cancel',
			'cancel_action' => site_url('States/index'),
			'country_id' => set_value('country_id',$this->input->post('country_id',TRUE)),
			'state_name' => set_value('state_name',$this->input->post('state_name',TRUE)),
			'status' => set_value('status',$this->input->post('status',TRUE)),
			
		);
		$this->load->view('states/form',$data);
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
				$checkstatename=$this->States_model->GetData("states","","state_name='".$this->input->post('state_name',TRUE)."' and country_id='".$this->input->post('country_id',TRUE)."'","","","","");
				if(!empty($checkstatename))
				{
					$this->session->set_flashdata('warning','State is already exist');
					redirect('States/create');
				}
				else
				{
					$data= array(
						'token' => md5('States-token'.time().rand(1000,9999)),
						'country_id' => $this->input->post('country_id',TRUE),
						'state_name' => ucwords($this->input->post('state_name',TRUE)),
						'status' => $this->input->post('status',TRUE)
					);
					$this->States_model->SaveData('states',$data);
					$this->session->set_flashdata('success','State has been created successfully');
					redirect('States/index');
				}
			}
		}
		else
		{
			redirect("States/create");
		}
	}
	public function update($id)
	{
		$getsinglestates= $this->States_model->GetData("states","","token='".base64_decode($id)."'","","","","single");
		if(!empty($getsinglestates))
		{
			$allcountries = $this->States_model->GetData("countries","id,country_name","status='Active'","country_name","","");
			$data = array(
				'allcountries' => $allcountries,
				'page_title' => 'Update - Manage-States',
				'heading' => 'Guestbook',
				'screen' => 'update State',
				'action' => site_url('States/update_action/'.$id) ,
				'button' => 'Update',
				'cancel' => 'Cancel',
				'cancel_action' => site_url('States/index'),
				'country_id' => set_value('country_id',$getsinglestates->country_id),
				'state_name' => set_value('state_name',$getsinglestates->state_name),
				'status' => set_value('status',$getsinglestates->status)
				
			);
			$this->load->view('states/form',$data);
		}
		else
		{
			redirect("States/update/".$id);
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
				$checkstatename=$this->States_model->GetData("states","","state_name='".$this->input->post('state_name',TRUE)."' and country_id='".$this->input->post('country_id',TRUE)."' and token != '".base64_decode($id)."'","","","","");
				if(!empty($checkstatename))
				{
					$this->session->set_flashdata('warning','State is already exist');
					redirect('States/update/'.$id);
				}
				else
				{
					$data= array(
						'country_id' => $this->input->post('country_id',TRUE),
						'state_name' => ucwords($this->input->post('state_name',TRUE)),
						'status' => $this->input->post('status',TRUE)
					);
					$this->States_model->SaveData('states',$data,"token = '".base64_decode($id)."'");
					$this->session->set_flashdata('success','State has been updated successfully');
					redirect('States/index');
				}
			}
		}
		else
		{
			redirect("States/update/".$id);
		}
	}
	public function delete_action($id)
	{
		//call delete function from model with id/token
		$getstate = $this->States_model->GetData("states","id","token='".base64_decode($id)."'","","","","1");
		$getstatemapcitydata=$this->States_model->GetData("cities","id","state_id ='".$getstate->id."'","","","","");
		$getstatemapguestdata=$this->States_model->GetData("guests","id","state_id ='".$getstate->id."'","","","","");
		if(!empty($getstatemapcitydata) || !empty($getstatemapguestdata))
		{
			$this->session->set_flashdata('warning','State is already mapped');
			redirect('States/index');
		}
		else
		{
			$this->States_model->DeleteData("states","id ='".$getstate->id."'");
			$this->session->set_flashdata('error','State has been deleted successfully');
			redirect('States/index');
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
						$getstate = $this->States_model->GetData("states","id","token='".base64_decode($token[$i])."'","","","","");
						foreach($getstate as $getstatedata)
						{
							$getstatemapcitydata=$this->States_model->GetData("guests","id","state_id ='".$getstatedata->id."'","","","","");
							
							$getstatemapguestdata=$this->States_model->GetData("guests","id","state_id ='".$getstatedata->id."'","","","","");
							if(!empty($getstatemapcitydata) || !empty($getstatemapguestdata))
							{
								$nondel++;
							}
							else
							{
								$this->States_model->DeleteData("states","id ='".$getstatedata->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." State record has been deleted"."<br/>".$nondel." State record not deleted";
					$this->session->set_flashdata('error',$massage);
					redirect('States/index');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect('States/index');
			}
		}
	}
	public function export()
	{
		$id = $this->input->post('statecollectid'); 
		$this->States_model->ExportData("states","country_name,state_name,status,created",$id);
	}
	public function sample()
	{
		$this->States_model->SampleData("states","country_name,state_name");
	}
	public function import()
	{
		//if form submit or not
		if($this->input->post('upload') != NULL){
			//$data = array();
			if($_FILES['file']['name']){
				$config['upload_path'] = 'assets/files';
				$config['allowed_types'] = 'csv';
				$config['max_size'] = '1000';
				$config['file_name'] = $_FILES['file']['name'];
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				// print_r($this->upload->do_upload('file')); exit();
                if (!$this->upload->do_upload('file')){
					$this->session->set_flashdata("error","File not uploaded");
					redirect('states/index');
					
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
					$skip = 0; $dup = 0; $countryexist = 0 ;
					//insert import data
					//print_r($importData_arr); exit();
					foreach($importData_arr as $stateData){	
						//skip first row
						if($skip != 0){
							$checkcountryexist = $this->States_model->GetData("countries","id,country_name","country_name = '".$stateData[0]."'","","","","");
							//print_r($this->db->last_query()); exit();
							if(empty($checkcountryexist))
							{
								$countryexist++;
							}
							else
							{
								$stateduplication = $this->States_model->GetStatesData("states","states.state_name","states.state_name='".$stateData[1]."' and countries.country_name='".$stateData[0]."'");
								if(!empty($stateduplication))
								{
									$dup++;
								}
								else
								{
									foreach($checkcountryexist as $countryexists)
									{							
										$stateData[0] = $countryexists->id;
									}
									//print_r($stateData); exit();
									$this->States_model->ImportData($stateData);									
								}
							}
						}
						$skip++;
						}
						$totalrecords = count(file("assets/files/".$filename));
						$this->session->set_flashdata("warning",$dup." Duplicate states record found");
						if(!empty($countryexist))
						{	
							$this->session->set_flashdata("error",$countryexist." Country not found");
						}
						if(!empty($checkcountryexist->id) || $i > 0 )
						{
							$recordimport = ($totalrecords-1)-$dup-$countryexist;
							$this->session->set_flashdata("success",$recordimport." Records imported");
						}
						$this->session->set_flashdata("info",($totalrecords-1)." Total records");
						redirect('states/index');
				}
			}else{
				$this->session->set_flashdata("error","Please select csv file");	
				redirect('states/index');
			}
		}
	}
	
	/*
		=====================================
		Validation For
		1.Create State
		2. Update State
		=====================================
	*/
	public function validate($id='')
	{
		if($id!='')
		{
			$this->form_validation->set_rules('country_id','Country','required');
			$this->form_validation->set_rules('state_name','State Name','required|alpha|regex_match[/^[a-zA-Z- ]*$/]');
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
		else
		{
			$this->form_validation->set_rules('country_id','Country','required');
			$this->form_validation->set_rules('state_name','State Name','required|alpha|regex_match[/^[a-zA-Z- ]*$/]');
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
	}
}
?>