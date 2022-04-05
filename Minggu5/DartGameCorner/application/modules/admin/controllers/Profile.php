<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login();
        $this->load->library('form_validation');
    }

    public function index()

    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Dashboard';
        $data['nama'] = $nama;
        // $data['products'] = $this->Products_model->getAllProducts();
        // if ($this->input->post('keyword')) {
        //     $data['products'] = $this->Products_model->cariDataProducts();
        // }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('vprofile', $data);
        $this->load->view('templates/footer');
    }
}
