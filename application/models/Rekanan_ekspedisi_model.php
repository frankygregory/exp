<?php

class Rekanan_ekspedisi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getRekanan($user_id) {
        $query = $this->db->query("
            SELECT up.party_id, up.user_party_status, u.username AS party_username, u.user_fullname AS party_fullname
            FROM `m_user_party` up
            LEFT JOIN `m_user` u
            ON up.party_id = u.user_id
            WHERE up.user_id = " . $user_id . " AND (up.user_party_status = 3 OR up.user_party_status = 4)
        ");
        return $query->result();
    }

    public function getPendingRekanan($user_id) {
        $query = $this->db->query("
            SELECT up.party_id, up.user_party_status, u.username AS party_username, u.user_fullname AS party_fullname
            FROM `m_user_party` up
            LEFT JOIN `m_user` u
            ON up.party_id = u.user_id
            WHERE up.user_id = " . $user_id . " AND (up.user_party_status = 1 OR up.user_party_status = 2)
        ");
        return $query->result();
    }
}
