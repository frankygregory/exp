<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller
{

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Report'
        );

        parent::template('report', $data);
    }
}