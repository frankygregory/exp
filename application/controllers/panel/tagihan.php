<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends MY_Controller
{

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Tagihan'
        );
        parent::template('tagihan', $data);
    }
}