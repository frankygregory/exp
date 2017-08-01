<?php

class Rekanan_model extends CI_Model
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

    public function getRekananCount($user_id) {
        $query = $this->db->query("
            SELECT COALESCE(SUM(IF (up.user_party_status <= 2, 1, 0)), 0) AS pending_count, COALESCE(SUM(IF (up.user_party_status = 3 OR up.user_party_status = 4, 1, 0)), 0) AS rekanan_count
            FROM `m_user_party` up
            WHERE up.user_id = " . $user_id . "
        ");
        return $query->result();
    }

    public function searchUsernameOrName($keyword, $user_id) {
        $query = $this->db->query("
            SELECT user_id, username, user_fullname
            FROM `m_user`
            WHERE (username LIKE '%" . $keyword . "%' OR user_fullname LIKE '%" . $keyword . "%') AND user_status = 1 AND user_id != " . $user_id . "
            LIMIT 5
        ");
        return $query->result();
    }

    public function requestRekanan($data) {
        $query = $this->db->query("CALL request_rekanan('" . $data["user_id"] . "', '" . $data["party_id"] . "');");
        return $query->result();
    }
}
