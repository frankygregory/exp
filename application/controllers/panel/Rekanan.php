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

        $role_id = $this->session->userdata("role_id");
        $user_id = $this->session->userdata("user_id");
        $keyword = $this->input->post("keyword");
        $result = $this->Rekanan_model->searchUsernameOrName($role_id, $keyword, $user_id);
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
            if ($result->status == "success") {
                $config = parent::get_default_email_config();
		        $this->load->library("email", $config);

                $this->email->set_newline("\r\n");
                $this->email->from("admin@wahanafurniture.com", "Yukirim");
                $this->email->to($result->party_email);
                $this->email->subject("Permintaan Rekanan Yukirim");
                $this->email->message("Dear " . $result->party_fullname . ",\n\nUser " . $result->user_username . " telah mengirimi Anda permintaan untuk menjadi rekanan. Silakan melihat di " . base_url("rekanan") . "\n\nBest regards,\n\nYukirim");
                $this->email->send();
            }
            echo json_encode($result);
        }
    }

    public function konfirmasiRekanan() {
        parent::checkAjaxRequest();

        $party_id = $this->input->post("user_id", true);
        $user_id = $this->session->userdata("user_id");
        if ($party_id && $user_id) {
            $data = array(
                "party_id" => $party_id,
                "user_id" => $user_id
            );
            $result = $this->Rekanan_model->konfirmasiRekanan($data)[0];
            echo json_encode($result);
        }
    }

    public function tolakRekanan() {
        parent::checkAjaxRequest();

        $party_id = $this->input->post("user_id", true);
        $user_id = $this->session->userdata("user_id");
        if ($party_id && $user_id) {
            $data = array(
                "party_id" => $party_id,
                "user_id" => $user_id
            );
            $result = $this->Rekanan_model->tolakRekanan($data)[0];
            echo json_encode($result);
        }
    }

    public function deleteRekanan() {
        parent::checkAjaxRequest();

        $party_id = $this->input->post("user_id", true);
        $user_id = $this->session->userdata("user_id");
        if ($party_id && $user_id) {
            $data = array(
                "party_id" => $party_id,
                "user_id" => $user_id
            );
            $result = $this->Rekanan_model->deleteRekanan($data)[0];
            echo json_encode($result);
        }
    }
}