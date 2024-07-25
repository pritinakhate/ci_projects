<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hobbies extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hobbies_model');
		if($this->session->userdata('role')=='User')
		{
			$this->session->set_flashdata('error','Unauthorized Access!!'); 
			redirect('Users/index');
		}
	}
	public function index()
	{
		// Manage/List page from hobbies folder
		$allhobbies = $this->Hobbies_model->GetData("hobbies","","","hobby_title","","");
		$data = array(
			'allhobbies' => $allhobbies,
			'page_title' => 'Manage-Hobbies',
			'heading' => 'Guestbook', 
			'screen' => 'MANAGE HOBBIES',
			'button' => 'Create',
			'button_action' => site_url('Hobbies/create'),
			'export' => 'Export',
			'export_action'=> site_url('Hobbies/export'),
			'records' => 'Hobby Records',
			'importbutton' => 'Import',
			'record' => 'Import Hobbies',
			'importdata' => site_url('Hobbies/import'),
			'sample' => site_url('Hobbies/sample'),
			'samplebutton' => 'Sample.csv',
			
		);
		$this->load->view('hobbies/index',$data);
	}
	public function create()
	{
		// call form.php from hobbies folder
		$data = array(
			'page_title' => 'Create - Manage-Hobbies',
			'heading' => 'Guestbook', 
			'screen' => 'Create Hobby',
			'action' => site_url('Hobbies/create_action'),
			'button' => 'Create',
			'cancel' => 'Cancel', 
			'cancel_action' => site_url('Hobbies/index'),
			'hobby_title' => set_value('hobby_title',$this->input->post('hobby_title',TRUE)),
			'status' => set_value('status',$this->input->post('status',TRUE)),
			
		);
		$this->load->view('hobbies/form',$data);
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
				$checkhobbytitle=$this->Hobbies_model->GetData("hobbies","hobby_title","hobby_title='".$this->input->post('hobby_title',TRUE)."'","","","","");
				if(!empty($checkhobbytitle))
				{
					$this->session->set_flashdata('warning','Hobby is already exist');
					redirect('Hobbies/create');
				}
				else
				{
					$data = array(
						'token' => md5('Hobbies-token'.time().rand(1000,9999)),
						'hobby_title' => ucfirst($this->input->post('hobby_title',TRUE)),
						'status' => $this->input->post('status')
					);
					$this->Hobbies_model->SaveData('hobbies',$data);
					$this->session->set_flashdata('success','Hobby has been created successfully');
					redirect('Hobbies/index');
				}
			}
		}
		else
		{
			redirect("Hobbies/create");
		}
	}
	public function update($id)
	{
		$getsinglehobbies= $this->Hobbies_model->GetData("hobbies","","token='".base64_decode($id)."'","","","","single");
		if(!empty($getsinglehobbies))
		{	
			$data = array(
				'page_title' => 'Update - Manage-Hobbies',
				'heading' => 'Guestbook', 
				'screen' => 'Update Hobby',
				'action' => site_url('Hobbies/update_action/'.$id),
				'button' => 'update',
				'cancel' => 'Cancel', 
				'cancel_action' => site_url('Hobbies/index'),
				'hobby_title' => set_value('hobby_title',$getsinglehobbies->hobby_title),
				'status' => set_value('status',$getsinglehobbies->status),
			);
			$this->load->view('hobbies/form',$data);
		}
		else
		{
			redirect("Hobbies/index");
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
				$checkhobbytitle=$this->Hobbies_model->GetData("hobbies","","hobby_title='".$this->input->post('hobby_title',TRUE)."' and token !='".base64_decode($id)."'","","","","");
				if(!empty($checkhobbytitle))
				{
					$this->session->set_flashdata('warning','Hobby is already exist');
					redirect('Hobbies/update/'.$id);
				}
				else
				{
					$data = array(
						'hobby_title' => ucfirst($this->input->post('hobby_title',TRUE)),
						'status' => $this->input->post('status')
					);
					$this->Hobbies_model->SaveData('hobbies',$data,"token ='".base64_decode($id)."'");
					$this->session->set_flashdata('success','Hobby has been created successfully');
					redirect('Hobbies/index');
				}
			}
		}
		else
		{
			redirect("Hobbies/update/".$id);
		}
	}
	public function delete_action($id)
	{
		// call delete function from model with id/token
		$gethobbydata = $this->Hobbies_model->GetData("hobbies","","token ='".base64_decode($id)."'","","","","1");
		$gethobbymapdata=$this->Hobbies_model->GetData("guests","id","hobby_id LIKE('%".$gethobbydata->id."%')","","","","");
		if(!empty($gethobbymapdata))
		{
			$this->session->set_flashdata('warning','Hobby is already mapped');
			redirect('Hobbies/index');
		}
		else
		{
			$this->Hobbies_model->DeleteData("hobbies","id ='".$gethobbydata->id."'");
			$this->session->set_flashdata('error',"Hobby record has been deleted successfully");
			redirect('Hobbies/index');
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
						$gethobbydata=$this->Hobbies_model->GetData("hobbies","id","token='".base64_decode($token[$i])."'","","","","");
						
						foreach($gethobbydata as $gethobby)
						{
							$gethobbymapdata=$this->Hobbies_model->GetData("guests","id","hobby_id LIKE('%".$gethobby->id."%')","","","","");
							if(!empty($gethobbymapdata))
							{
								$nondel++;
							}
							else
							{
								$this->Hobbies_model->DeleteData("hobbies","id ='".$gethobby->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." Guest record has been deleted"."<br/>".$nondel." Guest record not deleted";
					$this->session->set_flashdata('error',$massage);
					redirect('Hobbies/index');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect('Hobbies/index');
			}
		}
	}
	public function export()
	{
		$dataidcollect = $this->input->post('exportidcollect');
		$this->Hobbies_model->ExportData("hobbies","hobby_title,status,created",$dataidcollect);
	}
	public function sample()
	{
		$this->Hobbies_model->SampleData("hobbies","hobby_title");
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
                if (!$this->upload->do_upload('file')){
					$this->session->set_flashdata("error","File not uploaded");
					redirect('Hobbies/index');					
				}else{
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					//reading upload file
					$file = fopen("assets/files/".$filename,"r");
					$i = 0;
					$numberOfFields = 1; // total number of fields
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
					$skip = 0;
					//insert import data
					foreach($importData_arr as $hobbyData){
						//skip first row
						if($skip != 0){
							$hobbyduplication = $this->Hobbies_model->GetData("hobbies","hobby_title","hobby_title='".$hobbyData[0]."'");
							if(!empty($hobbyduplication))
							{
								$dup++;
							}
							else
							{
								$this->Hobbies_model->ImportData($hobbyData);
							}
						}
							$skip++;
					}
					$totalrecords = count(file("assets/files/".$filename));
					$this->session->set_flashdata("warning",$dup." duplicate hobbies record found");
					$recordimport = ($totalrecords-1)-$dup;
					$this->session->set_flashdata("success",$recordimport." Records imported");
					$this->session->set_flashdata("info",($totalrecords-1)." Total records");
					redirect('Hobbies/index');
				}
			}else{
				$this->session->set_flashdata("error","Please select csv file");	
				redirect('Hobbies/index');
			}
		}
	}
	/* 
		==================================
		Validation For
		1. Create Hobby
		2. Update Hobby
		==================================
	*/
	public function validate($id='')
	{
		if($id)
		{
			$this->form_validation->set_rules('hobby_title','Hobby','required|regex_match[/^[a-zA-Z- ]*$/]');
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
		else
		{
			$this->form_validation->set_rules('hobby_title','Hobby','required|alpha|regex_match[/^[a-zA-Z- ]*$/]');
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
	}
}
?>