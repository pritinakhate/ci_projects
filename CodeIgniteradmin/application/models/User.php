<?php defined('BASEPATH') or exit("No direct script allowed");

class User extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
    public function add_guest($data)
    {

        $this->db->insert('guests', $data);
    }


    //user fetch data in table 

    public function all_data()
    {

        $query = $this->db->get('users');

        return $query->result_array();
    }


    //guest fetch data in table

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
            $this->db->$orderby($orderby, 'DESC');
        }
        $query = $this->db->get($table);
        if ($value == 1) {
            return $query->row();
        } else {
            return $query->result();
        }
    }


    public function guestdata1(
        $table,
        $field = '',
        $condition = '',
        $orderby = '',
        $value = 0,
        $user_id = ''
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

        if ($user_id !== " ") {
            $this->db->where('user_id', $user_id);
        }

        $query = $this->db->get($table);

        if ($value == 1) {
            return $query->row();
        } else {
            return $query->result();
        }
    }

    public function guest_data()
    {
        $guestquery = $this->db->get('guests');
        return $guestquery->result_array();
    }


    //forgate password

    public function savedata($table, $field = '', $condition = '')
    {
        $DataArray = array();
        $table_fields = $this->db->list_fields($table);
        foreach ($data as $field => $value) {
            if (in_array($field, $table_fields)) {
                $DataArray[$field] = $value;
            }
        }
        if ($condition != '') {
            $DataArray['modified'] = data("Y-m-d H:i:s");
            $this->db->where($condition);
            $this->update($table, $DataArray);
        } else {
            $DataArray['created'] = data("Y-m-d H:i:s");
            $this->db->insert($table, $DataArray);
        }
    }


    //Delete guest
    public function deleterecords($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('guests');
    }

    //delete user
    public function deleterecorduser($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    //update guest

    public function updatefetch($id)
    {
        $this->db->where('id', $id);
        $guestfetch = $this->db->get('guests');
        return $guestfetch->row_array();
    }

    public function updateguest($guestdata, $id)
    {
        $this->db->set($guestdata);
        $this->db->where('id', $id);
        return $this->db->update('guests', $guestdata);
    }

    //update user

    public function userfetch($id)
    {
        $this->db->where('id', $id);
        $userfetch = $this->db->get('users');
        return $userfetch->row_array();
    }

    public function updateuser($userdata, $id)
    {
        $this->db->set($userdata);
        $this->db->where('id', $id);
        return $this->db->update('users', $userdata);
    }

    //guest view page
    public function viewfetch($id)
    {
        $this->db->where('id', $id);
        $guestview = $this->db->get('guests');
        return $guestview->row_array();
    }

    //user view page
    public function viewuserfetch($id)
    {
        $this->db->where('id', $id);
        $userview = $this->db->get('users');
        return $userview->row_array();
    }

    //chnage password

    public function check_password($id, $password)
    {
        $this->db->where(["id" => $id, "password" => $password]);
        $query = $this->db->get("users");
        return $query->num_rows();
    }
    public function update_password($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update("users", $data);
    }

    //update status

    public function update_status1($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function get_user($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    //count 

    public function guesttotalcount($id)
    {
        $gettotalcount = count($this->User->getdata("guests", "id", "user_id='" . $id . "'", "", ""));
        return $gettotalcount;
    }

    public function guestmalecount($id)
    {
        $gettotalmale = count($this->User->getdata("guests", "id", "user_id='" . $id . "' and gender ='Male'", "", ""));
        return $gettotalmale;
    }
    public function guestfemalecount($id)
    {
        $gettotalcount = count($this->User->getdata("guests", "id", "user_id='" . $id . "' and gender='Female'", "", ""));
        return $gettotalcount;
    }

    public function usertotalcount()
    {
        $usertotalcount = count($this->User->getdata("users", "id", "role='User'", "", ""));
        return $usertotalcount;
    }

    public function usermalecount()
    {
        $gettotalmale = count($this->User->getdata("users", "id", "role='User' and gender ='male'", "", ""));
        return $gettotalmale;
    }
    public function userfemalecount()
    {
        $gettotalcount = count($this->User->getdata("users", "id", "role='User' and gender='female'", "", ""));
        return $gettotalcount;
    }
}