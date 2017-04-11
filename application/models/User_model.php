<?php

class User_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function select_user(){
        return $this->db->query("select * from m_user order by user_id desc")->result_array();
    }
}