<?php

class Api_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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
}
