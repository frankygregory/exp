<?php

class Kiriman_ekspedisi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getKiriman($user_id) {
		$query = $this->db->query(
			"SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.shipment_status, m.location_from_name, m.location_to_name, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COUNT(t.bidding_id) AS bidding_count, d.driver_name, v.vehicle_name, dc.device_name
			FROM `m_driver` d, `m_vehicle` v, `m_device_customer` dc, `m_shipment` m
			LEFT JOIN `t_bidding` t
			ON m.shipment_id = t.shipment_id
			WHERE t.user_id = " . $user_id . " AND t.bidding_status = 1 AND d.driver_id = m.driver_id AND v.vehicle_id = m.vehicle_id AND dc.device_id = m.device_id
			GROUP BY t.shipment_id"
		);
		return $query->result();
	}
	
	public function submitDeal($data) {
		$this->db->query("CALL deal_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
	
	public function submitPesan($data) {
		$this->db->query("CALL pesan_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "', '" . $data["driver_id"] . "', '" . $data["vehicle_id"] . "', '" . $data["device_id"] . "');");
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
}
