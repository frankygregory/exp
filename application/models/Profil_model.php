<?php

class Profil_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getUser($user_id) {
		$query = $this->db->query("
			SELECT u.*, ud.*
			FROM `m_user` u, `m_user_details` ud
			WHERE u.user_id = '" . $user_id . "' AND ud.user_id = u.user_id
			LIMIT 1
		");
		return $query->result();
	}
}
