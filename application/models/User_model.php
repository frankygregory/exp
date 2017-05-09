<?php

class User_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function select_user(){
        return $this->db->query("select * from m_user order by user_id desc")->result_array();
    }
	
	public function add_other_user($data) {
		$this->db->query("CALL add_other_user('" . $data["role_id"] . "', '" . $data["type_id"] . "', '" . $data["username"] . "', '" . $data["user_email"] . "', '" . $data["group_ids"] . "', '" . $data["user_level"] . "', '" . $data["user_id_ref"] . "', '" . $data["password"] . "');");
		return 1;
	}
	
	public function getMyGroups($user_id) {
		$this->db->where("user_id", $user_id);
		return $this->db->get("m_group")->result();
	}
	
	public function updateGroup($data) {
		$this->db->where("user_id", $data["user_id"]);
		$this->db->where("group_id", $data["group_id"]);
		$updateData = array(
			"group_name" => $data["group_name"],
			"modified_by" => $data["user_id"]
		);
		$this->db->update("m_group", $updateData);
		return $this->db->affected_rows();
	}
	
	public function insertGroup($data) {
		$this->db->query("CALL create_group('" . $data["group_name"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
}