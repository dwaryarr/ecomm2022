<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Daftarproduk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products/Products_model');
        $this->simple_login->cek_login();
    }
    public function index()
    {
        $nama = $this->session->userdata('name');
        $data['nama'] = $nama;
        $data['judul'] = 'Daftar Produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['products'] = $this->Products_model->getAllProducts();
        // Pagination
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/ecomm2022/DartGameCorner/member/daftarproduk/index/';
        $config['total_rows'] = $this->Products_model->getTotalProducts();
        $config['per_page'] = 10;
        $config['num_links'] = 2;

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $data['products'] = $this->Products_model->getListProducts($config['per_page'], $data['start']);

        //Search
        if ($this->input->post('keyword')) {
            $data['products'] = $this->Products_model->cariDataProducts();
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
            //$this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        if ($this->input->post('keyword')) {
            $data['products'] = $this->Products_model->cariDataProducts();
        }
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('member/daftarproduk', $data);
        $this->load->view('templates/user_footer');
    }
    public function addcart($id_produk)
    {
        $products = $this->Products_model->find($id_produk);
        $data = array(
            'id'      => $products->id_produk,
            'qty'     => 1,
            'price'   => $products->harga,
            'name'    => $products->nama_produk,
        );
        $this->cart->insert($data);
        redirect('member/daftarproduk');
    }
}
