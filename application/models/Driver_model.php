<?php

class Driver_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function addDriver($data) {
		$this->db->insert("m_driver", $data);
		return $this->db->affected_rows();
	}
	
	public function getDriverByUserId($user_id) {
		$this->db->where("user_id", $user_id);
		return $this->db->get("m_driver")->result();
	}
}
