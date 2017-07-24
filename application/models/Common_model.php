<?php

class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function getUsername($username) {
		$this->db->select('username');
		$this->db->where('username', $username);
		$this->db->where("verifikasi_status", 0);
		$this->db->limit(1);
		return $this->db->get('verifikasi')->result();
	}
	
	public function getEmail($email) {
		$this->db->select('user_email');
		$this->db->where('user_email', $email);
		$this->db->where("verifikasi_status", 0);
		$this->db->limit(1);
		return $this->db->get('verifikasi')->result();
	}
	
}
