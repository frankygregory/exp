<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function create_captcha() {
        $options = array(
                    'img_path' => './captcha/',
                    'img_url' => base_url('captcha/'),
                    'img_width' => '125',
                    'img_height' => '40',
                    'expiration' => 7200,
                   );

        $cap = create_captcha($options);
        $image = $cap['image'];
        $this->session->set_userdata('captchaword',$cap['word']);
        return $image;
    }

    function check_captcha() {
        if ($this->input->post('captcha')==$this->session->userdata('captchaword')) {
            return true;
        }
        else {
            $this->form_validation->set_message('check_captcha','Captcha is wrong');
            return false;
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('captcha','Captcha','trim|callback_check_captcha|required');

        if ($this->session->userdata('isLoggedIn') == 1) {
            redirect($this->session->userdata('urlpage'));
        } else {
            $img = '';
            if ($this->form_validation->run() == false) {
                $img = $this->create_captcha();
            }
			
            $data = array(
                'title' => 'Login Yukirim',
                'error' => '',
                'img' => $img,
            );
            $this->load->view('front/login', $data);
        }
    }

    public function doLogin()
    {
//        if ($this->check_captcha()) {
            if ($this->form_validation->run('login') == FALSE) {
                $data = array(
                    'title' => 'Login Yukirim',
                    'error' => '',
                    'img' => $this->create_captcha(),
                );
                $this->load->view('front/login', $data);
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
				
                if (!preg_match('/^[a-zA-Z0-9_\.]+$/', $username) OR !preg_match('/^[a-zA-Z0-9_\.]+$/', $password)) {
                    $this->view('front/login', 'Isian harus huruf atau angka');
                } else {
                    if ((strlen($username) > 0) OR (strlen($password) > 0)) {
                        if ($user = $this->db->query("select * from m_user where username = '" . $username . "' limit 1")->result_array()) {

                            if ($user[0]['password'] == md5($password)) {

//                                if ($user[0]['user_level'] == 1) {

                                    $this->setuserdata(
                                        $user[0]['user_id'],
                                        $user[0]['username'],
                                        $user[0]['user_fullname'],
										$user[0]['organization_id'],
										$user[0]['group_id'],
                                        $user[0]['user_level'],
                                        $user[0]['role_id'],
                                        'menu',
                                        'dashboard'
                                    );
                                    redirect('dashboard');

/*                                } elseif ($user[0]['user_level'] == 2) {
                                    if ($user[0]['role_id'] == 1) {
                                        $this->setuserdata(
                                            $user[0]['user_id'],
                                            $user[0]['username'],
                                            $user[0]['user_fullname'],
                                            $user[0]['user_level'],
                                            $user[0]['role_id'],
                                            'user/consumer/common/menu',
                                            'consumer/home'
                                        );
                                        redirect('consumer/home');
                                    } elseif ($user[0]['role_id'] == 2) {
                                        $this->setuserdata(
                                            $user[0]['user_id'],
                                            $user[0]['username'],
                                            $user[0]['user_fullname'],
                                            $user[0]['user_level'],
                                            $user[0]['role_id'],
                                            'user/expedition/common/menu',
                                            'expedition/home'
                                        );
                                        redirect('expedition/home');
                                    }
                                }*/
                            } else {
                                $data = array(
                                    'title' => 'Login Yukirim',
                                    'error' => 'Password salah!!',
                                    'img' => $this->create_captcha(),
                                );
                                $this->load->view('front/login', $data);
                            }
                        } else {
                            $data = array(
                                'title' => 'Login Yukirim',
                                'error' => 'Username salah!!',
                                'img' => $this->create_captcha(),
                            );
                            $this->load->view('front/login', $data);
                        }
                    }
                }
            }
//        }
//        else {
//            $data = array(
//                'title' => 'Login Yukirim',
//                'error' => 'Wrong Captcha!!',
//                'img' => $this->create_captcha(),
//            );
//            $this->load->view('front/login', $data);
//        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function view($file, $value)
    {
        $data = array(
            'title' => 'Login Yukirim',
            'error' => $value
        );
        $this->load->view($file, $data);
    }

    public function setuserdata($user_id, $username, $user_fullname, $organization_id, $group_id, $user_level, $role_id, $menu, $urlpage)
    {
        $this->session->set_userdata(array(
                'user_id' => $user_id,
                'username' => $username,
                'user_fullname' => $user_fullname,
				'organization_id' => $organization_id,
				'group_id' => $group_id,
                'user_level' => $user_level,
                'role_id' => $role_id,
                'menu' => $menu,
                'urlpage' => $urlpage,
                'isLoggedIn' => true
            )
        );
    }

}