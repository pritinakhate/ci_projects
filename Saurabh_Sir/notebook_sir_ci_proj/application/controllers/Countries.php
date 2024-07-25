<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Countries_model');
		if($this->session->userdata('role')=='User')
		{
			$this->session->set_flashdata('error','Unauthorized Access!!'); 
			redirect('Users/index');
		}
	}
	public function index()
	{
		// Manage/List page from countries folder
		$allcountries = $this->Countries_model->GetData("countries","","","country_name","","");
		$data = array(
			'page_title' => 'Manage-Countries',
			'heading' => 'Guestbook',
			'screen' => 'MANAGE COUNTRIES',
			'button' => 'Create',
			'button_action' => site_url('Countries/create'),
			'export' => 'Export',
			'export_action'=> site_url('Countries/export'),
			'records' => 'Country Records',
			'allcountries' => $allcountries,
			'importbutton' => 'Import',
			'record' => 'Import Countries',
			'importdata' => site_url('Countries/import'),
			'sample' => site_url('Countries/sample'),
			'samplebutton' => 'Sample.csv',
		);
		$this->load->view('countries/index',$data);
	}
	public function create()
	{
		// call form.php from countries folder
		$data = array(
			'page_title' => 'Create - Manage-Countries',
			'heading' => 'Guestbook',
			'screen' => 'Create Country',
			'action' => site_url('Countries/create_action'),
			'button' => 'Create',
			'cancel' => 'Cancel',
			'cancel_action' => site_url('Countries/index'),
			'country_name' => set_value('country_name',$this->input->post('country_name',TRUE)),
			'country_code' => set_value('country_code',$this->input->post('country_code',TRUE)),
			'status' => set_value('status',$this->input->post('status',TRUE)),
		);
		$this->load->view('countries/form',$data);
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
				$checkcountryname=$this->Countries_model->GetData("countries","country_name,country_flag","country_name='".$this->input->post('country_name',TRUE)."'","","","","");
				if(!empty($checkcountryname))
				{
					$this->session->set_flashdata('warning','Country is already exist');
					redirect('Countries/create');
				}
				else
				{
					$config['file_name'] 	 = $_FILES['country_flag']['name'];
					$config['encrypt_name']  = TRUE;
					$config['upload_path'] 	 = 'uploads/country_flag_img/';
					$config['allowed_types'] = 'jpeg|jpg|png';			
					$config['max_size']  	 = 100;
					$config['max_width']     = 500;
					$config['max_height']    = 500;
					$config['is_image'] = 1;	
					$config['remove_spaces'] = TRUE;				

					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (empty($this->upload->do_upload('country_flag')))
					{
						$this->session->set_flashdata('error',$this->upload->display_errors());
						redirect("countries/create");
					}
					else
					{ 
						$data = array(
						'token' => md5('Countries-token'.time().rand(1000,9999)),
						'country_name' => ucwords($this->input->post('country_name',TRUE)),
						'country_code' => $this->input->post('country_code',TRUE),
						'country_flag' => $this->upload->data('file_name'),
						'status' => $this->input->post('status',TRUE)
						);
						$this->Countries_model->SaveData('countries',$data);
						$this->session->set_flashdata('success','Country has been created successfully');
						redirect('Countries/index');	
					} 
				}
			}
		}
		else
		{
			redirect("Countries/create");
		}
	}
	public function update($id)
	{
		$getsinglecountries = $this->Countries_model->GetData("countries","","token='".base64_decode($id)."'","","","","single");
		$data = array(
			'page_title' => 'Update - Manage-Countries',
			'heading' => 'Guestbook',
			'screen' => 'Update Country',
			'action' => site_url('Countries/update_action/'.$id),
			'button' => 'Update',
			'cancel' => 'Cancel',
			'cancel_action' => site_url('Countries/index'),
			'country_name' => set_value('country_name',$getsinglecountries->country_name),
			'country_code' => set_value('country_code',$getsinglecountries->country_code),
			'country_flag' => set_value('country_flag',$getsinglecountries->country_flag),
			'status' => set_value('status',$getsinglecountries->status),
		);
		$this->load->view('countries/form',$data);
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
				$checkcountryname=$this->Countries_model->GetData("countries","country_name,country_flag","country_name='".$this->input->post('country_name',TRUE)."' and token !='".base64_decode($id)."'","","","","");
				if(!empty($checkcountryname))
				{
					$this->session->set_flashdata('warning','Country is already exist');
					redirect('Countries/update/'.$id);
				}
				else
				{
					if($_FILES['country_flag']['error']==0)
					{
						$config['file_name'] 	 = $_FILES['country_flag']['name'];
						$config['encrypt_name']  = TRUE;
						$config['upload_path'] 	 = 'uploads/country_flag_img/';
						$config['allowed_types'] = 'jpeg|jpg|png';			
						$config['max_size']  	 = 100;
						$config['max_width']     = 500;
						$config['max_height']    = 500;
						$config['is_image'] = 1;	
						$config['remove_spaces'] = TRUE;				

						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if (empty($this->upload->do_upload('country_flag')))
						{
							$this->session->set_flashdata('error',$this->upload->display_errors());
							redirect("Countries/update/".id);
						}
						else
						{ 
							$getsinglecountries = $this->Countries_model->GetData("countries","country_flag","token='".base64_decode($id)."'","","","","single");
							$new_flag = $this->upload->data('file_name');
							unlink("uploads/country_flag_img/".$getsinglecountries->country_flag);
						} 
					}
					else
					{
						$new_flag = $this->input->post("old_flag",TRUE);
					}
					$data = array(
					'token' => md5('Countries-token'.time().rand(1000,9999)),
					'country_name' => ucwords($this->input->post('country_name',TRUE)),
					'country_code' => $this->input->post('country_code',TRUE),
					'country_flag' => $new_flag,
					'status' => $this->input->post('status',TRUE)
					);
					$this->Countries_model->SaveData('countries',$data,"token='".base64_decode($id)."'");
					$this->session->set_flashdata('success','Country has been updated successfully');
					redirect('Countries/index');
				}
			}
		}
		else
		{
			redirect("Countries/update/".$id);
		}
	}
	public function delete_action($id)
	{
		// Fetch attachment from table against id/token
		$getcountry = $this->Countries_model->GetData("countries","id,country_flag","token='".base64_decode($id)."'","","","","1");
		$country_flag = $getcountry->country_flag;
		$getcountrymapstatedata=$this->Countries_model->GetData("states","id","country_id ='".$getcountry->id."'","","","","");
		$getcountrymapguestdata=$this->Countries_model->GetData("guests","id","country_id ='".$getcountry->id."'","","","","");
		//If record found or not
		if(empty($getcountry))
		{
			redirect('Countries/index');
		}
		else
		{
			if(!empty($getcountrymapstatedata) || !empty($getcountrymapguestdata))
			{
				$this->session->set_flashdata('warning','Country is already mapped');
				redirect('Countries/index');
			}
			else
			{
				if(!empty($country_flag))
				{ 
					//Remove record from table
					$this->Countries_model->DeleteData("countries","id ='".$getcountry->id."'");
					// Remove attachment from folder 
					unlink("uploads/country_flag_img/".$country_flag);
					$this->session->set_flashdata('error','Country has been deleted successfully');
					redirect('Countries/index'); 
				}
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
				{	$del=0;$nondel=0;
					for($i=0;$i<count($token);$i++)
					{
						$getcountry=$this->Countries_model->GetData("countries","id,country_flag","token='".base64_decode($token[$i])."'","","","","");
						
						foreach($getcountry as $getcountrydata)
						{
							$getcountrymapstatedata=$this->Countries_model->GetData("states","id","country_id ='".$getcountrydata->id."'","","","","");
							$getcountrymapguestdata=$this->Countries_model->GetData("guests","id","country_id ='".$getcountrydata->id."'","","","","");
							if(!empty($getcountrymapstatedata) || !empty($getcountrymapguestdata))
							{
								$nondel++;
							}
							else
							{
								$this->Countries_model->DeleteData("countries","id ='".$getcountrydata->id."'");
								unlink("uploads/country_flag_img/".$getcountrydata->country_flag);
								$del++; 
							}
						}
					}  
					$massage= $del." Country record has been deleted"."<br/>".$nondel." Country record not deleted";
					$this->session->set_flashdata('error',$massage);
					redirect('Countries/index');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect('Countries/index');
			}
		}
	}
	public function export()
	{
		$id = $this->input->post('countryidcollect');
		$this->Countries_model->ExportData("countries","country_name,country_code,status,created",$id);
	}
	public function sample()
	{
		$this->Countries_model->SampleData("countries","country_name,country_code");
	}
	public function import()
	{
		/* print_r($_POST); 
		print_r($_FILES); 
		exit(); */
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
					redirect('Countries/index');
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
					$skip = 0; $dup = 0;
					//insert import data
					foreach($importData_arr as $countryData){
						//skip first row
						if($skip != 0){
							$countryduplication = $this->Countries_model->GetData("countries","country_name","country_name='".$countryData[0]."'");
							if(!empty($countryduplication))
							{
								$dup++;
							}
							else
							{	
								$this->Countries_model->ImportData($countryData);
							}
						}
						$skip++;
					}
					$totalrecords = count(file("assets/files/".$filename));
					$this->session->set_flashdata("warning",$dup." duplicate Countries record found");
					$recordimport = ($totalrecords-1)-$dup;
					$this->session->set_flashdata("success",$recordimport." Records imported");
					$this->session->set_flashdata("info",($totalrecords-1)." Total records");
					redirect('Countries/index');
				}
			}else{
				$this->session->set_flashdata("error","Please select csv file");	
				redirect('Countries/index');
			}
		}
	}
	/* 
	==================================
	Validation For 
	1. Create Country
	2. Update Country
	==================================
	*/
	public function validate($id='')
	
	{
		if($id != '')
		{
			$this->form_validation->set_rules('country_name','Country Name','required|regex_match[/^[a-zA-Z- ]*$/]');
			$this ->form_validation->set_rules('country_code','Country Code','required|numeric');
			/* if($_FILES['country_flag']['error']==4)
			{
				$this ->form_validation->set_rules('country_flag','Country Flag','required');
			}  */
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
		else
		{
			$this->form_validation->set_rules('country_name','Country Name','required|regex_match[/^[a-zA-Z- ]*$/]');
			$this ->form_validation->set_rules('country_code','Country Code','required|numeric');
			if($_FILES['country_flag']['error']==4)
			{
				$this ->form_validation->set_rules('country_flag','Country Flag','required');
			} 
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
	}
}
?>