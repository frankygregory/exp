<?php

class Registration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function doRegisterConsumer_model(){

        $roleId = $this->input->post('role_id');
        $type_id = $this->input->post('type_id');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $alamat = $this->input->post('useraddress');
        $tlp = $this->input->post('tlp');
        $hp = $this->input->post('hp');
        $password = $this->input->post('password');
        $term = $this->input->post('term-conditions');

        $data = array(
            'role_id' => $roleId,
            'type_id' => $type_id,
            'username' => $username,
            'user_email' => $email,
            'user_fullname' => $name,
            'user_address' => $alamat,
            'user_telephone' => $tlp,
            'user_handphone' => $hp,
            'password' => md5($password),
            'user_termsandconditions' => $term,
            'user_last_login_date' => date('d-m-y h:i:s'),
            'created_date' => date('d-m-y h:i:s'),
            'created_by' => $username,
            'modified_date' => date('d-m-y h:i:s'),
            'modified_by' => $username,
        );

        $this->db->insert('m_user', $data);
    }

    public function doRegisterExpedition_model(){
        $roleId = $this->input->post('role_id');
        $username = $this->input->post('username_expedition');
        $email = $this->input->post('email_expedition');
        $name = $this->input->post('name_expedition');
        $alamat = $this->input->post('address_expedition');
        $tlp = $this->input->post('tlp_expedition');
        $hp = $this->input->post('hp_expedition');
        $password = $this->input->post('password_expedition');
        $term = $this->input->post('term-conditions-expedition');

        $data = array(
            'role_id' => $roleId,
            'username' => $username,
            'user_email' => $email,
            'user_fullname' => $name,
            'user_address' => $alamat,
            'user_telephone' => $tlp,
            'user_handphone' => $hp,
            'password' => md5($password),
            'user_termsandconditions' => $term,
            'user_last_login_date' => date('d-m-y h:i:s'),
            'created_date' => date('d-m-y h:i:s'),
            'created_by' => $username,
            'modified_date' => date('d-m-y h:i:s'),
            'modified_by' => $username,
        );

        $this->db->insert('m_user', $data);
    }

}
