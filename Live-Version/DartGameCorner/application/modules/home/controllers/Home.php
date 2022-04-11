<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products/Products_model');
        $this->load->library('form_validation');
    }

    public function index($nama = 'Mate')
    {
        $data['judul'] = 'Halaman Home';
        $data['nama'] = $nama;
        $data['products'] = $this->Products_model->getAllProducts();
        if ($this->input->post('keyword')) {
            $data['products'] = $this->Products_model->cariDataProducts();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }
}
