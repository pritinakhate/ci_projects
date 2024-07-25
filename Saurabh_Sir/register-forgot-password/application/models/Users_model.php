<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends CI_Model 
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
	public function GetUsersData($table,$fields='',$condition='')
	{
		$this->db->select($fields);
		$this->db->join('guests','users.id = guests.user_id');
		if(!empty($condition)){
			$this->db->where($condition);
		}
		$return = $this->db->get($table)->result();
		return $return;
	}
	public function GetTotalCount($id)
	{
		$gettotalguests = count($this->Users_model->GetData("guests","id","user_id='".$id."'",""));
		return $gettotalguests;
	}
	public function GetMaleCount($id)
	{
		$getmaleguests = count($this->Users_model->GetData("guests","id","gender='Male' and user_id='".$id."'",""));	
		return $getmaleguests;
	}
	public function GetFemaleCount($id)
	{
		$getfemaleguests = count($this->Users_model->GetData("guests","id","gender='Female' and user_id='".
		$id."'",""));
		return $getfemaleguests;
	}
	public function GetTotalguests()
	{
		$gettotalguests = count($this->Users_model->GetData("guests","id","user_id='".$this->session->userdata('id')."'",""));
		return $gettotalguests;
	}
	public function GetMaleguests()
	{
		$getmaleguests = count($this->Users_model->GetData("guests","id","gender='Male' and user_id='".$this->session->userdata('id')."'",""));	
		return $getmaleguests;
	}
	public function GetFemaleguests()
	{
		$getfemaleguests = count($this->Users_model->GetData("guests","id","gender='Female' and user_id='".$this->session->userdata('id')."'",""));
		return $getfemaleguests;
	}
	public function TotalUsers()
	{
		$TotalUsers = count($this->Users_model->GetData("users","id","role='User'",""));
		return $TotalUsers;
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
	public function ExportData($table,$fields='',$condition='')
	{
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
		if($fields !='')
			$this->db->select($fields);
		if($condition !='')
			$this->db->where($condition);
		$return = $this->db->get($table) ->result();
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
		$filename ="user_export_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}
}
?>