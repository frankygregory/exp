<?php

class Account_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getMyInfo($user_id) {
		$query = $this->db->query(
			"SELECT u.*, d.*, t.*
			FROM m_user u, m_user_details d, m_type t
			WHERE u.user_id = '" . $user_id . "' AND t.type_id = u.type_id AND u.user_id = d.user_id
			LIMIT 1"
		);
		return $query->result();
	}
	
	public function updateCertainField($data) {
		$this->db->where("user_id", $data["user_id"]);
		if ($data["field"] == "password") {
			$this->db->where("password", $data["old"]);
		}
		
		$updateData = array(
			$data["field"] => $data["value"],
			"modified_by" => $data["user_id"]
		);
		
		if ($data["table"] == "1") {
			$this->db->update("m_user", $updateData);
		} else {
			$this->db->update("m_user_details", $updateData);
		}
		return $this->db;
	}
	
}
