<?php

class Statistik_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getStatistik($user_id) {
		$query = $this->db->query(
			"SELECT *
			FROM `t_statistic`
			WHERE user_id = '" . $user_id . "';"
		);
		return $query->result();
	}
}
