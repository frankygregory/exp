<?php

class Kiriman_ekspedisi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function getDetailPengirim($shipment_id) {
		$query = $this->db->query("
			SELECT u.username, u.user_email, u.user_fullname, u.user_address, u.user_telephone, u.user_handphone
			FROM `m_user` u, `m_shipment` s
			WHERE s.user_id = u.user_id AND s.shipment_id = '" . $shipment_id . "'
			LIMIT 1"
		);
		return $query->result();
	}
	
	public function getDealKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `t_bidding` t, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 0 AND t.bidding_type = 1
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getPendingKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `t_bidding` t, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 1 AND t.bidding_type = 1
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getPesananKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, m.shipment_jenis_muatan, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, dd.driver_id AS driver_ids, dd.driver_name AS driver_names, vd.vehicle_id AS vehicle_ids, vd.vehicle_name AS vehicle_names, ded.device_id AS device_ids, ded.device_name AS device_names
			FROM `t_bidding` t, `m_shipment` m
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 2 AND t.bidding_type = 1
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getDikirimKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, m.shipment_jenis_muatan, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, dd.driver_id AS driver_ids, dd.driver_name AS driver_names, vd.vehicle_id AS vehicle_ids, vd.vehicle_name AS vehicle_names, ded.device_id AS device_ids, ded.device_name AS device_names
			FROM `t_bidding` t, `m_shipment` m
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 3 AND t.bidding_type = 1
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getDiambilKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, m.shipment_jenis_muatan, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, dd.driver_id AS driver_ids, dd.driver_name AS driver_names, vd.vehicle_id AS vehicle_ids, vd.vehicle_name AS vehicle_names, ded.device_id AS device_ids, ded.device_name AS device_names
			FROM `t_bidding` t, `m_shipment` m
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 4 AND t.bidding_type = 1
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getDiterimaKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, m.shipment_jenis_muatan, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, dd.driver_id AS driver_ids, dd.driver_name AS driver_names, vd.vehicle_id AS vehicle_ids, vd.vehicle_name AS vehicle_names, ded.device_id AS device_ids, ded.device_name AS device_names
			FROM `t_bidding` t, `m_shipment` m
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 5 AND t.bidding_type = 1
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getSelesaiKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, m.shipment_jenis_muatan, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, dd.driver_id AS driver_ids, dd.driver_name AS driver_names, vd.vehicle_id AS vehicle_ids, vd.vehicle_name AS vehicle_names, ded.device_id AS device_ids, ded.device_name AS device_names, TIMESTAMPDIFF(SECOND, sd.delivery_date, sd.receive_date) AS waktu_kiriman, TIMESTAMPDIFF(SECOND, sd.order_date, sd.end_date) AS total_waktu
			FROM `t_bidding` t, `m_shipment_darat` sd, `m_shipment` m
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 6 AND t.bidding_type = 1 AND sd.shipment_id = m.shipment_id
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getCancelKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, m.cancel_by, u.username AS cancel_username, GROUP_CONCAT(dd.driver_id SEPARATOR ';') AS driver_ids, GROUP_CONCAT(dd.driver_name SEPARATOR ';') AS driver_names, GROUP_CONCAT(vd.vehicle_id SEPARATOR ';') AS vehicle_ids, GROUP_CONCAT(vd.vehicle_name SEPARATOR ';') AS vehicle_names, GROUP_CONCAT(ded.device_id SEPARATOR ';') AS device_ids, GROUP_CONCAT(ded.device_name SEPARATOR ';') AS device_names
			FROM `m_user` u, `t_bidding` t, `m_shipment` m
			LEFT JOIN (SELECT dd.driver_id, dd.shipment_id, d.driver_name FROM `m_driver_details` dd, `m_driver` d WHERE dd.driver_id = d.driver_id) dd
            ON dd.shipment_id = m.shipment_id
			LEFT JOIN (SELECT vd.vehicle_id, vd.shipment_id, v.vehicle_name FROM `m_vehicle_details` vd, `m_vehicle` v WHERE vd.vehicle_id = v.vehicle_id) vd
            ON vd.shipment_id = m.shipment_id
            LEFT JOIN (SELECT ded.device_id, ded.shipment_id, de.device_name FROM `m_device_details` ded, `m_device_customer` de WHERE ded.device_id = de.device_id) ded
            ON ded.shipment_id = m.shipment_id
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 7 AND t.bidding_type = 1 AND u.user_id = m.cancel_by
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getKirimanCount($user_id) {
		$query = $this->db->query(
			"SELECT m.shipment_status, COUNT(m.shipment_status) AS count
			FROM `m_shipment` m, `t_bidding` t
			WHERE t.user_id = '" . $user_id . "' AND t.bidding_status = 1 AND t.shipment_id = m.shipment_id AND t.bidding_type = 1
			GROUP BY m.shipment_status;"
		);
		return $query->result();
	}
	
	public function getKendaraanAktif($user_id) {
		$query = $this->db->query("
			SELECT m.*, COALESCE(d.shipment_id, '') AS shipment_id
			FROM `m_vehicle` m
			LEFT JOIN `m_vehicle_details` d
			ON m.vehicle_id = d.vehicle_id AND d.vehicle_details_status = 1
			WHERE m.user_id = '" . $user_id . "' AND COALESCE(d.shipment_id, '') = '' AND m.vehicle_status = 1
			GROUP BY m.vehicle_id
		");
		return $query->result();
	}
	
	public function getDriverAktif($user_id) {
		$query = $this->db->query("
			SELECT m.*, COALESCE(d.shipment_id, '') AS shipment_id
			FROM `m_driver` m
			LEFT JOIN `m_driver_details` d
			ON m.driver_id = d.driver_id AND d.driver_details_status = 1
			WHERE m.user_id = '" . $user_id . "' AND COALESCE(d.shipment_id, '') = '' AND m.driver_status = 1
			GROUP BY m.driver_id
		");
		return $query->result();
	}
	
	public function getAlatAktif($user_id) {
		$query = $this->db->query("
			SELECT m.*, COALESCE(d.shipment_id, '') AS shipment_id
			FROM `m_device_customer` m
			LEFT JOIN `m_device_details` d
			ON m.device_id = d.device_id AND d.device_details_status = 1
			WHERE m.user_id = '" . $user_id . "' AND COALESCE(d.shipment_id, '') = '' AND m.device_status = 1
			GROUP BY m.device_id
		");
		return $query->result();
	}
	
	public function submitDeal($data) {
		$this->db->query("CALL deal_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
	
	public function submitPesan($data) {
		$this->db->query("CALL pesan_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "', '" . $data["driver_id"] . "', '" . $data["vehicle_id"] . "', '" . $data["device_id"] . "', '" . $data["shipment_jenis_muatan"] . "');");
		return 1;
	}
	
	public function submitKirim($data) {
		$this->db->query("CALL kirim_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
	
	public function submitAmbil($data) {
		$this->db->query("CALL ambil_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
	
	public function submitTerima($data) {
		$this->db->query("CALL terima_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
	
	public function cancelShipment($data) {
		$this->db->query("CALL cancel_shipment('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
}
