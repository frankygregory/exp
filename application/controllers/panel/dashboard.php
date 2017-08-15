<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Dashboard_model");
    }

    public function index()
    {
        $role_id = $this->session->userdata("role_id");
        if ($role_id == 3) {
            header("Location: " . base_url("admin"));
            exit();
        }
        $this->activeMenu["dashboard"] = "active";
        
        $data = array(
            'title' => 'Dashboard',
			"page_title" => "Dashboard",
            "role_id" => $role_id
        );

        parent::template('dashboard', $data);
    }

    public function getKirimanCount() {
        parent::checkAjaxRequest();

        $user_id = $this->session->userdata("user_id");
        $role_id = $this->session->userdata("role_id");
        $result;
        if ($role_id == 1) {
            $result = $this->Dashboard_model->getKonsumenKirimanCount($user_id)[0];
        } else {
            $result = $this->Dashboard_model->getEkspedisiKirimanCount($user_id)[0];
        }
        
        echo json_encode($result);
    }
}
