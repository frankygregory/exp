<?php

class Ulasan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getMyRating($user_id) {
		$query = $this->db->query("
			SELECT d.user_details_rating
			FROM `m_user_details` d
			WHERE d.user_id = '" . $user_id . "'
			LIMIT 1
		");
		return $query->result();
	}
	
	public function getMyFeedback($sort, $user_id) {
		$order_by = "";
		if ($sort == "created_date_asc") {
			$order_by = " ORDER BY rd.created_date ASC";
		} else if ($sort == "created_date_desc") {
			$order_by = " ORDER BY rd.created_date DESC";
		}
		else if ($sort == "user_details_rating_number_asc") {
			$order_by = " ORDER BY rd.user_rating_number ASC";
		}
		else if ($sort == "user_details_rating_number_desc") {
			$order_by = " ORDER BY rd.user_rating_number DESC";
		}
		
		$query = $this->db->query("
			SELECT rd.user_rating_details_id, rd.user_rating_number, rd.user_rating_feedback, rd.shipment_id, rd.created_by, rd.created_date, m.shipment_title, u.username, u.user_verified, rd.created_by
			FROM `t_user_rating_details` rd
			LEFT JOIN `m_shipment` m
			ON rd.shipment_id = m.shipment_id
			LEFT JOIN `m_user` u
			ON rd.created_by = u.user_id
			WHERE rd.user_id = '" . $user_id . "'" . $order_by . "
		");
		return $query->result();
	}
}
