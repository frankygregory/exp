<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends MY_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->model("Lokasi_model");
    }

    public function index()
    {
		$this->activeMenu["lokasi"] = "active";
        $data = array(
            'title' => 'Lokasi',
			"page_title" => "Lokasi"
        );

        parent::template('lokasi', $data);
    }
	
	public function getMyLocation() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$data = $this->Lokasi_model->getMyLocation($user_id);
		echo json_encode($data);
	}
	
	public function addLocation() {
		parent::checkAjaxRequest();

		$location_name = $this->input->post("location_name");
		$location_address = $this->input->post("location_address");
		$location_city = $this->input->post("location_city");
		$location_latlng = $this->input->post("location_latlng");
		$location_lat = substr($location_latlng, 0, strpos($location_latlng, ",") - 1);
		$location_lng = substr($location_latlng, strpos($location_latlng, " ") + 1);
		$location_detail = $this->input->post("location_detail");
		$location_contact = $this->input->post("location_contact");
		$location_from = intval($this->input->post("location_from"));
		$location_to = intval($this->input->post("location_to"));
		$user_id = $this->session->userdata("user_id");

		if ($location_name && $location_address && $location_city && $location_latlng) {
			$data = array(
				"location_name" => $location_name,
				"location_address" => $location_address,
				"location_city" => $location_city,
				"location_lat" => $location_lat,
				"location_lng" => $location_lng,
				"location_detail" => $location_detail,
				"location_contact" => $location_contact,
				"location_from" => $location_from,
				"location_to" => $location_to,
				"user_id" => $user_id
			);
			$affected_rows = $this->Lokasi_model->addLocation($data);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "null";
			}
		}
	}
	
	public function updateLocation() {
		parent::checkAjaxRequest();

		$location_id = $this->input->post("location_id");
		$location_name = $this->input->post("location_name");
		$location_address = $this->input->post("location_address");
		$location_city = $this->input->post("location_city");
		$location_latlng = $this->input->post("location_latlng");
		$location_lat = substr($location_latlng, 0, strpos($location_latlng, ",") - 1);
		$location_lng = substr($location_latlng, strpos($location_latlng, " ") + 1);
		$location_detail = $this->input->post("location_detail");
		$location_contact = $this->input->post("location_contact");
		$location_from = intval($this->input->post("location_from"));
		$location_to = intval($this->input->post("location_to"));
		$user_id = $this->session->userdata("user_id");
		
		if ($location_id && $location_name && $location_address && $location_city && $location_latlng) {
			$data = array(
				"location_id" => $location_id,
				"location_name" => $location_name,
				"location_address" => $location_address,
				"location_city" => $location_city,
				"location_lat" => $location_lat,
				"location_lng" => $location_lng,
				"location_detail" => $location_detail,
				"location_contact" => $location_contact,
				"location_from" => $location_from,
				"location_to" => $location_to,
				"user_id" => $user_id
			);
			$affected_rows = $this->Lokasi_model->updateLocation($data);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "null";
			}
		}
	}
	
	public function deleteLocation() {
		parent::checkAjaxRequest();
		
		$location_id = $this->input->post("location_id");
		$user_id = $this->session->userdata("user_id");
		$affected_rows = $this->Lokasi_model->deleteLocation($location_id, $user_id);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "null";
		}
	}
}