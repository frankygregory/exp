<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekanan extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Rekanan_model");
        $this->loadModule("tabs");
    }

    public function index()
    {
		$this->activeMenu["rekanan"] = "active";
        $data = array(
            'title' => 'Rekanan',
			'page_title' => "Rekanan"
        );
        parent::template('rekanan', $data);
    }

    public function getRekanan() {
        parent::checkAjaxRequest();

        $user_id = $this->session->userdata("user_id");
        if ($user_id) {
            $result = $this->Rekanan_model->getRekanan($user_id);
            echo json_encode($result);
        }
    }

    public function getPendingRekanan() {
        parent::checkAjaxRequest();

        $user_id = $this->session->userdata("user_id");
        if ($user_id) {
            $result = $this->Rekanan_model->getPendingRekanan($user_id);
            echo json_encode($result);
        }
    }

    public function getRekananCount() {
        parent::checkAjaxRequest();
        $user_id = $this->session->userdata("user_id");
        if ($user_id) {
            $result = $this->Rekanan_model->getRekananCount($user_id)[0];
            echo json_encode($result);
        }
    }

    public function searchUsernameOrName() {
        parent::checkAjaxRequest();

        $user_id = $this->session->userdata("user_id");
        $keyword = $this->input->post("keyword");
        $result = $this->Rekanan_model->searchUsernameOrName($keyword, $user_id);
        echo json_encode($result);
    }

    public function requestRekanan() {
        parent::checkAjaxRequest();

        $party_id = $this->input->post("user_id", true);
        $user_id = $this->session->userdata("user_id");
        if ($party_id && $user_id) {
            $data = array(
                "party_id" => $party_id,
                "user_id" => $user_id
            );
            $result = $this->Rekanan_model->requestRekanan($data)[0];
            echo json_encode($result);
        }
    }
}