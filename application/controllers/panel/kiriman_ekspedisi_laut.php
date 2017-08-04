<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiriman_ekspedisi_laut extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Kiriman_ekspedisi_laut_model");
		$this->loadModule("tabs");
		$this->loadModule("datepicker");
    }

    public function index()
    {   
		$this->activeMenu["kiriman_laut"] = "active";
		$data = array(
            'title' => 'Kiriman Laut',
			'page_title' => "Kiriman Laut",
        );
		
        parent::template('kiriman_ekspedisi_laut', $data);
	}

	public function getAllStatusKiriman() {
		parent::checkAjaxRequest();

		$shipment_id = $this->input->post("shipment_id");
		if ($shipment_id) {
			$result = $this->Kiriman_ekspedisi_laut_model->getAllStatusKiriman($shipment_id)[0];
			if ($result->status == "success") {
				$result->pending_date = date_format(new DateTime($result->pending_date), "d-m-Y H:i");
				$result->confirmation_date = date_format(new DateTime($result->confirmation_date), "d-m-Y H:i");
				
				$result->door_start_date = date_format(new DateTime($result->door_start_date), "d-m-Y H:i");
				$result->port_start_date = date_format(new DateTime($result->port_start_date), "d-m-Y H:i");
				$result->port_finish_date = date_format(new DateTime($result->port_finish_date), "d-m-Y H:i");
				$result->door_finish_date = date_format(new DateTime($result->door_finish_date), "d-m-Y H:i");
				
			}
			echo json_encode($result);
		}
	}

	public function getDetailPengirim() {
		parent::checkAjaxRequest();

		$shipment_id = $this->input->post("shipment_id");
		$result = $this->Kiriman_ekspedisi_laut_model->getDetailPengirim($shipment_id)[0];
		$result->door_start_date = date_format(new DateTime($result->door_start_date), "d-m-Y H:i");
		$result->port_start_date = date_format(new DateTime($result->port_start_date), "d-m-Y H:i");
		$result->port_finish_date = date_format(new DateTime($result->port_finish_date), "d-m-Y H:i");
		$result->door_finish_date = date_format(new DateTime($result->door_finish_date), "d-m-Y H:i");
		echo json_encode($result);
	}
	
	public function getDealKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_laut_model->getDealKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getPendingKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_laut_model->getPendingKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getDoorAwalKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_laut_model->getDoorAwalKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getPortAwalKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_laut_model->getPortAwalKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getPortAkhirKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_laut_model->getPortAkhirKiriman($user_id);
		echo json_encode($kiriman);
	}
	public function getDoorAkhirKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_laut_model->getDoorAkhirKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getSelesaiKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_laut_model->getSelesaiKiriman($user_id);
		$iLength = sizeof($kiriman);
		for ($i = 0; $i < $iLength; $i++) {
			$waktu = $kiriman[$i]->total_waktu;
			$kiriman[$i]->total_waktu = $this->secondsToDay($waktu);
		}
		echo json_encode($kiriman);
	}
	public function getCancelKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_laut_model->getCancelKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a hari, %h jam, %i menit');
	}
	
	function secondsToDay($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a');
	}
		
	public function getKirimanSaya() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_laut_model->getKirimanCount($user_id);
		echo json_encode($kiriman);
	}
	
	public function submitDeal() {
		parent::checkAjaxRequest();

		$shipment_id = $this->input->post("shipment_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->Kiriman_ekspedisi_laut_model->submitDeal($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function submitUbah() {
		parent::checkAjaxRequest();

		$shipment_id = $this->input->post("shipment_id");
		$ship_id = $this->input->post("ship_id");
		$shipment_details_container_number = $this->input->post("shipment_details_container_number");
		$shipment_status = $this->input->post("shipment_status");
		$datetime = date_format(new DateTime($this->input->post("datetime")), "Y-m-d H:i:s");
		$user_id = $this->session->userdata("user_id");
		
		$data = array(
			"shipment_id" => $shipment_id,
			"ship_id" => $ship_id,
			"shipment_details_container_number" => $shipment_details_container_number,
			"shipment_status" => $shipment_status,
			"datetime" => $datetime,
			"user_id" => $user_id
		);
		$affected_rows = $this->Kiriman_ekspedisi_laut_model->submitUbah($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function cancelShipment() {
		parent::checkAjaxRequest();

		$shipment_id = $this->input->post("shipment_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->Kiriman_ekspedisi_laut_model->cancelShipment($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function getKendaraan() {
		parent::checkAjaxRequest();
		
		$user_id = $this->session->userdata("user_id");
		$vehicle = $this->Kiriman_ekspedisi_laut_model->getKendaraanAktif($user_id);
		echo json_encode($vehicle);
	}
}