<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Settings_model');
		if($this->session->userdata('role')=='User')
		{
			$this->session->set_flashdata('error','Unauthorized Access!!'); 
			redirect('Users/index');
		}
	}
	public function index()
	{
		// Manage/List page from guests folder
		$allsettings = $this->Settings_model->GetData("settings","","","","","","");
		$data = array(
			'page_title' => 'Manage-Setting',
			'heading' => ' Guestbook',
			'screen' => 'MANAGE SETTING',
			'cancel' => 'Back',
			'cancel_action' => site_url('Settings/index'),
			'records' => 'Setting Records',
			'allsettings' => $allsettings
		);
		$this->load->view('settings/index',$data);
	}
	 public function update($id)
	{
		// call form.php with data against id/token
		$getsinglesetting = $this->Settings_model->GetData("settings","","token='".base64_decode($id)."'","","","","1");
			$data = array(
				'page_title' => 'Update - Manage-Setting',
				'screen' => 'Update Setting',
				'action' => site_url('Settings/update_action/'.$id),
				'button' => 'Update',
				'cancel' => 'Cancel',
				'cancel_action' => site_url('Settings/index'),
				'title' =>  set_value('title',$getsinglesetting->title),
				'tagline' =>  set_value('tagline',$getsinglesetting->tagline),
				'logo' =>  set_value('logo',$getsinglesetting->logo),
				'footer_note' =>  set_value('footer_note',$getsinglesetting->footer_note),
			);
			$this->load->view('settings/form',$data);
	}
	public function update_action($id)
	{
		if(isset($_POST) && !empty($_POST))
		{
			$this->validate();
			if($this->form_validation->run()==FALSE)
			{
				$this->update($id);
			}	
			else
			{ 
				if($_FILES['logo']['error']==0)
				{
					$config['file_name'] 	 = $_FILES['logo']['name'];
					$config['encrypt_name']  = TRUE;
					$config['upload_path'] 	 = 'uploads/settings_photo/';
					$config['allowed_types'] = 'jpeg|jpg|png';			
					$config['max_size']  	 = 100;
					$config['max_width']     = 500;
					$config['max_height']    = 500;
					$config['is_image'] = 1;	
					$config['remove_spaces'] = TRUE;				

					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('logo'))
					{
						$this->session->set_flashdata('error',$this->upload->display_errors());
						redirect("settings/update/".$id);
					}
					else
					{ 
						$getsinglesettings = $this->Settings_model->GetData("settings","logo","token='".base64_decode($id)."'","","","","single");
						$new_photo = $this->upload->data('file_name');
						unlink("uploads/settings_photo/".$getsinglesettings->logo);
					} 
				}
				else
				{
					$new_photo = $this->input->post("old_logo",TRUE);
				}
				$data = array(
				'title' => ucwords($this->input->post('title',TRUE)),
				'tagline' => ucwords($this->input->post('tagline',TRUE)),
				'logo' => $new_photo,
				'footer_note' => $this->input->post('footer_note',TRUE)
				);
				$this->Settings_model->SaveData('settings',$data,"token='".base64_decode($id)."'");
				$this->session->set_flashdata('success','Setting has been updated successfully');
				redirect('Settings/index');
			}
		}
		else
		{
			redirect("Settings/update/".$id);
		}
				
	}
	/* 
	==================================
	Validation For 
	1. Create Guest
	2. Update Guest
	==================================
	*/
	 public function validate()
	{
		$this->form_validation->set_rules('title','Title','required|regex_match[/^[a-zA-Z- ]*$/]');
		$this ->form_validation->set_rules('tagline','Tagline','required');
		$this ->form_validation->set_rules('footer_note','Footer Note','required');
		$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
	}  
}
?>