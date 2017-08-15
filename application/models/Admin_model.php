<?php

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function login_as($data) {
		$query = $this->db->query("CALL admin_login_as('" . $data["username_or_email"] . "', '" . $data["ip"] . "', '" . $data["location"] . "', '" . $data["browser"] . "');");
		return $query->result();
	}

    public function getUnverifiedUser($data) {
        $query = $this->db->query("
            SELECT u.user_id, u.username, u.role_id, u.user_email
            FROM `m_user` u
            WHERE (u.role_id = 2 OR u.role_id = 1) AND u.user_verified = 0 AND u.user_status = 1
            ORDER BY u.created_by
            LIMIT " . $data["limit"] . " OFFSET " . $data["offset"]
        );
        return $query->result();
    }

    public function getUnverifiedUserCount() {
        $query = $this->db->query("
            SELECT COUNT(u.user_id) AS count
            FROM `m_user` u
            WHERE (u.role_id = 2 OR u.role_id = 1) AND u.user_verified = 0 AND u.user_status = 1
        ");
        return $query->result();
    }

    public function getSuratUser($user_id) {
        $query = $this->db->query("
            SELECT user_details_npwp, user_details_siup, user_details_tdp
            FROM `m_user_details`
            WHERE user_id = " . $user_id . "
            LIMIT 1
        ");
        return $query->result();
    }

    public function verifyUser($data) {
        $this->db->where("user_id", $data["user_id"]);
        $updateData = array(
            "user_verified" => 1,
            "modified_by" => $data["modified_by"]
        );
        $this->db->update("m_user", $updateData);
        return $this->db;
    }
}
