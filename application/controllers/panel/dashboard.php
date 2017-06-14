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
        $this->activeMenu["dashboard"] = "active";
        $data = array(
            'title' => 'Dashboard',
			"page_title" => "Dashboard"
        );

        parent::template('dashboard', $data);
    }
}
