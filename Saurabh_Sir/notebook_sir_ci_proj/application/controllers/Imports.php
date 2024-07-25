<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Imports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Imports_model');
		if($this->session->userdata('role')=='User')
		{
			$this->session->set_flashdata('error','Unauthorized Access!!'); 
			redirect('Users/index');
		}
	}
	public function index()
	{
		$data = array(
			'page_title' => 'Import File',
			'heading' => ' Guestbook',
			'record' => 'Import',
			'button' => 'Upload',
			'action' => site_url('Imports/import'),
			'cancel' => 'Cancel',
			'cancel_action' => site_url("Users/index"), 
		);
		$this->load->view('users/import_view',$data);

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
                if ($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					//reading upload file
					$file = fopen("assets/files/".$filename,"r");
					$datas = [];
					foreach($file as $line)
					{
						$datas = str_getcsv($line);
					}
					print_r($datas); exit();	 
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
					$skip = 0;
					//insert import data
					foreach($importData_arr as $userData){
						//skip first row
						if($skip != 0){
							$this->Imports_model->ImportData($userData);
						}
						$skip++;
					}
					$this->session->set_flashdata("success","File successfully uploaded");
					redirect('Imports/index');
				}else{
					$this->session->set_flashdata("error","File not uploaded");
					redirect('Imports/index');
				}
			}else{
				$this->session->set_flashdata("error","Please select csv file");	
				redirect('Imports/index');
			}
		}else{
			$this->session->set_flashdata("error","Please select csv file");	
			redirect('Imports/index');
		}
	
	}
}
?>


