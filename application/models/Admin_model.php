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
}
