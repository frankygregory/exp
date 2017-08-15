<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role_id") != 3) {
            show_404();
        }

        $this->load->model("Admin_model");
    }

    public function index()
    {
        $this->activeMenu["admin"] = "active";
        $data = array(
            'title' => 'Admin',
			'page_title' => "Admin"
        );

        parent::template('admin', $data);
    }

    public function login_as() {
        $ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
        $location = "";
        $browser = $_SERVER["HTTP_USER_AGENT"];

        $username_or_email = $this->input->post("username_or_email", true);
        if ($username_or_email) {
            $data = array(
                "username_or_email" => $username_or_email,
                "ip" => $ip,
                "location" => $location,
                "browser" => $browser
            );
            $result = $this->Admin_model->login_as($data)[0];
            if ($result->result == "true") {
                $this->setuserdata(
                    $result->user_id,
                    $result->username,
                    $result->user_fullname,
                    $result->group_ids,
                    $result->user_level,
                    $result->role_id,
                    $result->type_id,
                    'menu',
                    'dashboard'
                );
                
                header("Location: " . base_url("dashboard"));
            } else {
                $this->session->set_flashdata("flash_message", "Username / Email tidak ada");
                header("Location: " . base_url("admin"));
            }
        } else {
            $this->session->set_flashdata("flash_message", "Username / Email tidak ada");
            header("Location: " . base_url("admin"));
        }
    }

    public function verifikasi_user() {
        $this->loadModule("pagination");
        $this->activeMenu["verifikasi"] = "active";
        $data = array(
            'title' => 'Verifikasi',
			'page_title' => "Verifikasi"
        );

        parent::template('verifikasi', $data);
    }

    public function getUnverifiedUser() {
        parent::checkAjaxRequest();

        $limit = $this->input->post("view_per_page");
        $page = $this->input->post("page");
        $change_page = $this->input->post("change_page");
        $offset = ($page - 1) * $limit;

        $data = array(
            "limit" => $limit,
            "offset" => $offset
        );

        $data = $this->Admin_model->getUnverifiedUser($data);

        $result = new stdClass();
		$result->data = $data;

		if ($change_page == "false") {
			$count = $this->Admin_model->getUnverifiedUserCount()[0]->count;
			$result->count = $count;
		}
        echo json_encode($result);
    }

    public function getSuratUser() {
        parent::checkAjaxRequest();

        $user_id = $this->input->post("user_id", true);
        $result = $this->Admin_model->getSuratUser($user_id)[0];
        echo json_encode($result);
    }

    public function verifyUser() {
        $user_id = $this->input->post("user_id", true);
        $modified_by = $this->session->userdata("user_id");
        
        $data = array(
            "user_id" => $user_id,
            "modified_by" => $modified_by
        );
        $db = $this->Admin_model->verifyUser($data);
        parent::generate_common_results($db, "ci");
    }

    public function setuserdata($user_id, $username, $user_fullname, $group_ids, $user_level, $role_id, $type_id, $menu, $urlpage)
    {
        $this->session->set_userdata(array(
                'user_id' => $user_id,
                'username' => $username,
                'user_fullname' => $user_fullname,
				'group_ids' => $group_ids,
                'user_level' => $user_level,
                'role_id' => $role_id,
				'type_id' => $type_id,
                'menu' => $menu,
                'urlpage' => $urlpage,
                'isLoggedIn' => true
            )
        );
    }
}