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
        header("Location: " . base_url());
    }

    public function doLogin()
    {
		$ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
		//$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=" . $ip));
		//$location = $geo["geoplugin_city"] . ";" . $geo["geoplugin_region"] . ";" . $geo["geoplugin_countryName"];
		$location = "";
		//$browser = get_browser();
		//$browser_name = $browser->browser_name_pattern . ";" . $browser->platform . ";" . $browser->browser . ";" . $browser->version;
		
        $user_email = $this->input->post('user_email', true);
        $password = $this->input->post('password', true);
        
        if ((strlen($user_email) > 0) OR (strlen($password) > 0)) {
            $insertData = array(
                "user_email" => $user_email,
                "password" => $password,
                "ip" => $ip,
                "location" => $location,
                "browser" => $_SERVER["HTTP_USER_AGENT"]
            );
            $user = $this->Login_model->login($insertData);
            if (sizeof($user) > 0) {
                if ($user[0]["result"] == "false") {
                    $result = new stdClass();
                    $result->status = "error";
                    $result->reason = "Email / Password salah";
                    echo json_encode($result);
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
                    $result = new stdClass();
                    $result->status = "success";
                    echo json_encode($result);
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