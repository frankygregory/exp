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
	
	public function updateKendaraan($data) {
		$this->db->where("vehicle_id", $data["vehicle_id"]);
		$updateData = array(
			"vehicle_nomor" => $data["vehicle_nomor"],
			"vehicle_name" => $data["vehicle_name"],
			"vehicle_information" => $data["vehicle_information"],
			"vehicle_status" => $data["vehicle_status"],
			"modified_by" => $data["user_id"]
		);
		$this->db->update("m_vehicle", $updateData);
		return $this->db->affected_rows();
	}
	
	public function toggleKendaraanAktif($data) {
		$this->db->where("vehicle_id", $data["vehicle_id"]);
		$updateData = array(
			"vehicle_status" => $data["vehicle_status"]
		);
		$this->db->update("m_vehicle", $updateData);
		return $this->db->affected_rows();
	}
	
	public function getKendaraanByUserId($user_id) {
		$this->db->where("user_id", $user_id);
		return $this->db->get("m_vehicle")->result();
	}
	
	public function deleteKendaraan($vehicle_id) {
		$this->db->where("vehicle_id", $vehicle_id);
		$this->db->delete("m_vehicle");
		return $this->db->affected_rows();
	}
}
