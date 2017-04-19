<?php

class Kendaraan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function addKendaraan($data) {
		$this->db->insert("m_vehicle", $data);
		return $this->db->affected_rows();
	}
	
	public function getKendaraanByUserId($user_id) {
		$query = $this->db->query(
			"SELECT v.*, COUNT(s.vehicle_id) AS jumlah_transaksi
			FROM `m_vehicle` v
			LEFT JOIN `m_shipment` s
			ON v.vehicle_id = s.vehicle_id
			WHERE v.user_id = " . $user_id . "
			GROUP BY v.vehicle_id"
		);
		return $query->result();
	}
}
