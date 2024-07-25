<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Admin_model extends CI_Model{
   
    function __construct(){

        parent::__construct();
        $this->load->database();
    }

    public function getdata($table,$field='',$condition='',$orderby='', $value=0){
        if($field!=''){
            $this->db->select($field);
        }
        if($condition!=''){
            $this->db->where($condition);
        }
        if($orderby!=''){
            $this->db->where($orderby);
        }
        $query = $this->db->get($table);
        if($value==1){
            return $query->row();
        }else{
            return $query->result_array();
        }
    }
}

?>