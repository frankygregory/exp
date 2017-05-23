<?php

class Driver_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function addDriver($data) {
		$insertData = array(
			"driver_name" => $data["driver_name"],
			"driver_handphone" => $data["driver_handphone"],
			"driver_address" => $data["driver_address"],
			"driver_information" => $data["driver_information"],
			"driver_status" => $data["driver_status"],
			"user_id" => $data["user_id"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
			
		$this->db->insert("m_driver", $insertData);
		return $this->db->affected_rows();
	}
	
	public function updateDriver($data) {
		$this->db->where("driver_id", $data["driver_id"]);
		$updateData = array(
			"driver_name" => $data["driver_name"],
			"driver_handphone" => $data["driver_handphone"],
			"driver_address" => $data["driver_address"],
			"driver_information" => $data["driver_information"],
			"driver_status" => $data["driver_status"],
			"modified_by" => $data["modified_by"]
		);
		$this->db->update("m_driver", $updateData);
		return $this->db->affected_rows();
	}
	
	public function toggleDriverAktif($data) {
		$this->db->where("driver_id", $data["driver_id"]);
		$updateData = array(
			"driver_status" => $data["driver_status"],
			"modified_by" => $data["modified_by"]
		);
		$this->db->update("m_driver", $updateData);
		return $this->db->affected_rows();
	}
	
	public function getDriverByUserId($user_id) {
		$query = $this->db->query("
			SELECT m.*, COALESCE(d.shipment_id, '') AS shipment_id
			FROM `m_driver` m
			LEFT JOIN `m_driver_details` d
			ON m.driver_id = d.driver_id AND d.driver_details_status = 1
			WHERE m.user_id = '" . $user_id . "' AND m.driver_status != -1
			GROUP BY m.driver_id
		");
		return $query->result();
	}
	
	public function deleteDriver($driver_id, $user_id) {
		$query = $this->db->query("
			UPDATE `m_driver`
			SET driver_status = -1, modified_by = '" . $user_id . "'
			WHERE driver_id = '" . $driver_id . "'
		");
		return 1;
	}
}
