<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekanan_ekspedisi extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Rekanan_ekspedisi_model");
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
}