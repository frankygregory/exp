<?php

class Kiriman_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getOpenKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COALESCE(t.bidding_count, 0) AS bidding_count, COALESCE(t.bidding_price, 0) AS low
			FROM `m_shipment` m
			LEFT JOIN (SELECT COUNT(t.bidding_id) AS bidding_count, MIN(t.bidding_price) AS bidding_price, t.shipment_id FROM `t_bidding` t GROUP BY t.shipment_id ) t
			ON m.shipment_id = t.shipment_id
			WHERE m.user_id = " . $user_id . " AND m.shipment_status = -1
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getPendingKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COALESCE(t.bidding_count, 0) AS bidding_count, COALESCE(t.bidding_price, 0) AS low
			FROM `m_shipment` m
			LEFT JOIN (SELECT COUNT(t.bidding_id) AS bidding_count, MIN(t.bidding_price) AS bidding_price, t.shipment_id FROM `t_bidding` t GROUP BY t.shipment_id ) t
			ON m.shipment_id = t.shipment_id
			WHERE m.user_id = " . $user_id . " AND (m.shipment_status = 0 || m.shipment_status = 1)
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getPesananKiriman($user_id) {
		$this->db->query("SET group_concat_max_len = 2048;");
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, COALESCE(t.bidding_count, 0) AS bidding_count, COALESCE(t.bidding_price, 0) AS low, GROUP_CONCAT(dd.driver_id SEPARATOR ';') AS driver_ids, GROUP_CONCAT(dd.driver_name SEPARATOR ';') AS driver_names, GROUP_CONCAT(vd.vehicle_id SEPARATOR ';') AS vehicle_ids, GROUP_CONCAT(vd.vehicle_name SEPARATOR ';') AS vehicle_names, GROUP_CONCAT(ded.device_id SEPARATOR ';') AS device_ids, GROUP_CONCAT(ded.device_name SEPARATOR ';') AS device_names
			FROM `m_shipment` m
			LEFT JOIN (SELECT COUNT(t.bidding_id) AS bidding_count, MIN(t.bidding_price) AS bidding_price, t.shipment_id FROM `t_bidding` t GROUP BY t.shipment_id ) t
			ON m.shipment_id = t.shipment_id
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE m.user_id = '" . $user_id . "' AND m.shipment_status = 2
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getDikirimKiriman($user_id) {
		$this->db->query("SET group_concat_max_len = 2048;");
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, COALESCE(t.bidding_count, 0) AS bidding_count, COALESCE(t.bidding_price, 0) AS low, GROUP_CONCAT(dd.driver_id SEPARATOR ';') AS driver_ids, GROUP_CONCAT(dd.driver_name SEPARATOR ';') AS driver_names, GROUP_CONCAT(vd.vehicle_id SEPARATOR ';') AS vehicle_ids, GROUP_CONCAT(vd.vehicle_name SEPARATOR ';') AS vehicle_names, GROUP_CONCAT(ded.device_id SEPARATOR ';') AS device_ids, GROUP_CONCAT(ded.device_name SEPARATOR ';') AS device_names
			FROM `m_shipment` m
			LEFT JOIN (SELECT COUNT(t.bidding_id) AS bidding_count, MIN(t.bidding_price) AS bidding_price, t.shipment_id FROM `t_bidding` t GROUP BY t.shipment_id ) t
			ON m.shipment_id = t.shipment_id
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE m.user_id = '" . $user_id . "' AND m.shipment_status = 3
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getDiambilKiriman($user_id) {
		$this->db->query("SET group_concat_max_len = 2048;");
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, COALESCE(t.bidding_count, 0) AS bidding_count, COALESCE(t.bidding_price, 0) AS low, GROUP_CONCAT(dd.driver_id SEPARATOR ';') AS driver_ids, GROUP_CONCAT(dd.driver_name SEPARATOR ';') AS driver_names, GROUP_CONCAT(vd.vehicle_id SEPARATOR ';') AS vehicle_ids, GROUP_CONCAT(vd.vehicle_name SEPARATOR ';') AS vehicle_names, GROUP_CONCAT(ded.device_id SEPARATOR ';') AS device_ids, GROUP_CONCAT(ded.device_name SEPARATOR ';') AS device_names
			FROM `m_shipment` m
			LEFT JOIN (SELECT COUNT(t.bidding_id) AS bidding_count, MIN(t.bidding_price) AS bidding_price, t.shipment_id FROM `t_bidding` t GROUP BY t.shipment_id ) t
			ON m.shipment_id = t.shipment_id
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE m.user_id = '" . $user_id . "' AND m.shipment_status = 4
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getDiterimaKiriman($user_id) {
		$this->db->query("SET group_concat_max_len = 2048;");
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, COALESCE(t.bidding_count, 0) AS bidding_count, COALESCE(t.bidding_price, 0) AS low, GROUP_CONCAT(dd.driver_id SEPARATOR ';') AS driver_ids, GROUP_CONCAT(dd.driver_name SEPARATOR ';') AS driver_names, GROUP_CONCAT(vd.vehicle_id SEPARATOR ';') AS vehicle_ids, GROUP_CONCAT(vd.vehicle_name SEPARATOR ';') AS vehicle_names, GROUP_CONCAT(ded.device_id SEPARATOR ';') AS device_ids, GROUP_CONCAT(ded.device_name SEPARATOR ';') AS device_names
			FROM `m_shipment` m
			LEFT JOIN (SELECT COUNT(t.bidding_id) AS bidding_count, MIN(t.bidding_price) AS bidding_price, t.shipment_id FROM `t_bidding` t GROUP BY t.shipment_id ) t
			ON m.shipment_id = t.shipment_id
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE m.user_id = '" . $user_id . "' AND m.shipment_status = 5
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getSelesaiKiriman($user_id) {
		$this->db->query("SET group_concat_max_len = 2048;");
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, COALESCE(t.bidding_count, 0) AS bidding_count, COALESCE(t.bidding_price, 0) AS low, GROUP_CONCAT(dd.driver_id SEPARATOR ';') AS driver_ids, GROUP_CONCAT(dd.driver_name SEPARATOR ';') AS driver_names, GROUP_CONCAT(vd.vehicle_id SEPARATOR ';') AS vehicle_ids, GROUP_CONCAT(vd.vehicle_name SEPARATOR ';') AS vehicle_names, GROUP_CONCAT(ded.device_id SEPARATOR ';') AS device_ids, GROUP_CONCAT(ded.device_name SEPARATOR ';') AS device_names, TIMESTAMPDIFF(SECOND, m.delivery_date, m.receive_date) AS waktu_kiriman, TIMESTAMPDIFF(SECOND, m.pending_date, m.end_date) AS total_waktu
			FROM `m_shipment` m
			LEFT JOIN (SELECT COUNT(t.bidding_id) AS bidding_count, MIN(t.bidding_price) AS bidding_price, t.shipment_id FROM `t_bidding` t GROUP BY t.shipment_id ) t
			ON m.shipment_id = t.shipment_id
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE m.user_id = '" . $user_id . "' AND m.shipment_status = 6
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getCancelKiriman($user_id) {
		$this->db->query("SET group_concat_max_len = 2048;");
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, COALESCE(t.bidding_count, 0) AS bidding_count, COALESCE(t.bidding_price, 0) AS low, m.cancel_by, u.username AS cancel_username, GROUP_CONCAT(dd.driver_id SEPARATOR ';') AS driver_ids, GROUP_CONCAT(dd.driver_name SEPARATOR ';') AS driver_names, GROUP_CONCAT(vd.vehicle_id SEPARATOR ';') AS vehicle_ids, GROUP_CONCAT(vd.vehicle_name SEPARATOR ';') AS vehicle_names, GROUP_CONCAT(ded.device_id SEPARATOR ';') AS device_ids, GROUP_CONCAT(ded.device_name SEPARATOR ';') AS device_names
			FROM `m_user` u, `m_shipment` m
			LEFT JOIN (SELECT COUNT(t.bidding_id) AS bidding_count, MIN(t.bidding_price) AS bidding_price, t.shipment_id FROM `t_bidding` t GROUP BY t.shipment_id ) t
			ON m.shipment_id = t.shipment_id
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE m.user_id = '" . $user_id . "' AND m.shipment_status = 7 AND u.user_id = m.cancel_by
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getKirimanSaya($user_id) {
		$query = $this->db->query("
			SELECT shipment_status, COUNT(shipment_status) AS count
			FROM `m_shipment`
			WHERE user_id = '" . $user_id . "'
			GROUP BY shipment_status"
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
