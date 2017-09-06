<?php

class Kiriman_pro_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getInfoEkspedisi($shipment_id) {
		$query = $this->db->query("CALL get_all_info_kiriman(" . $shipment_id . ");");
		return $query->result();
	}

	public function getAllStatusKiriman($shipment_id) {
		$query = $this->db->query("CALL get_all_status_kiriman('" . $shipment_id . "');");
		return $query->result();
	}

	public function getOpenKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `m_shipment` m
			WHERE m.created_by = '" . $user_id . "' AND m.shipment_end_date > CURRENT_TIMESTAMP() AND m.shipment_status = -1 AND m.shipment_type = 2
			GROUP BY m.shipment_id
		");
		return $query->result();
	}

	public function getProgressKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, t.bidding_type, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `m_shipment` m
			LEFT JOIN (SELECT IF (t.bidding_type = 1, 'darat', 'laut') AS bidding_type, t.shipment_id FROM `t_bidding` t) t
			ON m.shipment_id = t.shipment_id
			WHERE m.created_by = '" . $user_id . "' AND m.shipment_type = 2 AND m.shipment_status >= 0 AND m.shipment_status <= 5
			GROUP BY m.shipment_id
			ORDER BY m.shipment_status DESC
		");
		return $query->result();
	}
	
	public function getSelesaiKiriman($user_id) {
		$this->db->query("SET group_concat_max_len = 2048;");
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, t.bidding_type, m.location_from_city, m.location_to_city, m.shipment_jenis_muatan, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `m_shipment` m
			LEFT JOIN (SELECT IF (t.bidding_type = 1, 'darat', 'laut') AS bidding_type, t.shipment_id FROM `t_bidding` t ) t
			ON m.shipment_id = t.shipment_id
			WHERE m.created_by = '" . $user_id . "' AND m.shipment_type = 2 AND m.shipment_status = 6
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getCancelKiriman($user_id) {
		$this->db->query("SET group_concat_max_len = 2048;");
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, m.cancel_by, u.username AS cancel_username, u.user_verified
			FROM `m_user` u, `m_shipment` m
			WHERE m.created_by = '" . $user_id . "' AND m.shipment_type = 2 AND m.shipment_status = 7 AND u.user_id = m.cancel_by
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getKirimanCount($user_id) {
		$query = $this->db->query("
			SELECT COALESCE(SUM(IF (m.shipment_status = -1 AND m.shipment_type = 2 AND m.shipment_end_date > CURRENT_TIMESTAMP(), 1, 0)), 0) AS open_kiriman_count, COALESCE(SUM(IF (m.shipment_status > -1 AND m.shipment_status < 6 AND m.shipment_type = 2, 1, 0)), 0) AS progress_kiriman_count, COALESCE(SUM(IF (m.shipment_status = 6 AND m.shipment_type = 2, 1, 0)), 0) AS selesai_kiriman_count, COALESCE(SUM(IF (m.shipment_status = 7 AND m.shipment_type = 2, 1, 0)), 0) AS cancel_kiriman_count
			FROM (SELECT shipment_status, shipment_type, shipment_end_date FROM `m_shipment` WHERE created_by = " . $user_id . ") m
		");
		return $query->result();
	}
	
	public function submitRating($data) {
		$this->db->query("CALL submit_rating('" . $data["shipment_id"] . "', '" . $data["user_id"] . "', '" . $data["shipment_rating_number"] . "', '" . $data["shipment_rating_feedback"] . "', '" . $data["user_id_ref"] . "');");
		return 1;
	}
	
	public function cancelShipment($data) {
		$this->db->query("CALL cancel_shipment('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
}
