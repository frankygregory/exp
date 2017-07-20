<?php

class Penawaran_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function getListKirimanUmumCount($data) {
		if ($data["order_by"] != "") {
			$data["order_by"] = " ORDER BY m." . $data["order_by"];
		}
		
		$where_shipment_max = " AND m.shipment_length <= " . $data["shipment_length_max"];
		if ($data["shipment_length_max"] == 0) {
			$where_shipment_max = "";
		}
		
		$query =  $this->db->query(
			"SELECT COUNT(m.shipment_id) AS count
			FROM `m_shipment` m, `t_bidding` t
			WHERE m.shipment_end_date > CURRENT_TIMESTAMP() AND m.shipment_status = -1 AND t.shipment_id = m.shipment_id AND t.user_id = " . $data["user_id"] . " AND m.location_from_city LIKE '%" . $data["location_from_city"] . "%' AND m.location_to_city LIKE '%" . $data["location_to_city"] . "%' AND m.shipment_length >= " . $data["shipment_length_min"] . $where_shipment_max . " AND get_lowest_bidding_price(m.shipment_id) >= " . $data["lowest_bid"]
		);
		return $query->result();
	}
	
	public function getOpenKiriman($user_id) {
		$query =  $this->db->query(
			"SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.location_from_city, m.location_to_city, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `m_shipment` m, `t_bidding` t
			WHERE m.shipment_end_date > CURRENT_TIMESTAMP() AND m.shipment_status = -1 AND t.shipment_id = m.shipment_id AND t.user_id = " . $user_id . "
			GROUP BY m.shipment_id "
		);
		return $query->result();
	}

	public function getClosedKiriman($user_id) {
		$query =  $this->db->query(
			"SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `m_shipment` m, (SELECT * FROM `t_bidding` WHERE user_id = " . $user_id . ") t
			WHERE m.shipment_status > -1 AND t.shipment_id = m.shipment_id
			GROUP BY t.shipment_id
			HAVING SUM(CASE(t.bidding_status) WHEN 1 THEN 1 ELSE 0 END) = 0"
		);
		return $query->result();
	}

	public function getKirimanCount($user_id) {
		$query = $this->db->query("
			SELECT COALESCE((SELECT COUNT(m.shipment_id)
			FROM `m_shipment` m, `t_bidding` t
			WHERE m.shipment_end_date > CURRENT_TIMESTAMP() AND m.shipment_status = -1 AND t.shipment_id = m.shipment_id AND t.user_id = " . $user_id . "
			GROUP BY m.shipment_id), 0) AS count_open,
			COALESCE((SELECT COUNT(c.shipment_id)
			FROM (SELECT m.shipment_id
			FROM `m_shipment` m, (SELECT * FROM `t_bidding` WHERE user_id = " . $user_id . ") t
			WHERE m.shipment_status > -1 AND t.shipment_id = m.shipment_id
			GROUP BY m.shipment_id
			HAVING SUM(CASE(t.bidding_status) WHEN 1 THEN 1 ELSE 0 END) = 0) c), 0) AS count_closed
		");
		return $query->result();
	}
}
