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

	public function verifyDeviceEmail($token) {
		$query = $this->db->query("CALL verify_device_email('" . $token . "');");
		return $query->result();
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

	public function forgotPassword($data) {
		$data["password"] = md5($data["password"]);
		$query = $this->db->query("CALL reset_user_password('" . $data["user_email"] . "', '" . $data["password"] . "');");
		return $query->result();
	}

	public function verifyResetPassword($token) {
		$query = $this->db->query("CALL verify_reset_user_password('" . $token . "');");
		return $query->result();
	}

	public function getVerificationToken($verifikasi_id) {
		$this->db->select("verifikasi_token, user_email, user_fullname");
		$this->db->where("verifikasi_status", 1);
		$this->db->limit("1");
		return $this->db->get("verifikasi")->result();
	}
}
