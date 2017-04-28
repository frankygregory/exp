<?php

class Kiriman_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getKirimanSaya($user_id) {
		$query = $this->db->query(
			"SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.location_from_name, m.location_to_name, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COUNT(t.bidding_id) AS bidding_count
			FROM `m_shipment` m
			LEFT JOIN `t_bidding` t
			ON m.shipment_id = t.shipment_id
			WHERE m.user_id = " . $user_id . "
			GROUP BY t.shipment_id"
		);
		return $query->result();
	}
}
