<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiriman extends MY_Controller
{

    public function __construct(){
        parent::__construct();
        //$this->load->library('typography');
    }

    public function index()
    {   
        $pesanan = $this->queryArray(
                        "select a.*,b.driver_name,concat(c.vehicle_name,' [',c.vehicle_nomor,']') vehicle_name,d.device_name ".
                        "from m_shipment a,m_driver b,m_vehicle c,m_device_customer d ".
                        "where a.shipment_status = 2 ".
                          "and a.driver_id=b.driver_id ".
                          "and a.vehicle_id=c.vehicle_id ".
                          "and a.device_id=d.device_id");

        $dikirim = $this->queryArray(
                        "select a.*,b.driver_name,concat(c.vehicle_name,' [',c.vehicle_nomor,']') vehicle_name,d.device_name ".
                        "from m_shipment a,m_driver b,m_vehicle c,m_device_customer d ".
                        "where a.shipment_status = 3 ".
                          "and a.driver_id=b.driver_id ".
                          "and a.vehicle_id=c.vehicle_id ".
                          "and a.device_id=d.device_id");

        $diambil = $this->queryArray(
                        "select a.*,b.driver_name,concat(c.vehicle_name,' [',c.vehicle_nomor,']') vehicle_name,d.device_name ".
                        "from m_shipment a,m_driver b,m_vehicle c,m_device_customer d ".
                        "where a.shipment_status = 4 ".
                          "and a.driver_id=b.driver_id ".
                          "and a.vehicle_id=c.vehicle_id ".
                          "and a.device_id=d.device_id");

        $diterima = $this->queryArray(
                        "select a.*,b.driver_name,concat(c.vehicle_name,' [',c.vehicle_nomor,']') vehicle_name,d.device_name ".
                        "from m_shipment a,m_driver b,m_vehicle c,m_device_customer d ".
                        "where a.shipment_status = 5 ".
                          "and a.driver_id=b.driver_id ".
                          "and a.vehicle_id=c.vehicle_id ".
                          "and a.device_id=d.device_id");

        $selesai = $this->queryArray(
                        "select a.*,b.driver_name,concat(c.vehicle_name,' [',c.vehicle_nomor,']') vehicle_name,d.device_name,".
                          "concat(datediff(a.end_date,a.delivery_date),' Hari') ship_duration ".
                        "from m_shipment a,m_driver b,m_vehicle c,m_device_customer d ".
                        "where a.shipment_status = 6 ".
                          "and a.driver_id=b.driver_id ".
                          "and a.vehicle_id=c.vehicle_id ".
                          "and a.device_id=d.device_id");

        $data = array(
            'title' => 'Kiriman',
            'pending_data' => $this->queryArray("select * from m_shipment where shipment_status = 1"),
            'pesanan_data' => $pesanan,
            'dikirim_data' => $dikirim,
            'diambil_data' => $diambil,
            'diterima_data' => $diterima,
            'selesai_data' => $selesai,
            'driver_data' => $this->queryArray("select * from m_driver where driver_status=1"),
            'vehicle_data' => $this->queryArray("select * from m_vehicle where vehicle_status=1"),
            'device_data' => $this->queryArray("select * from m_device_customer"),
        );

        //$this->load->library('genfunc');
        //echo $this->genfunc->test();

        parent::template('kiriman', $data);
    }

    public function ajaxProses($id,$act)
    {
        $time = date('Y-m-d G:i:s');

        if (strtoupper($act)=='PESAN') {
            $status = 2;
            $data = array(
                'vehicle_id' => $this->input->post('vehicle'),
                'driver_id' => $this->input->post('driver'),
                'device_id' => $this->input->post('device'),
                'order_by' => (int)$this->session->userdata('user_id'),
                'order_date' => $time, //'now()',
                'shipment_status' => $status,
            );
        }
        else if (strtoupper($act)=='KIRIM') {
            $status = 3;
            $data = array(
                'delivery_by' => (int)$this->session->userdata('user_id'),
                'delivery_date' => $time, //'now()',
                'shipment_status' => $status,
            );
        }
        else if (strtoupper($act)=='AMBIL') {
            $status = 4;
            $data = array(
                'pickup_by' => (int)$this->session->userdata('user_id'),
                'pickup_date' => $time, //'now()',
                'shipment_status' => $status,
            );
        }
        else if (strtoupper($act)=='TERIMA') {
            $status = 5;
            $data = array(
                'receive_by' => (int)$this->session->userdata('user_id'),
                'receive_date' => $time, //'now()',
                'shipment_status' => $status,
            );
        }
        else if (strtoupper($act)=='SELESAI') {
            $status = 6;
            $data = array(
                'end_by' => (int)$this->session->userdata('user_id'),
                'end_date' => $time, //'now()',
                'shipment_status' => $status,
            );
        }
        $this->updateData('m_shipment', $data, array('shipment_id' => $id));
        echo json_encode(array("status" => TRUE,"act"=>$act));
    }
}