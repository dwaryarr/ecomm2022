<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Products List';
        $data['products'] = $this->Products_model->getAllProducts();
        if ($this->input->post('keyword')) {
            $data['products'] = $this->Products_model->cariDataProducts();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Products';

        $this->form_validation->set_rules('gambar', 'Gambar');
        $this->form_validation->set_rules('nama_products', 'Nama_products', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('products/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->Products_model->tambahDataProducts();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('products');
        }
    }

    public function hapus($id)
    {
        $this->Products_model->hapusDataProducts($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('products');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Data products';
        $data['products'] = $this->Products_model->getProductsById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('products/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        $data['judul'] = 'Form Ubah Data Products';
        $data['products'] = $this->Products_model->getProductsById($id);
        //        $data['genre'] = ['Action', 'Adventure', 'Animation', 'Comedy', 'Drama', 'Horror'];

        $this->form_validation->set_rules('gambar', 'Gambar');
        $this->form_validation->set_rules('nama_products', 'Nama_products', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('products/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Products_model->ubahDataProducts();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('products');
        }
    }
}
