<?php

class Profil_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getUser($user_id) {
		$query = $this->db->query("
			SELECT *
			FROM `m_user`
			WHERE user_id = '" . $user_id . "'
		");
		return $query->result();
	}
}
