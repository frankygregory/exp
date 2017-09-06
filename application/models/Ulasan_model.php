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
			SELECT rd.user_rating_details_id, rd.user_rating_number, rd.user_rating_feedback, rd.shipment_id, rd.created_by, rd.created_date, s.shipment_title, u.username, u.user_verified, rd.user_id
			FROM `m_shipment` s, `t_bidding` b, `t_user_rating_details` rd
			LEFT JOIN `m_user` u
			ON rd.user_id = u.user_id
			WHERE b.created_by = " . $user_id . " AND b.bidding_status = 1 AND b.shipment_id = s.shipment_id AND s.shipment_id = rd.shipment_id" . $order_by . "
		");
		return $query->result();
	}
}
