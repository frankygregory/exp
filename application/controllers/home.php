<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini_set('max_execution_time', 0); 
//ini_set('memory_limit','2048M');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Home',
            'active' => array('active', '', '', ''),
        );

        $msg = '';
        $this->session->set_flashdata('msg', $msg);

        $this->load->view('front/home', $data);
    }

    public function contact()
    {
        $data = array(
            'title' => 'Contact',
            'active' => array('', '', 'active', ''),
        );
        $this->load->view('front/contact', $data);
    }

    public function register()
    {
        $data = array(
            'title' => 'Register',
            'active' => array('', '', '', 'active'),
        );
        $this->load->view('front/register', $data);
    }

    public function privacy_policy(){
        $data = array(
            'title' => 'Kebijakan Privasi',
            'active' => array('', '', '', 'active'),
        );
        $this->load->view('front/privacy_policy', $data);
    }

    public function doRegisterConsumer()
    {
        if ($this->form_validation->run('registration_consumer') == FALSE) {
            $data = array(
                'title' => 'Register',
                'active' => array('', '', '', 'active'),
            );
            $this->load->view('front/register', $data);
        } else {
          //  $this->load->model('Registration_model');
            $this->Registration_model->doRegisterConsumer_model();

            $msg = '<div class="alert alert-success fade in block-inner">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<i class="icon-checkmark-circle"></i> Sukses! Data berhasil tersimpan.
							 </div>';

            $this->session->set_flashdata('msg', $msg);
            redirect(base_url() . "register");
        }
    }

    public function doRegisterExpedition()
    {
       // $this->load->model('Registration_model');
	    
	if ($this->form_validation->run('registration_expedition') == FALSE) {
            $data = array(
                'title' => 'Register',
                'active' => array('', '', '', 'active'),
            );
            $this->load->view('front/register', $data);
        } else {
            $this->load->model('Login_model');
            $this->Registration_model->doRegisterExpedition_model();

            $msg = '<div class="alert alert-success fade in block-inner">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<i class="icon-checkmark-circle"></i> Sukses! Data berhasil tersimpan.
							 </div>';

            $this->session->set_flashdata('msg', $msg);
            redirect(base_url() . "register");
        }
    }

    public function getValue($inputname)
    {
        return $this->input->post($inputname);
    }
}
