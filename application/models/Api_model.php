<?php

class Api_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($data) {
        $data["password"] = md5($data["password"]);
        $query = $this->db->query("
            SELECT user_id
            FROM `m_user`
            WHERE username = '" . $data["username"] . "' AND password = '" . $data["password"] . "' AND role_id = 2
            LIMIT 1
        ");
        return $query->result();
    }
	
    public function getKirimanDriverByDeviceId($device_id) {
        $query = $this->db->query("
            SELECT s.*, sd.vehicle_id, sd.driver_id, sd.device_id
            FROM `m_shipment_darat` sd, `m_shipment` s
            WHERE sd.device_id = '" . $device_id . "' AND s.shipment_id = sd.shipment_id AND s.shipment_status < 6
        ");
        return $query->result();
    }

    public function getKirimanDetail($shipment_id) {
        $query = $this->db->query("
        SELECT sd.*
        FROM `m_shipment_details` sd
        WHERE sd.shipment_id = '" . $shipment_id . "';");
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

    public function submitAmbil($data) {
		$this->db->query("CALL ambil_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}

    public function submitKirim($data) {
		$this->db->query("CALL kirim_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
	
	public function submitTerima($data) {
		$this->db->query("CALL terima_kiriman('" . $data["shipment_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
}
