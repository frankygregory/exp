<?php

class Kendaraan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function addKendaraan($data) {
		$this->db->insert("m_vehicle", $data);
		return $this->db->affected_rows();
	}
	
	public function getKendaraanByUserId($user_id) {
		$this->db->where("user_id", $user_id);
		return $this->db->get("m_vehicle")->result();
	}
}
