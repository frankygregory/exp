<?php

$config = array(
    'login' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[8]|max_length[15]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ),

    'registration_consumer' => array(
        array(
            'field' => 'type_id',
            'label' => 'Type Id',
            'rules' => 'required',
        ),
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[8]|max_length[15]|is_unique[m_user.username]',
        ),
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'hp',
            'label' => 'Handphone',
            'rules' => 'trim|required|numeric|min_length[11]|max_length[12]',
        ),
        array(
            'field' => 'tlp',
            'label' => 'Telephone',
            'rules' => 'trim|required|numeric|min_length[8]|max_length[10]',
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|is_unique[m_user.user_email]',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[8]',
        ),
        array(
            'field' => 'passconf',
            'label' => 'Password Confirmation',
            'rules' => 'trim|required|matches[password]',
        ),
        array(
            'field' => 'term-conditions',
            'label' => 'Term & Conditions',
            'rules' => 'required',
        ),
    ),

    'registration_expedition' => array(
        array(
            'field' => 'username_expedition',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[8]|max_length[15]',
        ),
        array(
            'field' => 'name_expedition',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'hp_expedition',
            'label' => 'Handphone',
            'rules' => 'trim|required|numeric|min_length[11]|max_length[12]',
        ),
        array(
            'field' => 'tlp_expedition',
            'label' => 'Telephone',
            'rules' => 'trim|required|numeric|min_length[8]|max_length[10]',
        ),
        array(
            'field' => 'email_expedition',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
        ),
        array(
            'field' => 'password_expedition',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[8]',
        ),
        array(
            'field' => 'passconf_expedition',
            'label' => 'Password Confirmation',
            'rules' => 'trim|required|matches[password_expedition]',
        ),
        array(
            'field' => 'term-conditions-expedition',
            'label' => 'Term & Conditions',
            'rules' => 'required',
        ),
    ),

    'kirim' => array(
        array(
            'field' => 'shipment_title',
            'label' => 'Judul Kiriman',
            'rules' => 'required'
        ),
        array(
            'field' => 'shipment_information',
            'label' => 'Keterangan',
            'rules' => 'required'
        ),
        array(
            'field' => 'location_from_name',
            'label' => 'Lokasi Awal',
            'rules' => 'required'
        ),
        array(
            'field' => 'location_from_address',
            'label' => 'Detail Lokasi Awal',
            'rules' => 'required'
        ),
        array(
            'field' => 'location_to_name',
            'label' => 'Lokasi Tujuan',
            'rules' => 'required'
        ),
        array(
            'field' => 'shipment_delivery_date_to',
            'label' => 'Tanggal Awal Kirim',
            'rules' => 'required'
        ),
        array(
            'field' => 'shipment_end_date',
            'label' => 'Tanggal Akhir Kirim',
            'rules' => 'required'
        ),
        array(
            'field' => 'shipment_type',
            'label' => 'Type Penawaran',
            'rules' => 'required'
        ),
    ),
	
	'confirm' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[8]|max_length[15]|is_unique[m_user.username]',
        ),
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|min_length[8]',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[8]',
        ),
        array(
            'field' => 'passconf',
            'label' => 'Password Confirmation',
            'rules' => 'trim|required|matches[password]',
        ),
        array(
            'field' => 'term-conditions',
            'label' => 'Term & Conditions',
            'rules' => 'required',
        ),
    ),


);

$config['error_prefix'] = '<div class="error_prefix">';
$config['error_suffix'] = '</div>';