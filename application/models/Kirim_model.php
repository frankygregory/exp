<?php

class Kirim_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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
}
