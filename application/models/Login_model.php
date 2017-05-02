<?php

class Login_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function login($username, $password) {
		$password = md5($password);
        $query = $this->db->query(
			"SELECT u.*, ug.group_id
			FROM m_user u, m_user_group ug
			WHERE u.username = '" . $username . "' AND u.password = '" . $password . "' AND ug.user_id = u.user_id"
		);
		return $query->result_array();
    }
}