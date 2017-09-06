<?php

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function getEkspedisiKirimanCount($user_id) {
		$query = $this->db->query("
			SELECT COALESCE((SELECT COUNT(m.shipment_id)
			FROM `m_shipment` m, `t_bidding` t
			WHERE t.created_by = " . $user_id . " AND t.shipment_id = m.shipment_id AND m.shipment_end_date > CURRENT_TIMESTAMP() AND m.shipment_status = -1), 0) AS kiriman_open,
            COALESCE((SELECT COUNT(m.shipment_id)
			FROM `m_shipment` m, `t_bidding` t
			WHERE t.created_by = " . $user_id . " AND t.bidding_status = 1 AND t.shipment_id = m.shipment_id AND m.shipment_status > -1 AND m.shipment_status < 6), 0) AS kiriman_berjalan
		");
		return $query->result();
	}

	public function getKonsumenKirimanCount($user_id) {
		$query = $this->db->query("
			SELECT COALESCE((SELECT COUNT(m.shipment_id)
			FROM `m_shipment` m
			WHERE m.created_by = " . $user_id . " AND m.shipment_status > -1 AND m.shipment_status < 6), 0) AS kiriman_berjalan,
       		COALESCE((SELECT COUNT(m.shipment_id)
			FROM `m_shipment` m
			WHERE m.created_by = " . $user_id . "), 0) AS kiriman_total
		");
		return $query->result();
	}
}
