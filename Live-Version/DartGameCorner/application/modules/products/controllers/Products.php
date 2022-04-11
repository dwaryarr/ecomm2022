<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model('menu/Menu_model');
        $this->simple_login->cek_login();
    }

    public function index()
    {
        $nama = $this->session->userdata('name');
        $data['nama'] = $nama;
        $data['judul'] = 'Products List';
        $data['products'] = $this->Products_model->getAllProducts();
        if ($this->input->post('keyword')) {
            $data['products'] = $this->Products_model->cariDataProducts();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer');
    }

    public function list()
    {
        $nama = $this->session->userdata('name');
        $data['nama'] = $nama;
        $data['judul'] = 'List Produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['products'] = $this->Products_model->getAllProducts();
        if ($this->input->post('keyword')) {
            $data['products'] = $this->Products_model->cariDataProducts();
        }
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('products/list', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('gambar', 'Gambar');
        $this->form_validation->set_rules('nama_produk', 'Nama_produk', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('products/tambah');
            $this->load->view('templates/user_footer');
        } else {
            $this->Products_model->tambahDataProducts();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Produk baru ditambahkan!</div>');
            redirect('products/tambah');
        }
    }

    public function hapus($id_produk)
    {
        $this->Products_model->hapusDataProducts($id_produk);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('products');
    }

    public function detail($id_produk)
    {
        $data['judul'] = 'Detail Data';
        $data['products'] = $this->Products_model->getProductsById($id_produk);
        $this->load->view('templates/header', $data);
        $this->load->view('products/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id_produk)
    {
        $data['judul'] = 'Edit Data';
        $data['products'] = $this->Products_model->getProductsById($id_produk);
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
