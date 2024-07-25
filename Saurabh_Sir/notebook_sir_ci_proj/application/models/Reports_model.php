<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	public function GetData($table,$field='',$condition='',$order='',$group='',$limit='',$result='')
	{
		if($field !='')
			$this->db->select($field);
		if($condition !='')
			$this->db->where($condition);
		if($order !='')
			$this->db->order_by($order);
		if($limit !='')
			$this->db->limit($limit);
		if($group !='')
			$this->db->group_by($group);
		if($result !='')
		{
			$return = $this->db->get($table) ->row();
		}
		else
		{
			$return = $this->db->get($table) ->result();
		}
		return $return;
	}
	public function SaveData($table,$data,$condition='')
	{
		$DataArray = array();
		$table_fields = $this->db->list_fields($table);
		foreach($data as $field=>$value)
		{
			if(in_array($field,$table_fields))
			{
				$DataArray[$field] = $value;
			}
		}
		if($condition !='')
		{
			$DataArray['modified']=date("Y-m-d H:i:s");
			$this->db->where($condition);
			$this->db->update($table, $DataArray);
		}
		else
		{
			$DataArray['created']=date("Y-m-d H:i:s");
			$this->db->insert($table, $DataArray);
		}
		
	}
	public function DeleteData($table,$condition)
	{
		$this->db->where($condition);
		$this->db->delete($table);
	}
	public function GetGuestsData($table,$fields='',$condition='')
	{
		$this->db->select($fields);
		$this->db->join('users','users.id = guests.user_id','left');
		$this->db->join('countries','countries.id = guests.country_id','left');
		$this->db->join('states','states.id = guests.state_id','left');
		$this->db->join('cities','cities.id = guests.city_id','left');
		$this->db->join('hobbies','hobbies.id = guests.hobby_id','left');
		if(!empty($condition)){
			$this->db->where($condition);
		}
		$return = $this->db->get($table)->result();
		return $return;
	}
	public function GetGuestsExportData($table,$fields='',$condition='',$result='')
	{
		$this->db->select($fields);
		$this->db->join('users','users.id = guests.user_id','left');
		$this->db->join('countries','countries.id = guests.country_id','left');
		$this->db->join('states','states.id = guests.state_id','left');
		$this->db->join('cities','cities.id = guests.city_id','left');
		$this->db->join('hobbies','hobbies.id = guests.hobby_id','left');
		if(!empty($condition)){
			$this->db->where($condition);
		}
		if($result !='')
		{
			$return = $this->db->get($table) ->row();
		}
		else
		{
			$return = $this->db->get($table) ->result();
		}
		return $return;
	}
	public function time_ago($timestamp)
	{
		$time_ago = strtotime($timestamp);
		$current_time = time();
		$time_difference = $current_time  - $time_ago;
		$seconds = $time_difference;
		$minutes = round($seconds/60);
		$hours = round($seconds/3600);
		if($seconds <=60)
		{
			return "Just Now";
		}
		else if($minutes <=60)
		{
			if($minutes==1)
			{
				return "1 minute ago";
			}
			else
			{
				return "$minutes minute ago";
			}
		}
		else if($hours <=24)
		{
			if($hours==1)
			{
				return "an hour ago";
			}
			else
			{
				return "$hours hours ago";
			}
		}
		else
		{
			return $timestamp;
		}
	}
	public function UserExportData($table,$fields='',$condition='')
	{
		$userid = explode(",",$condition);
		$output = '';
		//Get column names from table
		$columns = array();
		if(!empty($fields))
		{
			$columns = explode(",",$fields);
			$output .= $fields;
		}
		$output .="\n";
		// get records against column from table
		for($j=0; $j<count($userid); $j++)
		{
			$return[] = $this->Reports_model->GetData("users","name,email_address,dob,gender,status,created","id = '".$userid[$j]."'","","","","1");			
		}
		foreach($return as $row)
		{
			for($i=0; $i< count($columns); $i++)
			{
				$field = $columns[$i];
				$output .= str_replace(",","|",$row->$field).",";
			}
			$output .="\n";
		}
		echo($output);
		//Export data in to csv format
		header('Content-type: application/csv');
		$date= date('Y-m-d-H:i:s');
		$filename ="usersearch_export_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}
	public function GuestExportData($table,$fields='',$condition='')
	{
		$guestid = explode(",",$condition);
		//print_r($guestid); exit();
		$output = '';
		//Get column names from table
		$columns = array();
		if(!empty($fields))
		{
			$columns = explode(",",$fields);
			$output .= $fields;
		}
		$output .="\n";
		// get records against column from table
		for($j=0; $j<count($guestid); $j++)
		{
			$data[] = $this->Reports_model->GetGuestsExportData("guests","users.name as username,guests.name,countries.country_name as country,states.state_name as state,cities.city_name as city,guests.gender,guests.status,guests.created","guests.id='".$guestid[$j]."'","1");
		}
		foreach($data as $row)
		{
			for($i=0; $i< count($columns); $i++)
			{
				$field = $columns[$i];
				$output .= str_replace(",","|",$row->$field).",";
			}
			$output .="\n";
		}
		echo($output);
		//print_r($output); exit();
		//Export data in to csv format
		header('Content-type: application/csv');
		$date= date('Y-m-d-H:i:s');
		$filename ="guestsearch_export_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}
}
?>