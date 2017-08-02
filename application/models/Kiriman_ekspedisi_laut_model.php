<?php

class Kiriman_ekspedisi_laut_model extends CI_Model
{
	protected $shipment_status_col = array(
		
		"2" => "door_start",
		"3" => "port_start",
		"4" => "port_finish",
		"5" => "door_finish",
		"6" => "ending"
	);

    public function __construct()
    {
        parent::__construct();
    }

	public function getDetailPengirim($shipment_id) {
		$query = $this->db->query("CALL get_all_info_kiriman_ekspedisi(" . $shipment_id . ");");
		return $query->result();
	}

	public function getAllStatusKiriman($shipment_id) {
		$query = $this->db->query("CALL get_all_status_kiriman('" . $shipment_id . "');");
		return $query->result();
	}
	
	public function getDealKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `t_bidding` t, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 0 AND t.bidding_type = 2
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getPendingKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `t_bidding` t, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 1 AND t.bidding_type = 2
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getDoorAwalKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, sd.ship_id, sd.shipment_details_container_number
			FROM `t_bidding` t, `m_shipment_laut` sd, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 2 AND t.bidding_type = 2 AND sd.shipment_id = m.shipment_id
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getPortAwalKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, sd.ship_id, sd.shipment_details_container_number
			FROM `t_bidding` t, `m_shipment_laut` sd, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 3 AND t.bidding_type = 2 AND sd.shipment_id = m.shipment_id
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getPortAkhirKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, sd.ship_id, sd.shipment_details_container_number
			FROM `t_bidding` t, `m_shipment_laut` sd, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 4 AND t.bidding_type = 2 AND sd.shipment_id = m.shipment_id
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getDoorAkhirKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, sd.ship_id, sd.shipment_details_container_number
			FROM `t_bidding` t, `m_shipment_laut` sd, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 5 AND t.bidding_type = 2 AND sd.shipment_id = m.shipment_id
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getSelesaiKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, sd.ship_id, sd.shipment_details_container_number, TIMESTAMPDIFF(SECOND, sd.door_start_date, sd.ending_date) AS total_waktu
			FROM `t_bidding` t, `m_shipment_laut` sd, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 6 AND t.bidding_type = 2 AND sd.shipment_id = m.shipment_id
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getCancelKiriman($user_id) {
		$query = $this->db->query("
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.shipment_status, m.location_from_city, m.location_to_city, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low, m.cancel_by, u.username AS cancel_username
			FROM `m_user` u, `t_bidding` t, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1 AND m.shipment_status = 7 AND u.user_id = m.cancel_by AND t.bidding_type = 2
			GROUP BY m.shipment_id
		");
		return $query->result();
	}
	
	public function getKirimanCount($user_id) {
		$query = $this->db->query(
			"SELECT m.shipment_status, COUNT(m.shipment_status) AS count
			FROM `m_shipment` m, `t_bidding` t
			WHERE t.user_id = '" . $user_id . "' AND t.bidding_status = 1 AND t.shipment_id = m.shipment_id AND t.bidding_type = 2
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
	
	public function submitDeal($data) {
		$this->db->query("CALL deal_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
	
	public function submitUbah($data) {
		$this->db->trans_start();
		$status = $this->db->query("SELECT shipment_status FROM `m_shipment` WHERE shipment_id = " . $data["shipment_id"])->result()[0]->shipment_status;

		$set = "";
		if ($status < 2) {
			$set .= "ship_id = '" . $data["ship_id"] . "', shipment_details_container_number = '" . $data["shipment_details_container_number"] . "'";
		}
		for ($i = $status + 1; $i <= $data["shipment_status"]; $i++) {
			if ($set != "") {
				$set .= ", ";
			}
			$set .= $this->shipment_status_col[$i] . "_date = '" . $data["datetime"] . "'";
			$set .= ", " . $this->shipment_status_col[$i] . "_by = '" . $data["user_id"] . "'";
		}
		$set .= ", modified_by = '" . $data["user_id"] . "'";

		$this->db->query("
			UPDATE `m_shipment`
			SET shipment_status = '" . $data["shipment_status"] . "', modified_by = '" . $data["user_id"] . "'
			WHERE shipment_id = '" . $data["shipment_id"] . "'"
		);
		$this->db->query("
			UPDATE `m_shipment_laut`
			SET " . $set . " 
			WHERE shipment_id = '" . $data["shipment_id"] . "'
		");
		$this->db->trans_complete();
		return 1;
	}
	
	public function cancelShipment($data) {
		$this->db->query("CALL cancel_shipment('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
}
