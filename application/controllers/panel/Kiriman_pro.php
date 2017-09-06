<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiriman_pro extends MY_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model("Kiriman_pro_model");
		$this->loadModule("tabs");
		$this->loadModule("rating");
    }

    public function index()
    {   
		$this->activeMenu["kiriman_saya_bisnis"] = "active";
		$data = array(
            'title' => 'Kiriman Tertutup',
			'page_title' => "Kiriman Tertutup",
        );
		
        parent::template('kiriman_pro', $data);
	}

	public function getInfoEkspedisi() {
		parent::checkAjaxRequest();

		$shipment_id = $this->input->post("shipment_id");
		$result = $this->Kiriman_pro_model->getInfoEkspedisi($shipment_id)[0];
		$result->pending_date = date_format(new DateTime($result->pending_date), "d-m-Y H:i");
		$result->confirmation_date = date_format(new DateTime($result->confirmation_date), "d-m-Y H:i");
		if ($result->bidding_type == 1) {
			$result->order_date = date_format(new DateTime($result->order_date), "d-m-Y H:i");
			$result->delivery_date = date_format(new DateTime($result->delivery_date), "d-m-Y H:i");
			$result->pickup_date = date_format(new DateTime($result->pickup_date), "d-m-Y H:i");
			$result->receive_date = date_format(new DateTime($result->receive_date), "d-m-Y H:i");
		} else {
			$result->door_start_date = date_format(new DateTime($result->door_start_date), "d-m-Y H:i");
			$result->port_start_date = date_format(new DateTime($result->port_start_date), "d-m-Y H:i");
			$result->port_finish_date = date_format(new DateTime($result->port_finish_date), "d-m-Y H:i");
			$result->door_finish_date = date_format(new DateTime($result->door_finish_date), "d-m-Y H:i");
		}
		echo json_encode($result);
	}

	public function getAllStatusKiriman() {
		parent::checkAjaxRequest();

		$shipment_id = $this->input->post("shipment_id");
		if ($shipment_id) {
			$result = $this->Kiriman_pro_model->getAllStatusKiriman($shipment_id)[0];
			if ($result->status == "success") {
				$result->pending_date = date_format(new DateTime($result->pending_date), "d-m-Y H:i");
				$result->confirmation_date = date_format(new DateTime($result->confirmation_date), "d-m-Y H:i");
				
				if ($result->bidding_type == 1) {
					$result->order_date = date_format(new DateTime($result->order_date), "d-m-Y H:i");
					$result->delivery_date = date_format(new DateTime($result->delivery_date), "d-m-Y H:i");
					$result->pickup_date = date_format(new DateTime($result->pickup_date), "d-m-Y H:i");
					$result->receive_date = date_format(new DateTime($result->receive_date), "d-m-Y H:i");
					$result->end_date = date_format(new DateTime($result->end_date), "d-m-Y H:i");
				} else {
					$result->door_start_date = date_format(new DateTime($result->door_start_date), "d-m-Y H:i");
					$result->port_start_date = date_format(new DateTime($result->port_start_date), "d-m-Y H:i");
					$result->port_finish_date = date_format(new DateTime($result->port_finish_date), "d-m-Y H:i");
					$result->door_finish_date = date_format(new DateTime($result->door_finish_date), "d-m-Y H:i");
					$result->ending_date = date_format(new DateTime($result->ending_date), "d-m-Y H:i");
				}
			}
			echo json_encode($result);
		}
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
	
	public function getKirimanCount() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_pro_model->getKirimanCount($user_id)[0];
		echo json_encode($kiriman);
	}
	
	public function getOpenKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_pro_model->getOpenKiriman($user_id);
		$iLength = sizeof($kiriman);
		for ($i = 0; $i < $iLength; $i++) {
			$berakhir = $kiriman[$i]->berakhir;
			$kiriman[$i]->berakhir = $this->secondsToTime($berakhir);
		}
		echo json_encode($kiriman);
	}

	public function getProgressKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_pro_model->getProgressKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getSelesaiKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_pro_model->getSelesaiKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getCancelKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_pro_model->getCancelKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function submitRating() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$user_id_ref = $this->session->userdata("user_id_ref");
		$shipment_id = $this->input->post("shipment_id");
		$shipment_rating_number = $this->input->post("shipment_rating_number");
		$shipment_rating_feedback = $this->input->post("shipment_rating_feedback");
		
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id,
			"shipment_rating_number" => $shipment_rating_number,
			"shipment_rating_feedback" => $shipment_rating_feedback,
			"user_id_ref" => $user_id_ref
		);
		
		$affected_rows = $this->Kiriman_pro_model->submitRating($data);
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
		$affected_rows = $this->Kiriman_pro_model->cancelShipment($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
}