<?php

class Alat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function addAlat($data) {
		$insertData = array(
			"device_name" => $data["device_name"],
			"device_information" => $data["device_information"],
			"device_email" => $data["device_email"],
			"device_status" => $data["device_status"],
			"user_id" => $data["user_id"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
			
		$this->db->insert("m_device_customer", $insertData);
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
		$query = $this->db->query("
			SELECT m.*, COALESCE(d.shipment_id, '') AS shipment_id
			FROM `m_device_customer` m
			LEFT JOIN `m_device_details` d
			ON m.device_id = d.device_id AND d.device_details_status = 1
			WHERE m.user_id = '" . $user_id . "' AND m.device_status != -1
			GROUP BY m.device_id
		");
		return $query->result();
	}
	
	public function deleteAlat($device_id, $user_id) {
		$query = $this->db->query("
			UPDATE `m_device_customer`
			SET device_status = -1, modified_by = '" . $user_id . "'
			WHERE device_id = '" . $device_id . "'
		");
		return 1;
	}
}
