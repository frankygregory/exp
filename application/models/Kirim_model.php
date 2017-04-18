<?php

class Kirim_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getListKirimanUmum() {
		$query =  $this->db->query(
			"SELECT a.*,concat(datediff(a.shipment_end_date,curdate()),' hari') rem_date,
			(SELECT COUNT(1) FROM t_bidding b WHERE a.shipment_id=b.shipment_id) bid_count,
			(SELECT COUNT(1) FROM t_bidding b WHERE a.shipment_id=b.shipment_id and b.bidding_status=0) active_bid_count,
            (SELECT min(bidding_price) FROM t_bidding b WHERE a.shipment_id=b.shipment_id) min_bid_price,
            (SELECT SUM(b.item_weight*if(UPPER(b.item_weight_unit)='TON',1000,1)) FROM m_shipment_details b WHERE a.shipment_id=b.shipment_id) tot_weight_kg,
            DATE_FORMAT(a.shipment_delivery_date_from,'%d-%b-%y') ship_date_from,
            DATE_FORMAT(a.shipment_delivery_date_to,'%d-%b-%y') ship_date_to 
            FROM m_shipment a 
            WHERE datediff(a.shipment_end_date,curdate())>-300"
		);
		return $query->result();
	}
	
	public function getShipment($shipment_id) {
		$query = $this->db->query(
			"SELECT s.*, u.username
			FROM `m_shipment` s, `m_user` u
			WHERE s.user_id = u.user_id AND s.shipment_id = " . $shipment_id . ";"
		);
		return $query->result();
	}
	
	public function getQuestions($shipment_id) {
		$query = $this->db->query(
			"SELECT t.*, u.username
			FROM `t_questions` t, `m_user` u
			WHERE t.user_id = u.user_id AND t.shipment_id = " . $shipment_id . ";"
		);
		return $query->result();
	}
	
	public function getAnswers($questions_id) {
		$this->db->where("questions_id", $questions_id);
		return $this->db->get("t_questions_details")->result();
	}
	
	public function getBidding($shipment_id) {
		$query = $this->db->query(
			"SELECT t.*, u.username
			FROM `t_bidding` t, `m_user` u
			WHERE t.user_id = u.user_id AND shipment_id = " . $shipment_id . ";"
		);
		return $query->result();
	}
	
	public function doBidding($data) {
		$this->db->insert("t_bidding", $data);
		return $this->db->affected_rows();
	}
}
