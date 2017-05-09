<?php

class Kiriman_ekspedisi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getKiriman($user_id) {
		/*$query = $this->db->query(
			"SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.shipment_status, m.location_from_name, m.location_to_name, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COUNT(t.bidding_id) AS bidding_count, d.driver_name, v.vehicle_name, dc.device_name, u.username AS cancel_by
			FROM `m_shipment` m
			LEFT JOIN `t_bidding` t
			ON m.shipment_id = t.shipment_id
			LEFT JOIN `m_driver` d
            ON m.driver_id = d.driver_id
            LEFT JOIN `m_vehicle` v
            ON m.vehicle_id = v.vehicle_id
            LEFT JOIN `m_device_customer` dc
            ON m.device_id = dc.device_id
			LEFT JOIN `m_user` u
            ON m.cancel_by = u.user_id
			WHERE t.user_id = " . $user_id . " AND t.bidding_status = 1
			GROUP BY t.shipment_id"
		);*/
		$this->db->query(
			"CREATE OR REPLACE VIEW v_get_my_shipment AS
			SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.shipment_status, m.location_from_name, m.location_to_name, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, m.driver_id, m.vehicle_id, m.device_id, m.cancel_by
			FROM `t_bidding` t, `m_shipment` m
			WHERE t.user_id = '" . $user_id . "' AND t.shipment_id = m.shipment_id AND t.bidding_status = 1;");
		$query = $this->db->query(
			"SELECT v.*, COUNT(t.bidding_id) AS bidding_count, d.driver_name, ve.vehicle_name, dc.device_name, u.username AS cancel_by
			FROM t_bidding t, v_get_my_shipment v
			LEFT JOIN `m_driver` d
			ON v.driver_id = d.driver_id
			LEFT JOIN `m_vehicle` ve
			ON v.vehicle_id = ve.vehicle_id
			LEFT JOIN `m_device_customer` dc
			ON v.device_id = dc.device_id
			LEFT JOIN `m_user` u
			ON v.cancel_by = u.user_id
			WHERE t.shipment_id = v.shipment_id
			GROUP BY v.shipment_id;"
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
