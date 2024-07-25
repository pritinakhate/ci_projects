<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cscdropdown extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('role')=='User')
		{
			$this->session->set_flashdata('error','Unauthorized Access!!'); 
			redirect('Users/index');
		}
	}
	public function index()
	{
		$countrylist = $this->Common_model->LoadData("countries","id,country_name","","","country_name");
		$data = array(
			'page_title' => 'Customize-CSC',
			'heading' => 'Guestbook', 
			'button' => 'Create',
			'button_action' => site_url('Hobbies/create'),
			'cancel' => "Back",
			'cancel_action'=> site_url('Users/index'),
			'importbutton' => 'Import',
			'record' => 'Customize CSC',
			'countrylist' => $countrylist
			);
		$this->load->view('cscdropdown/csc',$data);
	}
	public function dropdown()
	{
		
		$statelist = $this->Common_model->LoadData("states","id,state_name","status='Active' and country_id='".$this->input->post('country_id')."'","","state_name");
		
		$citylist = $this->Common_model->LoadData("cities","id,city_name","status='Active' and state_id='".$this->input->post('state_id')."'","","city_name");
		$output ="";
		if(!empty($statelist))
		{	
			$output .= "<option value=''>--Select State--</option>";
			foreach($statelist as $statedata)
			{
				$output .= "<option value='".$statedata->id."'>".$statedata->state_name."</option>";
			}
			echo $output;
		}
		else if(!empty($citylist))
		{
			$output .= "<option value=''>--Select City--</option>";
			foreach($citylist as $citydata)
			{
				$output .= "<option value='".$citydata->id."'>".$citydata->city_name."</option>";
			}
			echo $output;
		}
		else
		{
			$output .= "<option value=''>--Select--</option>";
		}
		return $output;
	}
	
}