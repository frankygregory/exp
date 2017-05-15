<?php

class Kendaraan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function addKendaraan($data) {
		$insertData = array(
			"vehicle_nomor" => $data["vehicle_nomor"],
			"vehicle_name" => $data["vehicle_name"],
			"vehicle_information" => $data["vehicle_information"],
			"vehicle_status" => $data["vehicle_status"],
			"group_id" => $data["group_id"],
			"user_id" => $data["user_id"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
		$this->db->insert("m_vehicle", $insertData);
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
			"vehicle_status" => $data["vehicle_status"],
			"modified_by" => $data["modified_by"]
		);
		$this->db->update("m_vehicle", $updateData);
		return $this->db->affected_rows();
	}
	
	public function getKendaraanByUserId($user_id) {
		$query = $this->db->query("
			SELECT m.*, COALESCE(d.shipment_id, '') AS shipment_id
			FROM `m_vehicle` m
			LEFT JOIN `m_vehicle_details` d
			ON m.vehicle_id = d.vehicle_id AND d.vehicle_details_status = 1
			WHERE m.user_id = '" . $user_id . "'
			GROUP BY m.vehicle_id
		");
		return $query->result();
	}
	
	public function deleteKendaraan($vehicle_id) {
		$this->db->where("vehicle_id", $vehicle_id);
		$this->db->delete("m_vehicle");
		return $this->db->affected_rows();
	}
}
