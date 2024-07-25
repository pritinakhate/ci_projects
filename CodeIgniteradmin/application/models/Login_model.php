<?php
defined("BASEPATH") or exit("No direct script access allowed");


class Login_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function signup($resdata)
    {
        $this->db->insert('users', $resdata);
    }




    public function getdata(
        $table,
        $field = '',
        $condition = '',
        $orderby = '',
        $value = 0
    ) {
        if ($field != '') {
            $this->db->select($field);
        }
        if ($condition != '') {
            $this->db->where($condition);
        }
        if ($orderby != '') {
            $this->db->where($orderby);
        }
        $query = $this->db->get($table);
        if ($value == 1) {
            return $query->row();
        } else {
            return $query->result();
        }
    }

    public function getdata1(
        $table,
        $field = '',
        $condition = '',
        $orderby = '',
        $value = 0
    ) {
        if ($field != '') {
            $this->db->select($field);
        }
        if ($condition != '') {
            $this->db->where("role", $condition);
        }
        if ($orderby != '') {
            $this->db->where($orderby);
        }
        $query = $this->db->get($table);
        if ($value == 1) {
            return $query->row();
        } else {
            return $query->result();
        }
    }

    public function deletedata($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }


    // public function savedata($table, $field = '', $condition = '')
    // {
    //     $DataArray = array();
    //     $table_fields = $this->db->list_fields($table);
    //     foreach ($data as $field => $value) {
    //         if (in_array($field, $table_fields)) {
    //             $DataArray[$field] = $value;
    //         }
    //     }
    //     if ($condition != '') {
    //         $DataArray['modified'] = date("Y-m-d H:i:s");
    //         $this->db->where($condition);
    //         $this->db->update($table, $DataArray);
    //     } else {
    //         $DataArray['created'] = date("Y-m-d H:i:s");
    //         $this->db->insert($table, $DataArray);
    //     }
    // }

    public function savedata($table, $data, $condition = '')
    {
        // Initialize an array to hold valid data fields
        $DataArray = array();

        // Get the list of fields in the specified table
        $table_fields = $this->db->list_fields($table);

        // Iterate through the provided data to filter out invalid fields
        foreach ($data as $field => $value) {
            if (in_array($field, $table_fields)) {
                $DataArray[$field] = $value;
            }
        }

        // Set timestamp for created or modified
        $now = date("Y-m-d H:i:s");

        // Add created/modified timestamps
        if ($condition != '') {
            $DataArray['modified'] = $now;
        } else {
            $DataArray['created'] = $now;
        }

        // Perform either an update or an insert based on the presence of a condition
        if ($condition != '') {
            $this->db->where($condition);
            $this->db->update($table, $DataArray);
        } else {
            $this->db->insert($table, $DataArray);
        }
    }
}
