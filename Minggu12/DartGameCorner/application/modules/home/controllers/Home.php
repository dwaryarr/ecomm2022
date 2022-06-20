<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products/Products_model');
        $this->load->model('keranjang/Keranjang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Home';
        $data['nama'] = 'Mesdames and Messieurs';
        $data['kategori'] = $this->Products_model->getAllKategori();
        // Pagination
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost:8073/ecomm2022/DartGameCorner/home/index/';
        $config['total_rows'] = $this->Products_model->getTotalProducts();
        $config['per_page'] = 16;
        $config['num_links'] = 2;

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['products'] = $this->Products_model->getListProducts($config['per_page'], $data['start']);

        //Search
        if ($this->input->post('keyword')) {
            $data['products'] = $this->Products_model->cariDataProducts();
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id_produk)
    {
        $data['judul'] = 'Detail Produk';
        $data['nama'] = 'Detail Produk';
        $data['order'] = $this->Keranjang_model->getMaxIdOrder();
        $data['products'] = $this->Products_model->getAllProducts();
        $data['kategori'] = $this->Products_model->getAllKategori();
        $data['products'] = $this->Products_model->getProductsById($id_produk);
        $data['id_produk'] = $id_produk;
        $this->load->view('templates/header', $data);
        $this->load->view('home/detail_produk', $data);
        $this->load->view('templates/footer');
    }

    public function kategori($id_kategori)
    {
        $id_kategori = $this->uri->segment(3);
        $data['judul'] = 'Kategori';
        $data['judulh2'] = $this->db->get_where('kategori', ['id_kategori' => $this->uri->segment(3)])->row_array();
        $data['kategori'] = $this->Products_model->getAllKategori();
        $data['products'] = $this->Products_model->getProductsByKategori($id_kategori);
        $this->load->view('templates/header', $data);
        $this->load->view('kategori', $data);
        $this->load->view('templates/footer');
    }

    public function about()
    {
        $data['judul'] = 'About';
        $data['nama'] = 'About';
        $data['kategori'] = $this->Products_model->getAllKategori();
        $this->load->view('templates/header', $data);
        $this->load->view('about', $data);
        $this->load->view('templates/footer');
    }

    public function cekorder()
    {
        $data['judul'] = 'Cek Status Order';
        $data['nama'] = 'Cek Status Order';
        $data['kategori'] = $this->Products_model->getAllKategori();
        $data['payment'] = $this->Keranjang_model->getAllPayment();
        $this->load->view('templates/header', $data);
        $this->load->view('cekorder', $data);
        $this->load->view('templates/footer');
    }
}
