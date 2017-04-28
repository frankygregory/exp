<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiriman extends MY_Controller
{

    public function __construct(){
        parent::__construct();
        //$this->load->library('typography');
    }

    public function index()
    {   
		$data = array(
            'title' => 'Kiriman Saya',
			'page_title' => "Kiriman Saya",
        );
        parent::template('kiriman', $data);
	}
}