<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata("role_id") == 3) {
            header("Location: " . base_url("admin"));
            exit();
        }
        $this->activeMenu["dashboard"] = "active";
        $data = array(
            'title' => 'Dashboard',
			"page_title" => "Dashboard"
        );

        parent::template('dashboard', $data);
    }
}
