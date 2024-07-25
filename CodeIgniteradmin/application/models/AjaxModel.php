<?php
class AjaxModel extends CI_Model
{
	public function saveData($data)
	{
		if ($this->db->insert('ajaxs', $data)) {
			return 1;
		} else {
			return 0;
		}
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
			$this->db->orderby($orderby);
		}
		$query = $this->db->get($table);
		if ($value == 1) {
			return $query->row();
		} else {
			return $query->result();
		}
	}
}
