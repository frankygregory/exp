<?php

class User_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function select_user(){
        return $this->db->query("select * from m_user order by user_id desc")->result_array();
    }
	
	public function updateExistingGroup($data) {
		$this->db->where("user_id", $data["user_id"]);
		$this->db->limit(1);
		$updateData = array(
			"group_name" => $data["group_name"],
			"modified_by" => $data["modified_by"]
		);
		$this->db->update("m_group", $updateData);
	}
	
	public function insertGroup($data) {
		$insertData = array(
			"group_name" => $data["group_name"],
			"created_by" => $data["user_id"],
			"modified_by" => $data["user_id"]
		);
		$this->db->insert("m_group", $insertData);
		return $this->db->affected_rows();
	}
}