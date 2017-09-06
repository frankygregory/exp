<?php

class Lokasi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getMyLocation($user_id) {
		$query = $this->db->query("
			SELECT location_id, location_name, location_address, location_city, location_lat, location_lng, location_detail, location_contact, location_from, location_to
			FROM `m_location`
			WHERE created_by = '" . $user_id . "' AND location_status != -1;
		");
		return $query->result();
	}
	
	public function addLocation($data) {
		$query = $this->db->query("CALL add_location('" . $data["location_name"] . "', '" . $data["location_address"] . "', '" . $data["location_city"] . "', '" . $data["location_lat"] . "', '" . $data["location_lng"] . "', '" . $data["location_detail"] . "', '" . $data["location_contact"] . "', b'" . $data["location_from"] . "', b'" . $data["location_to"] . "', '" . $data["user_id"] . "');");
		return $query->result();
	}
	
	public function updateLocation($data) {
		$this->db->where("location_id", $data["location_id"]);
		$updateData = array(
			"location_name" => $data["location_name"],
			"location_address" => $data["location_address"],
			"location_city" => $data["location_city"],
			"location_lat" => $data["location_lat"],
			"location_lng" => $data["location_lng"],
			"location_detail" => $data["location_detail"],
			"location_contact" => $data["location_contact"],
			"location_from" => $data["location_from"],
			"location_to" => $data["location_to"],
			"modified_by" => $data["user_id"]
		);
		$this->db->update("m_location", $updateData);
		return $this->db->affected_rows();
	}
	
	public function deleteLocation($location_id, $user_id) {
		$query = $this->db->query("
			UPDATE `m_location`
			SET location_status = -1, modified_by = '" . $user_id . "'
			WHERE location_id = '" . $location_id . "'
		");
	}
}
