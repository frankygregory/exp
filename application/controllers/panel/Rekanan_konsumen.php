<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekanan_konsumen extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Rekanan_konsumen_model");
        $this->loadModule("tabs");
    }

    public function index()
    {
		$this->activeMenu["rekanan"] = "active";
        $data = array(
            'title' => 'Rekanan',
			'page_title' => "Rekanan"
        );
        parent::template('rekanan_konsumen', $data);
    }
}