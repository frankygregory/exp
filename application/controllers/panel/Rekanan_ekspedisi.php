<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekanan_ekspedisi extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Rekanan_ekspedisi_model");
        $this->loadModule("tabs");
    }

    public function index()
    {
		$this->activeMenu["rekanan"] = "active";
        $data = array(
            'title' => 'Rekanan',
			'page_title' => "Rekanan"
        );
        parent::template('rekanan_ekspedisi', $data);
    }

    public function getRekanan() {
        parent::checkAjaxRequest();

        $user_id = $this->session->userdata("user_id");
        if ($user_id) {
            $result = $this->Rekanan_ekspedisi_model->getRekanan($user_id);
            echo json_encode($result);
        }
    }

    public function getPendingRekanan() {
        parent::checkAjaxRequest();

        $user_id = $this->session->userdata("user_id");
        if ($user_id) {
            $result = $this->Rekanan_ekspedisi_model->getPendingRekanan($user_id);
            echo json_encode($result);
        }
    }
}