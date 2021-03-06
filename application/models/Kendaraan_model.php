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
			"user_id" => $data["user_id"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
		$this->db->insert("m_vehicle", $insertData);
		return $this->db;
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
		return $this->db;
	}
	
	public function toggleKendaraanAktif($data) {
		$this->db->where("vehicle_id", $data["vehicle_id"]);
		$updateData = array(
			"vehicle_status" => $data["vehicle_status"],
			"modified_by" => $data["modified_by"]
		);
		$this->db->update("m_vehicle", $updateData);
		return $this->db;
	}
	
	public function getKendaraanByUserId($user_id) {
		$query = $this->db->query("
			SELECT m.*, COALESCE(d.shipment_ids, '') AS shipment_ids
			FROM `m_vehicle` m
			LEFT JOIN (SELECT vehicle_id, GROUP_CONCAT(shipment_id) AS shipment_ids FROM `m_vehicle_details` WHERE vehicle_details_status = 1 GROUP BY vehicle_id) d
			ON m.vehicle_id = d.vehicle_id
			WHERE m.created_by = " . $user_id . " AND m.vehicle_status != -1
			GROUP BY m.vehicle_id
		");
		return $query->result();
	}
	
	public function deleteKendaraan($vehicle_id, $user_id) {
		$this->db->where("vehicle_id", $vehicle_id);
		$updateData = array(
			"vehicle_status" => -1,
			"modified_by" => $user_id
		);
		$this->db->update("m_vehicle", $updateData);
		return $this->db;
	}
}
