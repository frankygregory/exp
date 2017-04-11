<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Dashboard'
        );
		
		$query = $this->db->query("select user_id, party_id from m_user_party where user_id = 1 or party_id = 1");

		$row = $query->row();

        parent::template('home', $data);
    }
}
