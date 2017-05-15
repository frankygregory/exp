<?php

class Kiriman_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getOpenKiriman() {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COUNT(t.bidding_id) AS bidding_count
			FROM `m_shipment` m
			LEFT JOIN `t_bidding` t
			ON m.shipment_id = t.shipment_id
			WHERE m.user_id = " . $user_id . " AND m.shipment_status = -1
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getPendingKiriman() {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COUNT(t.bidding_id) AS bidding_count
			FROM `m_shipment` m
			LEFT JOIN `t_bidding` t
			ON m.shipment_id = t.shipment_id
			WHERE m.user_id = " . $user_id . " AND (m.shipment_status = 0 || m.shipment_status = 1)
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getPesananKiriman() {
		$this->db->query("SET group_concat_max_len = 2048;");
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COUNT(t.bidding_id) AS bidding_count, GROUP_CONCAT(dd.driver_id SEPARATOR ';') AS driver_ids, GROUP_CONCAT(d.driver_name SEPARATOR ';') AS driver_names, GROUP_CONCAT(vd.vehicle_id SEPARATOR ';') AS vehicle_ids, GROUP_CONCAT(v.vehicle_name SEPARATOR ';') AS vehicle_names, GROUP_CONCAT(ded.device_id SEPARATOR ';') AS device_ids, GROUP_CONCAT(de.device_name SEPARATOR ';') AS device_names
			FROM `m_shipment` m
			LEFT JOIN `t_bidding` t
			ON m.shipment_id = t.shipment_id
			LEFT JOIN (SELECT dd.driver_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id)
            ON ded.shipment_id = m.shipment_id
			WHERE m.user_id = 18 AND m.shipment_status = 2 AND dd.shipment_id = m.shipment_id AND dd.driver_id = d.driver_id AND vd.shipment_id = m.shipment_id AND vd.vehicle_id = v.vehicle_id AND ded.shipment_id = m.shipment_id AND ded.device_id = de.device_id
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getDikirimKiriman() {
		
	}
	
	public function getKirimanSaya($user_id) {
		$query = $this->db->query(
			"SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.shipment_status, m.location_from_name, m.location_to_name, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COUNT(t.bidding_id) AS bidding_count, d.driver_name, v.vehicle_name, dc.device_name, u.username AS cancel_by
			FROM `m_shipment` m
			LEFT JOIN `t_bidding` t
			ON m.shipment_id = t.shipment_id
            LEFT JOIN `m_driver` d
            ON d.driver_id = m.driver_id
            LEFT JOIN `m_vehicle` v
            ON v.vehicle_id = m.vehicle_id
            LEFT JOIN `m_device_customer` dc
            ON dc.device_id = m.device_id
			LEFT JOIN `m_user` u
            ON u.user_id = m.cancel_by
			WHERE m.user_id = " . $user_id . "
			GROUP BY m.shipment_id"
		);
		return $query->result();
	}
	
	public function submitRating($data) {
		$this->db->query("CALL submit_rating('" . $data["shipment_id"] . "', '" . $data["user_id"] . "', '" . $data["shipment_rating_number"] . "', '" . $data["shipment_rating_feedback"] . "');");
		return 1;
	}
	
	public function cancelShipment($data) {
		$this->db->query("CALL cancel_shipment('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
}
