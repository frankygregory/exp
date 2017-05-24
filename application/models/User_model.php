<?php

class User_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function select_user(){
        return $this->db->query("select * from m_user order by user_id desc")->result_array();
    }
	
	public function getOtherUser($data) {
		$str = "SELECT u.user_id, u.username, u.user_email, u.user_fullname, u.user_level, u.user_status, GROUP_CONCAT(g.group_id SEPARATOR ';') AS group_ids, GROUP_CONCAT(g.group_name SEPARATOR ';') AS group_names
			FROM `m_user` u, `m_user_group` ug
			LEFT JOIN (SELECT g.group_id, g.group_name FROM `m_group` g) g
            ON g.group_id = ug.group_id
			WHERE u.user_status != -1 AND ug.user_id = u.user_id AND ug.user_id != '" . $data["user_id"] . "' AND (";
		
		$group_ids = explode(";", $data["group_ids"]);
		$iLength = sizeof($group_ids);
		$str .= "ug.group_id = " . $group_ids[0];
		for ($i = 1; $i < $iLength; $i++) {
			$str .= " OR ug.group_id = " . $group_ids[$i];
		}
		$str .= ");";
		$data = $this->db->query($str);
		return $data->result();
	}
	
	public function add_other_user($data) {
		$data["password"] = md5($data["password"]);
		$this->db->query("CALL add_other_user('" . $data["role_id"] . "', '" . $data["type_id"] . "', '" . $data["username"] . "', '" . $data["user_email"] . "', '" . $data["group_ids"] . "', '" . $data["user_level"] . "', '" . $data["user_id_ref"] . "', '" . $data["password"] . "', '" . $data["user_fullname"] . "');");
		return 1;
	}
	
	public function updateUser($data) {
		$query = $this->db->query("CALL update_other_user('" . $data["other_user_id"] . "', '" . $data["other_user_fullname"] . "', '" . $data["group_ids"] . "', '" . $data["other_user_level"] . "', '" . $data["other_user_status"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
	
	public function deleteUser($data) {
		$query = $this->db->query("CALL delete_other_user('" . $data["other_user_id"] . "', '" . $data["user_id"] . "');");
		return 1;
	}
	
	public function getMyGroups($user_id) {
		$query = $this->db->query("
			SELECT *
			FROM `m_group`
			WHERE user_id = '" . $user_id . "' AND group_status != -1
		");
		return $query->result();
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
	
	public function deleteGroup($data) {
		$query = $this->db->query("CALL delete_group('" . $data["group_id"] . "', '" . $data["user_id"] . "');");
		$result = $query->result()[0];
		if ($result->result == "success") {
			return 1;
		} else {
			return 0;
		}
	}
}