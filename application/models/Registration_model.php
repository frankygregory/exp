<?php

class Registration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function doRegister($data) {

        $data["password"] = md5($data["password"]);
		
		$query = $this->db->query("CALL register_user('" . $data["role"] . "', '" . $data["type"] . "', '" . $data["username"] . "', '" . $data["email"] . "', '" . $data["nama"] . "', '" . $data["alamat"] . "', '" . $data["telp"] . "', '" . $data["handphone"] . "', '" . $data["password"] . "', '" . $data["terms"] . "');");
		return $query->result();
    }

	public function verifyEmail($token) {
		$query = $this->db->query("CALL verify_user_email('" . $token . "');");
		return $query->result();
	}
	
	public function getUsername($username) {
		$this->db->select('username');
		$this->db->where('username', $username);
		return $this->db->get('m_user')->result();
	}
	
	public function getEmail($email) {
		$this->db->select('user_email');
		$this->db->where('user_email', $email);
		return $this->db->get('m_user')->result();
	}
}
