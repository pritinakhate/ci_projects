<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notices extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Notices_model');
	}
	public function index()
	{
		// Manage/List page from notices folder
		$allnotices = $this->Notices_model->GetData("notices","","","created DESC","","");
		$data = array(
			'allnotices' => $allnotices,
			'page_title' =>'Manage-Notices',
			'heading' => 'Guestbook',
			'screen' => 'MANAGE NOTICES',
			'button' => 'Create',
			'button_action' =>  site_url('Notices/create'),
			'export' => 'Export',
			'export_action'=> site_url('Notices/export'),
			'records' => 'Notice Records'
		);
		$this->load->view('notices/index',$data);
	}
	public function userindex()
	{
		// Manage/List page from notices folder
		$allnotices = $this->Notices_model->GetData("notices","","status='Active'","created DESC","","");
		$data = array(
			'allnotices' => $allnotices,
			'page_title' =>'Manage-Notices',
			'heading' => 'Guestbook',
			'screen' => 'MANAGE NOTICES',
			'button' => 'Create',
			'button_action' =>  site_url('Notices/create'),
			'export' => 'Export',
			'export_action'=> site_url('Notices/export'),
			'records' => 'Notice Records'
		);
		$this->load->view('notices/userindex',$data);
	}
	public function create()
	{
		// call form.php from notices folder
		$data = array(
			'page_title' =>'Create - Manage-Notices',
			'heading' => 'Guestbook',
			'screen' => 'Create Notice',
			'action' => site_url('Notices/create_action'),
			'button' => 'Create',
			'cancel' => 'Cancel',
			'cancel_action' => site_url('Notices/index'),
			'title' => set_value('title',$this->input->post('title',TRUE)),
			'content' => set_value('content',$this->input->post('content',TRUE)),
			'from_date' => set_value('from_date',$this->input->post('from_date',TRUE)),
			'to_date' => set_value('to_date',$this->input->post('to_date',TRUE)),
			'status' => set_value('status',$this->input->post('status',TRUE))
		);
		$this->load->view('notices/form',$data);
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
				$data = array(
					'token' => md5('Notices-token'.time().rand(1000,9999)),
					'title'	=> ucwords($this->input->post('title',TRUE)),
					'content'	=> $this->input->post('content',TRUE),
					'from_date'	=> date("Y-m-d",strtotime($this->input->post('from_date'))),
					'to_date'	=> date("Y-m-d",strtotime($this->input->post('to_date'))),
					'status'	=> $this->input->post('status')
				);
				$this->Notices_model->SaveData('notices',$data);

				$getuser= $this->Notices_model->GetData("users","id","role='User'","","","","");
				$getnotice = $this->Notices_model->GetData("notices","id","created like '%".date('Y-m-d')."%' and status = 'Active'","created DESC","","","1");
				if(empty($getnotice))
				{
					$this->session->set_flashdata('success','Notice has been created successfully');
					redirect('Notices/index');
				}
				else
				{
					$checknotice = $this->Notices_model->GetData("notice_access_logs","id","notice_id = '".$getnotice->id."'","created DESC","","","1");
					if(!empty($checknotice))
					{
						$this->session->set_flashdata('warning','Notice has been created successfully but status is Blocked');
						redirect('Notices/index');
					}
					else
					{
 						foreach($getuser as $user)
						{
							$getdata = array(
								'notice_id' => $getnotice->id,
								'user_id' => $user->id
							);	
							//print_r($getdata); exit();
						$this->Notices_model->SaveData('notice_access_logs',$getdata);
						}
						$this->session->set_flashdata('success','Notice has been created successfully');
						redirect('Notices/index');
					}
				}
			}
		}
		else
		{
			redirect('Notices/index');
		}
	}
	public function update($id)
	{
		$getsinglenotices= $this->Notices_model->GetData("notices","","token='".base64_decode($id)."'","","","","single");
		if(!empty($getsinglenotices))
		{
			$data = array(
			'page_title' =>'Update - Manage-Notices',
			'heading' => 'Guestbook',
			'screen' => 'Update Notice',
			'action' => site_url('Notices/update_action/'.$id),
			'button' => 'Update',
			'cancel' => 'Cancel',
			'cancel_action' => site_url('Notices/index'),
			'title' => set_value('title',$getsinglenotices->title),
			'content' => set_value('content',$getsinglenotices->content),
			'from_date' => set_value('from_date',$getsinglenotices->from_date),
			'to_date' => set_value('to_date',$getsinglenotices->to_date),
			'status' => set_value('status',$getsinglenotices->status)
			);
			$this->load->view('notices/form',$data);
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
				$data = array(
					'title'	=> ucwords($this->input->post('title',TRUE)),
					'content'	=> $this->input->post('content',TRUE),
					'from_date'	=> date("Y-m-d",strtotime($this->input->post('from_date'))),
					'to_date'	=> date("Y-m-d",strtotime($this->input->post('to_date'))),
					'status'	=> $this->input->post('status')
				);
				$this->Notices_model->SaveData('notices',$data,"token= '".base64_decode($id)."'");
				$this->session->set_flashdata('success','Notice has been updated successfully');
				redirect('Notices/index');
			}
		}
		else
		{
			redirect('Notices/update/'.$id);
		}
	}
	public function delete_action($id)
	{
		// call delete function from model with id/token
		$getnotice = $this->Notices_model->GetData("notices","id","token ='".base64_decode($id)."'","","","","1");
		//If record found or not
		if(empty($getnotice))
		{
			redirect('Notices/index');
		}
		else
		{
			$this->Notices_model->DeleteData("notices","id ='".$getnotice->id."'");
			$this->session->set_flashdata('error','Notice has been deleted successfully');
			redirect('Notices/index');
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
						$getnotice = $this->Notices_model->GetData("notices","id","token='".base64_decode($token[$i])."'","","","","");
						foreach($getnotice as $getnoticedata)
						{
							$this->Notices_model->DeleteData("notices","id ='".$getnoticedata->id."'");
							$del++; 
						}
					}  
					$massage= $del." Notice record has been deleted";
					$this->session->set_flashdata('error',$massage);
					redirect('Notices/index');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect('Notices/index');
			}
		}
	}
	public function bell_notice($id)
	{
		$getnotificationflag = $this->Notices_model->GetData("notice_access_logs","id","user_id='".base64_decode($id)."' and flag='Unread'","","","","");
		//print_r($this->db->last_query()); exit();
		if(!empty($getnotificationflag))
		{
			$data= array(
				'flag'=>'Read'
			);
			$bellnoticecount = $this->Notices_model->SaveData("notice_access_logs",$data,"user_id='".base64_decode($id)."'");
			redirect('users/index');
		}
		else
		{
			redirect('users/index');
		}
	}
	public function export()
	{
		$this->Notices_model->ExportData("notices","title,content,from_date,to_date,status,created","");
	}
	/* 
		==================================
		Validation For
		1. Create Notice
		2. Update Notice
		==================================
	*/
	public function validate($id='')
	{
		if($id)
		{
			$this->form_validation->set_rules('title','Title','required|alpha_numeric_spaces');
			$this->form_validation->set_rules('content','Content','required');
			$this->form_validation->set_rules('from_date','From Date','required');
			$this->form_validation->set_rules('to_date','To Date','required');
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
		else
		{
			$this->form_validation->set_rules('title','Title','required|alpha_numeric_spaces');
			$this->form_validation->set_rules('content','Content','required');
			$this->form_validation->set_rules('from_date','From Date','required');
			$this->form_validation->set_rules('to_date','To Date','required');
			$this->form_validation->set_rules('status','Status','required');
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
	}
}
?>