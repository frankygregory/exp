<?php

class Api_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($data) {
        $data["device_password"] = md5($data["device_password"]);
        $query = $this->db->query("CALL device_login('" . $data["device_email"] . "', '" . $data["device_password"] . "', '" . $data["firebase_token"] . "', '" . $data["device_gps_lat"] . "', '" . $data["device_gps_lng"] . "', '" . $data["device_gps_accuracy"] . "');");
        return $query->result();
    }

    public function updateFirebaseToken($data) {
        $this->db->where("device_id", $data["device_id"]);
        $this->db->where("token", $data["token"]);
        $updateData = array(
            "firebase_token" => $data["firebase_token"]
        );
        $this->db->update("m_device_customer", $updateData);
        return $this->db;
    }

    public function cekToken($data) {
        $data["token"] = hash("sha256", $data["token"]);
        $query = $this->db->query("
            SELECT device_id
            FROM `m_device_customer`
            WHERE device_id = '" . $data["device_id"] . "' AND token = '" . $data["token"] . "'
        ");
        return $query->result();
    }
	
    public function getKirimanDriverByDeviceId($data) {
        $data["token"] = hash("sha256", $data["token"]);
        $query = $this->db->query("
            CALL device_get_shipment('" . $data["device_id"] . "', '" . $data["token"] . "');
        ");
        return $query->result();
    }

    public function getKirimanDetail($data) {
        $data["token"] = hash("sha256", $data["token"]);
        $query = $this->db->query("CALL device_get_shipment_detail('" . $data["device_id"] . "', '" . $data["token"] . "', '" . $data["shipment_id"] . "');");
        return $query->result();
    }

    public function postCoordinate($data) {
        $insertData = array(
            "device_id" => $data["device_id"],
            "device_gps_lat" => $data["device_gps_lat"],
            "device_gps_lng" => $data["device_gps_lng"],
            "device_gps_accuracy" => $data["device_gps_accuracy"]
        );
        $this->db->insert("t_device_gps", $insertData);
        return $this->db->affected_rows();
    }

    public function answerLocationRequest($data) {
        $this->db->where("device_gps_id", $data["device_gps_id"]);
        $this->db->where("device_gps_type", "request");
        $this->db->where("device_gps_type_status", 1);
        $this->db->set("device_gps_lat", $data["device_gps_lat"]);
        $this->db->set("device_gps_lng", $data["device_gps_lng"]);
        $this->db->set("device_gps_accuracy", $data["device_gps_accuracy"]);
        $this->db->set("device_gps_type_status", 0);
        $this->db->set("modified_date", "CURRENT_TIMESTAMP()", false);
        $this->db->update("t_device_gps");
    
        return $this->db;
    }

    public function submitAmbil($data) {
		$data["token"] = hash("sha256", $data["token"]);
		$query = $this->db->query("CALL device_ambil_kiriman('" . $data["shipment_id"] . "', '" . $data["device_id"] . "', '" . $data["token"] . "', '" . $data["device_gps_lat"] . "', '" . $data["device_gps_lng"] . "', '" . $data["device_gps_accuracy"] . "');");
		return $query->result();
	}

    public function submitKirim($data) {
        $data["token"] = hash("sha256", $data["token"]);
		$query = $this->db->query("CALL device_kirim_kiriman('" . $data["shipment_id"] . "', '" . $data["device_id"] . "', '" . $data["token"] . "', '" . $data["device_gps_lat"] . "', '" . $data["device_gps_lng"] . "', '" . $data["device_gps_accuracy"] . "');");
		return $query->result();
	}
	
	public function submitTerima($data) {
		$data["token"] = hash("sha256", $data["token"]);
		$query = $this->db->query("CALL device_terima_kiriman('" . $data["shipment_id"] . "', '" . $data["device_id"] . "', '" . $data["token"] . "', '" . $data["device_gps_lat"] . "', '" . $data["device_gps_lng"] . "', '" . $data["device_gps_accuracy"] . "');");
		return $query->result();
	}
}
