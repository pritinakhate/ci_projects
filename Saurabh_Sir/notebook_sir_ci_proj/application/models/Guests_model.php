<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Guests_model extends CI_Model 
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
	public function GetGuestsData($table,$fields='',$condition='',$order='')
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
		if($order !=''){
			$this->db->order_by($order);
		}
		$return = $this->db->get($table)->result();
		return $return;
	}
	public function GetGuestsLog($table,$fields='',$condition='',$order='')
	{
		$this->db->select($fields);
		$this->db->join('guests','guests.id = guest_logs.guest_id','left');
		$this->db->join('countries','countries.id = guest_logs.country_id','left');
		$this->db->join('states','states.id = guest_logs.state_id','left');
		$this->db->join('cities','cities.id = guest_logs.city_id','left');
		$this->db->join('hobbies','hobbies.id = guest_logs.hobby_id','left');
		if($condition !=''){
			$this->db->where($condition);
		}
		if($order !=''){
			$this->db->order_by($order);
		}
		$return = $this->db->get($table)->result();
		return $return;
	}
	public function GetGuestsexportData($table,$fields='',$condition='',$result='')
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
	public function ExportData($table,$fields='',$condition='')
	{
		$guestid = explode(",",$condition);

		$output = '';
		//Get column names from table
		$columns = array();
		if(!empty($fields))
		{
			$columns = explode(",",$fields);
			$output .= $fields;
		}
		$output .="\n";

		//print_r($guestid ); //exit;
		// get records against column from table
		for($j=0; $j<count($guestid) ;$j++){
			$data[] = $this->Guests_model->GetGuestsexportData("guests","users.name as username,guests.name,guests.email_address,guests.address,guests.details_about_guest,guests.dob,countries.country_name as country,states.state_name as state,cities.city_name as city,guests.hobby_id as hobby,guests.gender,guests.status,guests.created","guests.id='".$guestid[$j]."' and guests.user_id = '".$this->session->userdata('id')."'","1");
		}

		// print_r($data); exit;


		foreach($data as $row)
		{	
			for($i=0; $i< count($columns); $i++)
			{
				$field = $columns[$i];
				// To get hobby_title against hobby_id
				$hobbyid ='';
				if($columns[$i] == 'hobby')
				{
					// print_r($columns); exit();
					$field = $columns[$i];
					$hobbyid = $row->hobby;
					$gethobby = explode(",",$hobbyid);
					$hobbycount= count($gethobby);
					$hobby_title = " ";
					for($j=0;$j<$hobbycount;$j++)
					{
						$hobbycollect= $this->Guests_model->GetData("hobbies","hobby_title","id= '".$gethobby[$j]."'","","hobby_title","","");
						foreach($hobbycollect as $hobbyrow)
						{
							$hobby_title .= $hobbyrow->hobby_title; 
						}
						if($j<$hobbycount-1)
						{
							$hobby_title .= ", ";
						} 
					}
					$output .= str_replace(","," | ",$hobby_title).",";
					// print_r($output); exit();
				}
				else
				{
					$output .= str_replace(",","|",$row->$field).",";
				}
			}
			$output .="\n";
		}
		//print_r($output); exit();
		echo($output);
		//Export data in to csv format
		header('Content-type: application/csv');
		$date= date('Y-m-d-H:i:s');
		$filename ="guest_export_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}
	public function ImportData($record)
	{
		if(count($record)  > 0)
		{	
			$this->db->select('*');
			$this->db->where('email_address',$record[1]);
			$return = $this->db->get('guests');
			$response = $return->result_array();

			if(count($response) == 0)
			{
				$import = array(
					'token' => md5("guests_token".time().rand(1000,9999)),
					'user_id' => $this->session->userdata('id'),
					'name' => ucwords(trim($record[0])),
					'email_address' => strtolower(trim($record[1])),
					'address' => ucwords(trim($record[2])),
					'details_about_guest' => ucwords(trim($record[3])),
					'dob' => date('Y-m-d',strtotime(trim($record[4]))),
					'gender' => trim($record[5]),
					'country_id' => trim($record[6]),
					'state_id' => trim($record[7]),
					'city_id' => trim($record[8]),
					'hobby_id' => $record[9],
					'created' => date("Y-m-d H:i:s"),
				);
				$this->db->insert('guests',$import);
			}
		}
	} 
	public function SampleData($table,$fields='')
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
		
		echo($output);
		//Export data in to csv format
		header('Content-type: application/csv');
		$date= date('Y-m-d-H:i:s');
		$filename ="guest_sample_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}
	
}
?>