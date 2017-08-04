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
        }
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