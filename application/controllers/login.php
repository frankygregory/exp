<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model("Login_model");
    }

    public function index()
    {
        /*if ($this->session->userdata('isLoggedIn') == 1) {
            redirect($this->session->userdata('urlpage'));
        } else {
			
            $data = array(
                'title' => 'Login Yukirim',
				"page_name" => "login",
                'error' => ''
            );
			$this->load->view('front/common/header', $data);
            $this->load->view('front/login', $data);
			$this->load->view('front/common/footer', $data);
        }*/
    }

    public function doLogin()
    {
		$ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
		$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=" . $ip));
		$location = $geo["geoplugin_city"] . ";" . $geo["geoplugin_region"] . ";" . $geo["geoplugin_countryName"];
		//$location = "";
		//$browser = get_browser();
		//$browser_name = $browser->browser_name_pattern . ";" . $browser->platform . ";" . $browser->browser . ";" . $browser->version;
		
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        if (!preg_match('/^[a-zA-Z0-9_\.]+$/', $username) OR !preg_match('/^[a-zA-Z0-9_\.]+$/', $password)) {
            $this->view('front/login', 'Isian harus huruf atau angka');
        } else {
            if ((strlen($username) > 0) OR (strlen($password) > 0)) {
                $insertData = array(
                    "username" => $username,
                    "password" => $password,
                    "ip" => $ip,
                    "location" => $location,
                    "browser" => $_SERVER["HTTP_USER_AGENT"]
                );
                $user = $this->Login_model->login($insertData);
                if (sizeof($user) > 0) {
                    if ($user[0]["result"] == "false") {
                        echo "error";
                    } else {
                        $this->setuserdata(
                            $user[0]['user_id'],
                            $user[0]['username'],
                            $user[0]['user_fullname'],
                            $user[0]['group_ids'],
                            $user[0]['user_level'],
                            $user[0]['role_id'],
                            $user[0]['type_id'],
                            'menu',
                            'dashboard'
                        );
                        echo "success";
                    }
                }
            }
        }
		
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function view($file, $value)
    {
        $data = array(
            'title' => 'Login Yukirim',
            'error' => $value
        );
        $this->load->view($file, $data);
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