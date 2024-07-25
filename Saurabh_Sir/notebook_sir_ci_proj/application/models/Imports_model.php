<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Imports_model extends CI_Model 
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
	public function GetDetailsData($table,$fields='',$condition='',$order='')
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
	public function ImportData($record)
	{
		if(count($record)  > 0)
		{	
			$this->db->select('*');
			$this->db->where('email_address',$record[1]);
			$return = $this->db->get('imports');
			$response = $return->result_array();

			if(count($response) == 0)
			{
				$import = array(
					'token' => md5("imports_token".time().rand(1000,9999)),
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
				$this->db->insert('imports',$import);
			}
		}
	}
}
?>