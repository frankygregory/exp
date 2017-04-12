<?php

class Registration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function doRegister($data) {

        $data = array(
            'role_id' => $data['role'],
            'type_id' => $data['type'],
            'username' => $data['username'],
            'user_email' => $data['email'],
            'user_fullname' => $data['nama'],
            'user_address' => $data['alamat'],
            'user_telephone' => $data['telp'],
            'user_handphone' => $data['handphone'],
            'password' => md5($data['password']),
            'user_termsandconditions' => $data['terms'],
            'created_by' => $data['username'],
            'modified_by' => $data['username']
        );

        $this->db->insert('m_user', $data);
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
