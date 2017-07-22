<?php

class Login_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function login($data) {
		$data["password"] = md5($data["password"]);
        $query = $this->db->query(
			"CALL try_login('" . $data["user_email"] . "', '" . $data["password"] . "', '" . $data["ip"] . "', '" . $data["location"] . "', '" . $data["browser"] . "');"
		);
		return $query->result_array();
    }
}