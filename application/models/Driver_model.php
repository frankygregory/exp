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
			"group_id" => $data["group_id"],
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
		$this->db->where("created_by", $user_id);
		return $this->db->get("m_driver")->result();
	}
	
	public function deleteDriver($driver_id) {
		$this->db->where("driver_id", $driver_id);
		$this->db->delete("m_driver");
		return $this->db->affected_rows();
	}
}
