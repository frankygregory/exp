<?php

class Kirim_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getListKirimanUmum() {
		$query =  $this->db->query(
			"SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_price, m.shipment_length, m.location_from_name, m.location_to_name, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, COUNT(t.bidding_id) AS bidding_count
			FROM `m_shipment` m
			LEFT JOIN `t_bidding` t
			ON m.shipment_id = t.shipment_id
			WHERE m.shipment_end_date > CURRENT_TIMESTAMP()
			GROUP BY t.shipment_id"
		);
		return $query->result();
	}
	
	public function getShipment($shipment_id) {
		$query = $this->db->query(
			"SELECT s.*, u.username
			FROM `m_shipment` s, `m_user` u
			WHERE s.created_by = u.user_id AND s.shipment_id = " . $shipment_id . ";"
		);
		return $query->result();
	}
	
	public function insertQuestions($data) {
		$insertData = array(
			"questions_text" => $data["questions_text"],
			"user_id" => $data["user_id"],
			"shipment_id" => $data["shipment_id"],
			"group_id" => $data["group_id"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
		$this->db->insert("t_questions", $insertData);
		return $this->db->affected_rows();
	}
	
	public function getQuestions($shipment_id) {
		$query = $this->db->query(
			"SELECT t.*, u.username
			FROM `t_questions` t, `m_user` u
			WHERE t.user_id = u.user_id AND t.shipment_id = " . $shipment_id . ";"
		);
		return $query->result();
	}
	
	public function insertAnswers($data) {
		$insertData = array(
			"questions_id" => $data["questions_id"],
			"answers_text" => $data["answers_text"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
		$this->db->insert("t_questions_details", $insertData);
		return $this->db->affected_rows();
	}
	
	public function getAnswers($questions_id) {
		$this->db->where("questions_id", $questions_id);
		return $this->db->get("t_questions_details")->result();
	}
	
	public function getBidding($shipment_id) {
		$query = $this->db->query(
			"SELECT t.*, u.username
			FROM `t_bidding` t, `m_user` u
			WHERE t.created_by = u.user_id AND shipment_id = " . $shipment_id . ";"
		);
		return $query->result();
	}
	
	public function rejectBidding($data) {
		$this->db->where("bidding_id", $data["bidding_id"]);
		$updateData = array(
			"bidding_reason" => $data["bidding_reason"],
			"bidding_status" => 2
		);
		$this->db->update("t_bidding", $updateData);
		return $this->db->affected_rows();
	}
	
	public function doBidding($data) {
		$insertData = array(
			"bidding_price" => $data["bidding_price"],
			"bidding_pickupdate" => $data["bidding_pickupdate"],
			"bidding_information" => $data["bidding_information"],
			"shipment_id" => $data["shipment_id"],
			"user_id" => $data["user_id"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
		$this->db->insert("t_bidding", $insertData);
		return $this->db->affected_rows();
	}
}
