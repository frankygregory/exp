<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__partial_construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Admin',
			'page_title' => "Admin"
        );

        parent::template('admin', $data);
    }
}