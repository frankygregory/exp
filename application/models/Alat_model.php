<?php

class Alat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function addAlat($data) {
		$data["device_password"] = md5($data["device_password"]);
		
		$query = $this->db->query("CALL add_device('" . $data["device_name"] . "', '" . $data["device_information"] . "', '" . $data["device_email"] . "', '" . $data["device_password"] . "', '" . $data["device_status"] . "', '" . $data["user_id"] . "');");
		return $query->result();
	}
	
	public function updateAlat($data) {
		$this->db->where("device_id", $data["device_id"]);
		$updateData = array(
			"device_name" => $data["device_name"],
			"device_information" => $data["device_information"],
			"device_status" => $data["device_status"],
			"modified_by" => $data["modified_by"]
		);
		$this->db->update("m_device_customer", $updateData);
		return $this->db;
	}
	
	public function toggleAlatAktif($data) {
		$this->db->where("device_id", $data["device_id"]);
		$updateData = array(
			"device_status" => $data["device_status"],
			"modified_by" => $data["modified_by"]
		);
		$this->db->update("m_device_customer", $updateData);
		return $this->db;
	}

	public function gantiPassword($data) {
		$data["device_password"] = md5($data["device_password"]);
		$this->db->where("device_id", $data["device_id"]);
		$updateData = array(
			"device_password" => $data["device_password"],
			"token" => "",
			"modified_by" => $data["user_id"]
		);
		$this->db->update("m_device_customer", $updateData);
		return $this->db;
	}
	
	public function getAlatByUserId($user_id) {
		$query = $this->db->query("
			SELECT m.*, COALESCE(d.shipment_ids, '') AS shipment_ids
			FROM `m_device_customer` m
			LEFT JOIN (SELECT device_id, GROUP_CONCAT(shipment_id) AS shipment_ids FROM `m_device_details` WHERE device_details_status = 1 GROUP BY device_id) d
			ON m.device_id = d.device_id
			WHERE m.created_by = " . $user_id . " AND m.device_status != -1
			GROUP BY m.device_id
		");
		return $query->result();
	}
	
	public function deleteAlat($device_id, $user_id) {
		$this->db->where("device_id", $device_id);
		$updateData = array(
			"device_status" => -1,
			"modified_by" => $user_id
		);
		$this->db->update("m_device_customer", $updateData);
		return $this->db;
	}

	public function getAlatLocation($data) {
		$query = $this->db->query("CALL device_get_location(" . $data["device_id"] . ");");
		return $query->result();
	}

	public function getAlatLocationFromRequest($data) {
		$this->db->where("device_gps_id", $data["device_gps_id"]);
		$this->db->where("device_gps_type_status", 0);
		$this->db->limit(1);
		return $this->db->get("t_device_gps")->result();
	}

	public function getAlatLastLocation($data) {
		$this->db->where("device_id = " . $data["device_id"] . " AND device_gps_type_status = 0", null, false);
		$this->db->limit(1);
		$this->db->order_by("modified_date", "desc");
		return $this->db->get("t_device_gps")->result();
	}
}
