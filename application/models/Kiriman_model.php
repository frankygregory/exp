<?php

class Kiriman_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getKirimanSaya($user_id) {
		$query = $this->db->query(
			"SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.shipment_status, m.location_from_name, m.location_to_name, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COUNT(t.bidding_id) AS bidding_count, d.driver_name, v.vehicle_name, dc.device_name
			FROM `m_driver` d, `m_vehicle` v, `m_device_customer` dc, `m_shipment` m
			LEFT JOIN `t_bidding` t
			ON m.shipment_id = t.shipment_id
			WHERE m.user_id = " . $user_id . " AND d.driver_id = m.driver_id AND v.vehicle_id = m.vehicle_id AND dc.device_id = m.device_id
			GROUP BY t.shipment_id"
		);
		return $query->result();
	}
	
	public function submitRating($data) {
		$this->db->query("CALL submit_rating('" . $data["shipment_id"] . "', '" . $data["user_id"] . "', '" . $data["shipment_rating_number"] . "', '" . $data["shipment_rating_feedback"] . "');");
		return 1;
	}
}
