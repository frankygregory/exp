<?php

class Kirim_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getListKirimanUmum($data) {
		if ($data["order_by"] != "") {
			$data["order_by"] = " ORDER BY m." . $data["order_by"];
		}
		
		$where_shipment_max = " AND m.shipment_length <= " . $data["shipment_length_max"];

		$str = "SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.location_from_city, m.location_to_city, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `m_shipment` m
			WHERE m.shipment_end_date > CURRENT_TIMESTAMP() AND m.shipment_status = -1 AND m.shipment_type = 1 AND m.location_from_city LIKE '%" . $data["location_from_city"] . "%' AND m.location_to_city LIKE '%" . $data["location_to_city"] . "%'" . $where_shipment_max . "
			GROUP BY m.shipment_id " . $data["order_by"] . "
			LIMIT " . $data["limit"] . " OFFSET " . $data["offset"];
		
		$query =  $this->db->query($str);
		return $query->result();
	}

	public function getListKirimanUmumCount($data) {
		if ($data["order_by"] != "") {
			$data["order_by"] = " ORDER BY m." . $data["order_by"];
		}
		
		$where_shipment_max = " AND m.shipment_length <= " . $data["shipment_length_max"];
		if ($data["shipment_length_max"] == 0) {
			$where_shipment_max = "";
		}
		
		$query =  $this->db->query(
			"SELECT COUNT(m.shipment_id) AS count
			FROM `m_shipment` m
			WHERE m.shipment_end_date > CURRENT_TIMESTAMP() AND m.shipment_status = -1 AND m.shipment_type = 1 AND m.location_from_city LIKE '%" . $data["location_from_city"] . "%' AND m.location_to_city LIKE '%" . $data["location_to_city"] . "%'" . $where_shipment_max
		);
		return $query->result();
	}

	public function getListKirimanUmumPro($data) {
		$query = $this->db->query("
			SELECT party_id
			FROM `m_user_party`
			WHERE user_id = " . $data["user_id"] . " AND (user_party_status = 3 OR user_party_status = 4)
		");
		$result = $query->result();

		$where_user_id = "";
		for ($i = 0; $i < sizeof($result); $i++) {
			if ($where_user_id == "") {
				$where_user_id .= " AND (";
			} else {
				$where_user_id .= " OR ";
			}
			$where_user_id .= "user_id = " . $result[$i]->party_id;
		}
		if ($where_user_id != "") {
			$where_user_id .= ")";
		}

		if ($data["order_by"] != "") {
			$data["order_by"] = " ORDER BY m." . $data["order_by"];
		}
		
		$where_shipment_max = " AND m.shipment_length <= " . $data["shipment_length_max"];

		$str = "SELECT m.shipment_id, m.shipment_title, m.shipment_pictures, m.shipment_delivery_date_from, m.shipment_delivery_date_to, m.shipment_length, m.location_from_city, m.location_to_city, TIMESTAMPDIFF(SECOND, CURRENT_TIMESTAMP(), m.shipment_end_date) AS berakhir, get_bidding_count(m.shipment_id) AS bidding_count, get_lowest_bidding_price(m.shipment_id) AS low
			FROM `m_shipment` m
			WHERE m.shipment_end_date > CURRENT_TIMESTAMP() AND m.shipment_status = -1 AND m.shipment_type = 2" . $where_user_id . " AND m.location_from_city LIKE '%" . $data["location_from_city"] . "%' AND m.location_to_city LIKE '%" . $data["location_to_city"] . "%'" . $where_shipment_max . "
			GROUP BY m.shipment_id " . $data["order_by"] . "
			LIMIT " . $data["limit"] . " OFFSET " . $data["offset"];
		
		$query =  $this->db->query($str);
		return $query->result();
	}

	public function getListKirimanUmumCountPro($data) {
		$query = $this->db->query("
			SELECT party_id
			FROM `m_user_party`
			WHERE user_id = " . $data["user_id"] . " AND (user_party_status = 3 OR user_party_status = 4)
		");
		$result = $query->result();

		$where_user_id = "";
		for ($i = 0; $i < sizeof($result); $i++) {
			if ($where_user_id == "") {
				$where_user_id .= " AND (";
			} else {
				$where_user_id .= " OR ";
			}
			$where_user_id .= "user_id = " . $result[$i]->party_id;
		}
		if ($where_user_id != "") {
			$where_user_id .= ")";
		}

		if ($data["order_by"] != "") {
			$data["order_by"] = " ORDER BY m." . $data["order_by"];
		}
		
		$where_shipment_max = " AND m.shipment_length <= " . $data["shipment_length_max"];
		if ($data["shipment_length_max"] == 0) {
			$where_shipment_max = "";
		}
		
		$query =  $this->db->query(
			"SELECT COUNT(m.shipment_id) AS count
			FROM `m_shipment` m
			WHERE m.shipment_end_date > CURRENT_TIMESTAMP() AND m.shipment_status = -1 AND m.shipment_type = 2 AND m.location_from_city LIKE '%" . $data["location_from_city"] . "%' AND m.location_to_city LIKE '%" . $data["location_to_city"] . "%'" . $where_shipment_max
		);
		return $query->result();
	}
	
	public function getShipment($shipment_id) {
		$query = $this->db->query(
			"SELECT s.*, u.username, u.user_verified, b.user_id AS expedition_id, get_lowest_bidding_price(" . $shipment_id . ") AS bidding_price
			FROM `m_shipment` s, `m_user` u
			LEFT JOIN (SELECT shipment_id, user_id FROM `t_bidding` WHERE bidding_status = 1) b
			ON b.shipment_id = " . $shipment_id . "
			WHERE s.user_id = u.user_id AND s.shipment_id = " . $shipment_id . "
			LIMIT 1;"
		);
		return $query->result();
	}
	
	public function getShipmentDetail($shipment_id) {
		$query = $this->db->query(
			"SELECT *
			FROM m_shipment_details
			WHERE shipment_id = " . $shipment_id . ";"
		);
		return $query->result_array();
	}
	
	public function getFromKota($keyword) {
		$query = $this->db->query("
			SELECT DISTINCT location_from_city AS city
			FROM `m_shipment`
			WHERE shipment_end_date > CURRENT_TIMESTAMP() AND shipment_status = -1 AND shipment_type = 1 AND location_from_city LIKE '%" . $keyword . "%'
			LIMIT 5
		");
		return $query->result();
	}
	
	public function getToKota($keyword) {
		$query = $this->db->query("
			SELECT DISTINCT location_to_city AS city
			FROM `m_shipment`
			WHERE shipment_end_date > CURRENT_TIMESTAMP() AND shipment_status = -1 AND shipment_type = 1 AND location_to_city LIKE '%" . $keyword . "%'
			LIMIT 5
		");
		return $query->result();
	}

	public function getFromKotaPro($keyword) {
		$query = $this->db->query("
			SELECT DISTINCT location_from_city AS city
			FROM `m_shipment`
			WHERE shipment_end_date > CURRENT_TIMESTAMP() AND shipment_status = -1 AND shipment_type = 2 AND location_from_city LIKE '%" . $keyword . "%'
			LIMIT 5
		");
		return $query->result();
	}
	
	public function getToKotaPro($keyword) {
		$query = $this->db->query("
			SELECT DISTINCT location_to_city AS city
			FROM `m_shipment`
			WHERE shipment_end_date > CURRENT_TIMESTAMP() AND shipment_status = -1 AND shipment_type = 2 AND location_to_city LIKE '%" . $keyword . "%'
			LIMIT 5
		");
		return $query->result();
	}
	
	public function getRangeHarga() {
		$query = $this->db->query("
			SELECT MIN(shipment_length) AS min_length, MAX(shipment_length) AS max_length
			FROM `m_shipment`
			WHERE shipment_status = -1
		");
		return $query->result();
	}
	
	public function getSavedLocation($user_id, $fromto) {
		$this->db->where("user_id", $user_id);
		$this->db->where("location_status", 1);
		$this->db->where($fromto, 1);
		return $this->db->get("m_location")->result();
	}
	
	public function insertQuestions($data) {
		$insertData = array(
			"questions_text" => $data["questions_text"],
			"user_id" => $data["user_id_ref"],
			"shipment_id" => $data["shipment_id"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
		$this->db->insert("t_questions", $insertData);
		return $this->db->affected_rows();
	}
	
	public function getQuestions($shipment_id) {
		$query = $this->db->query(
			"SELECT t.*, u.username, u.user_verified
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
		$query = $this->db->query("
			SELECT t.*, u.username, u.user_verified
			FROM `t_bidding` t, `m_user` u
			WHERE t.user_id = u.user_id AND shipment_id = " . $shipment_id . "
			ORDER BY CASE t.bidding_status WHEN 1 THEN 2 WHEN 0 THEN 1 ELSE 0 END DESC, t.bidding_price ASC;
		");
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
			"bidding_type" => $data["bidding_type"],
			"bidding_price" => $data["bidding_price"],
			"bidding_vehicle" => $data["bidding_vehicle"],
			"bidding_pickupdate" => $data["bidding_pickupdate"],
			"bidding_information" => $data["bidding_information"],
			"shipment_id" => $data["shipment_id"],
			"user_id" => $data["user_id_ref"],
			"group_id" => $data["group_id"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
		$this->db->insert("t_bidding", $insertData);
		return $this->db->affected_rows();
	}

	public function cancelBidding($data) {
		$this->db->where("bidding_id", $data["bidding_id"]);
		$this->db->where("created_by", $data["user_id"]);
		$this->db->where("bidding_status", 0);
		$updateData = array(
			"bidding_status" => -1,
			"modified_by" => $data["user_id"]
		);
		$this->db->update("t_bidding", $updateData);
		return $this->db->affected_rows();
	}
	
	public function acceptBidding($data) {
		$query = $this->db->query("CALL setuju_penawaran('" . $data["shipment_id"] . "', '" . $data["bidding_id"] . "', '" . $data["user_id"] . "');");
		return $query->result();
	}

	public function getAllStatusKiriman($shipment_id) {
		$query = $this->db->query("CALL get_all_status_kiriman('" . $shipment_id . "');");
		return $query->result();
	}
}
