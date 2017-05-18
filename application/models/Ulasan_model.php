<?php

class Ulasan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getMyFeedback($user_id) {
		$query = $this->db->query("
			SELECT rd.user_rating_details_id, rd.user_rating_number, rd.user_rating_feedback, rd.shipment_id, rd.created_by, rd.created_date, m.shipment_title, u.username
			FROM `t_user_rating_details` rd
			LEFT JOIN `m_shipment` m
			ON rd.shipment_id = m.shipment_id
			LEFT JOIN `m_user` u
			ON rd.created_by = u.user_id
			WHERE rd.user_id = '" . $user_id . "'
		");
		return $query->result();
	}
}
