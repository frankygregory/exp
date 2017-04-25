<?php

class Alat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function addAlat($data) {
		$this->db->insert("m_device_customer", $data);
		return $this->db->affected_rows();
	}
	
	public function updateAlat($data) {
		$this->db->where("device_id", $data["device_id"]);
		$updateData = array(
			"device_name" => $data["device_name"],
			"device_email" => $data["device_email"],
			"device_information" => $data["device_information"],
			"device_status" => $data["device_status"],
			"modified_by" => $data["modified_by"]
		);
		$this->db->update("m_device_customer", $updateData);
		return $this->db->affected_rows();
	}
	
	public function toggleAlatAktif($data) {
		$this->db->where("device_id", $data["device_id"]);
		$updateData = array(
			"device_status" => $data["device_status"],
			"modified_by" => $data["modified_by"]
		);
		$this->db->update("m_device_customer", $updateData);
		return $this->db->affected_rows();
	}
	
	public function getAlatByUserId($user_id) {
		$this->db->where("created_by", $user_id);
		return $this->db->get("m_device_customer")->result();
	}
	
	public function deleteAlat($device_id) {
		$this->db->where("device_id", $device_id);
		$this->db->delete("m_device_customer");
		return $this->db->affected_rows();
	}
}
