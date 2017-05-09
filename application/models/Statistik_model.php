<?php

class Statistik_model extends CI_Model
{
	protected $kirimanQuery = "SELECT (SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id) AS total,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE shipment_status = 6) AS berhasil,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE shipment_status = 7) AS gagal,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 30 DAY) AS total_30,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 30 DAY AND shipment_status = 6) AS berhasil_30,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 30 DAY AND shipment_status = 7) AS gagal_30,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 180 DAY) AS total_180,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 180 DAY AND shipment_status = 6) AS berhasil_180,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 180 DAY AND shipment_status = 7) AS gagal_180,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 365 DAY) AS total_365,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 365 DAY AND shipment_status = 6) AS berhasil_365,
			(SELECT COUNT(shipment_id)
			FROM v_m_shipment_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 365 DAY AND shipment_status = 7) AS gagal_365;";
	
	protected $biddingQuery = "SELECT (SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id) AS total,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE bidding_status = 1) AS berhasil,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE bidding_status = 2) AS gagal,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 30 DAY) AS total_30,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE bidding_status = 1 AND created_date >= CURRENT_TIMESTAMP() - INTERVAL 30 DAY) AS berhasil_30,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE bidding_status = 2 AND created_date >= CURRENT_TIMESTAMP() - INTERVAL 30 DAY) AS gagal_30,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 180 DAY) AS total_180,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE bidding_status = 1 AND created_date >= CURRENT_TIMESTAMP() - INTERVAL 180 DAY) AS berhasil_180,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE bidding_status = 2 AND created_date >= CURRENT_TIMESTAMP() - INTERVAL 180 DAY) AS gagal_180,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE created_date >= CURRENT_TIMESTAMP() - INTERVAL 365 DAY) AS total_365,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE bidding_status = 1 AND created_date >= CURRENT_TIMESTAMP() - INTERVAL 365 DAY) AS berhasil_365,
			(SELECT COUNT(bidding_id)
			FROM v_t_bidding_by_user_id
			WHERE bidding_status = 2 AND created_date >= CURRENT_TIMESTAMP() - INTERVAL 365 DAY) AS gagal_365;";
			
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getStatistikKirimanKonsumen($user_id) {
		$query = $this->db->query(
			"CREATE OR REPLACE VIEW v_m_shipment_by_user_id AS
			SELECT m.shipment_id, m.shipment_status, m.created_date
			FROM `m_shipment` m
			WHERE m.user_id = '" . $user_id . "';"
		);
		$query = $this->db->query($this->kirimanQuery);
		return $query->result();
	}
	
	public function getStatistikKirimanEkspedisi($user_id) {
		$query = $this->db->query(
			"CREATE OR REPLACE VIEW v_m_shipment_by_user_id AS
			SELECT m.shipment_id, m.shipment_status, m.created_date
			FROM `m_shipment` m
			WHERE m.pending_by = '" . $user_id . "';"
		);
		$query = $this->db->query($this->kirimanQuery);
		return $query->result();
	}
	
	public function getStatistikBidding($user_id) {
		$query = $this->db->query(
			"CREATE OR REPLACE VIEW v_t_bidding_by_user_id AS
			SELECT t.bidding_id, t.bidding_status, t.created_date
			FROM `t_bidding` t
			WHERE t.user_id = '" . $user_id . "';"
		);
		$query = $this->db->query($this->biddingQuery);
		return $query->result();
	}
}
