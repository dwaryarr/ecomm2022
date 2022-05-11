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
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $data['products'] = $this->Products_model->getListProducts($config['per_page'], $data['start']);

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
