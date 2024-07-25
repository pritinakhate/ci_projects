<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Reports_model');
	}
	public function index()
	{
		$data = array(
			'page_title' => 'Report',
			'screen' => 'SEARCH REPORT',
			'button' => 'User Search',
			'button_action' => site_url('Reports/search_user'),
			'report' => 'Guest Search',
			'report_action'=> site_url('Reports/search_guest'),
			'records' => 'Report'
		);
		$this->load->view('users/index',$data);
	}
		
		public function search_user()
		{
			$data = array(
			'page_title' => 'User Report',
			'screen' => 'Search User',
			'action' => site_url('Reports/usersearch_action'),
			'button' => 'Search',
			'cancel' => 'Cancel',
			'cancel_action' => site_url('Reports/index'),
			'records' => 'User Report',
			'reset' => 'Reset',
			'reset_action'=> site_url('Reports/search_user'),
			'name' => set_value('name',$this->input->post('name',TRUE)),
			'from_date' => set_value('from_date',$this->input->post('from_date',TRUE)),
			'to_date' => set_value('to_date',$this->input->post('to_date',TRUE)),
			'gender' => set_value('gender',$this->input->post('gender',TRUE)),
			'status' => set_value('status',$this->input->post('status',TRUE))
			);
			$this->load->view('reports/user_report',$data);
		}
		public function usersearch_action()
		{
			if(isset($_POST) && !empty($_POST))
			{
				$this->validate_report();
				if ($this->form_validation->run() == FALSE)
				{
					$this->search_user();
				}
				else
				{
					$condition = "created between '".$this->input->post('from_date')."' and '".$this->input->post('to_date')."' and role='User' ";
					if(!empty($this->input->post('name')))
					{
						$condition .= "and name like '%".$this->input->post('name')."%'";
					}
					if(!empty($this->input->post('gender')))
					{
						$condition .= "and gender = '".$this->input->post('gender')."'";
					}
					if(!empty($this->input->post('status')))
					{
						$condition .= " and status ='".$this->input->post('status')."'";
					}
					$userdata = $this->Reports_model->GetData("users","",$condition,"","","","");
					$data = array(
						'userdata' => $userdata,
						'page_title' => 'Report',
						'screen' => 'Search User',
						'action' => site_url('Reports/usersearch_action'),
						'button' => 'Search',
						'records' => 'User Report',
						'getData' => 'data',
						'export' => 'Export',
						'export_action'=> site_url('Reports/user_export'),
						'reset' => 'Reset',
						'reset_action'=> site_url('Reports/search_user'),
						'name' => set_value('name',$this->input->post('name',TRUE)),
						'from_date' => set_value('from_date',$this->input->post('from_date',TRUE)),
						'to_date' => set_value('to_date',$this->input->post('to_date',TRUE)),
						'gender' => set_value('gender',$this->input->post('gender',TRUE)),
						'status' => set_value('status',$this->input->post('status',TRUE)),
						'condition' => $condition
					);
					//print_r($data); exit();
					$this->load->view('reports/user_report',$data);
				}
			}
			else
			{
				redirect('Reports/search_user');
			}
		}
		public function user_export()
		{
			$userid = $this->input->post("userreportidcollect");
			$this->Reports_model->UserExportData("users","name,email_address,dob,gender,status,created",$userid);			
		}
		public function search_guest()
		{
			$alluser=$this->Reports_model->GetData("users","","role='Admin' and status='Active'","","",""); 
			//print_r($this->db->last_query()); exit(); 
			$allcities = $this->Reports_model->GetData("cities","","status='Active'","","","");
			$data = array(
			'alluser' => $alluser,
			'allcities' => $allcities,
			'page_title' => 'Guest Report',
			'screen' => 'Search Guest',
			'action' => site_url('Reports/guestsearch_action'),
			'button' => 'Search',
			'records' => 'Guest Report',
			'reset' => 'Reset',
			'reset_action'=> site_url('Reports/search_guest'),
			'user_id' => set_value('user_id',$this->input->post('user_id',TRUE)),
			'name' => set_value('name',$this->input->post('name',TRUE)),
			'from_date' => set_value('from_date',$this->input->post('from_date',TRUE)),
			'to_date' => set_value('to_date',$this->input->post('to_date',TRUE)),
			'city_id' => set_value('city_id',$this->input->post('city_id',TRUE)),
			'gender' => set_value('gender',$this->input->post('gender',TRUE)),
			'status' => set_value('status',$this->input->post('status',TRUE)),
			);
			$this->load->view('reports/guest_report',$data);
		}
		public function guestsearch_action()
		{
			if(isset($_POST) && !empty($_POST))
			{
				$this->validate_report();
				if ($this->form_validation->run() == FALSE)
				{
					$this->search_guest();
				}
				else
				{
					$alluser=$this->Reports_model->GetData("users","","role='Admin' and status='Active'","","",""); 
					$allcities = $this->Reports_model->GetData("cities","","status='Active'","","","");
					
					if(!empty($this->input->post('user_id')))
					{
						$id = $this->input->post('user_id');
					}
					else
					{
						$id = $this->session->userdata('id');
					}
					$condition = "left(guests.created,10) between '".$this->input->post('from_date')."' and '".$this->input->post('to_date')."'";
					
					if(!empty($this->input->post('name')))
					{
						$condition .= " and guests.name like '%".$this->input->post('name')."%'  ";
					}
					if(!empty($id))
					{
						$condition .= "and guests.user_id = '".$id."'";
					} 
					if(!empty($this->input->post('city_id')))
					{
						$condition .= "and guests.city_id ='".$this->input->post('city_id')."'";
					}
					if(!empty($this->input->post('gender')))
					{
						$condition .= "and guests.gender = '".$this->input->post('gender')."'";
					}
					if(!empty($this->input->post('status')))
					{
						$condition .= " and guests.status ='".$this->input->post('status')."'";
					}


					// print_r($condition); exit;
					$guestdata = $this->Reports_model->GetGuestsData("guests","guests.id,guests.name,guests.gender,guests.status,users.name as username,guests.created,cities.city_name",$condition,"","","",""); 

					// print_r($this->db->last_query()); exit(); 


						$data = array(
						'guestdata' => $guestdata,
						'page_title' => 'Report',
						'screen' => 'Search Guest',
						'records' => 'Guest Report',
						'action' => site_url('Reports/guestsearch_action'),
						'button' => 'Search',
						'getData' => 'data',
						'alluser'=>$alluser,
						'allcities'=>$allcities,
						'reset' => 'Reset',
						'reset_action'=> site_url('Reports/search_guest'),
						'export' => 'Export',
						'export_action'=> site_url('Reports/guest_export'),
						'user_id' => set_value('user_id',$this->input->post('user_id',TRUE)),
						'name' => set_value('name',$this->input->post('name',TRUE)),
						'from_date' => set_value('from_date',$this->input->post('from_date',TRUE)),
						'to_date' => set_value('to_date',$this->input->post('to_date',TRUE)),
						'city_id' => set_value('city_id',$this->input->post('city_id',TRUE)),
						'gender' => set_value('gender',$this->input->post('gender',TRUE)),
						'status' => set_value('status',$this->input->post('status',TRUE)),
						'condition' => $condition
					);
					$this->load->view('reports/guest_report',$data);
				}
			}
			else
			{
				redirect('Reports/search_guest');
			}
		}
		public function guest_export()
		{
			$guestid = $this->input->post('guestreportidcollect');
			$this->Reports_model->GuestExportData("guests","username,name,country,state,city,gender,status",$guestid);				
		}		
		public function validate_report()
		{
			 $this ->form_validation->set_rules('from_date','From Date','required');
			$this ->form_validation->set_rules('to_date','To Date','required|callback_ToDate'); 
			$this->form_validation->set_error_delimiters('<span class="text text-danger">', '</span>');
		}
		function ToDate()
		{
			$from_date = $this->input->post("from_date");
			$to_date = $this->input->post("to_date");
			if($to_date > $from_date)
			{
				return True;
			}
			else
			{
				if(empty($to_date))
				{
					$this ->form_validation->set_message('ToDate','The %s field required');
				}else{
				$this ->form_validation->set_message('ToDate','%s should be greater than From Date');
				}
				return False;
			}
				
		}
}
?>