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
        $this->simple_login->cek_akses();
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
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Produk Baru Ditambahkan!</div>');
            redirect('products/list');
        }
    }

    public function hapus($id_produk)
    {
        $this->Products_model->hapusDataProducts($id_produk);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Produk Dihapus!</div>');
        redirect('products/list');
    }

    public function detail($id_produk)
    {
        $data['judul'] = 'Detail Data';
        $data['products'] = $this->Products_model->getProductsById($id_produk);
        $this->load->view('templates/header', $data);
        $this->load->view('products/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id_produk)
    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['products'] = $this->db->get_where('products')->row_array();
        $data['judul'] = 'Edit User Profile';
        $data['nama'] = $nama;
        $data['products'] = $this->Products_model->getProductsById($id_produk);
        $data['id_produk'] = $id_produk;

        $this->form_validation->set_rules('nama_produk', 'Nama_produk', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('products/edit', $data);
            $this->load->view('templates/user_footer');
        } else {
            // cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['gambar']['name'];
            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/images/produk/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $old_gambar = $data['products']['gambar'];
                    if ($old_gambar != 'default.jpg') {
                        unlink(FCPATH . 'assets/images/produk/' . $old_gambar);
                    }
                    $new_gambar = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_gambar);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama_produk', $this->input->post('nama_produk'));
            $this->db->set('harga', $this->input->post('harga'));
            $this->db->set('stok', $this->input->post('stok'));
            $this->db->set('keterangan', $this->input->post('keterangan'));
            $this->db->set('kategori', $this->input->post('kategori'));
            $this->db->where('id_produk', $id_produk);
            $this->db->update('products');
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Your product has been updated!</div>');
            redirect('products/list');
        }
    }
}
