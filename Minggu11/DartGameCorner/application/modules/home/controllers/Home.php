<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products/Products_model');
        $this->load->library('form_validation');
    }

    public function index($nama = 'Mesdames and Messieurs')
    {
        $data['judul'] = 'Home';
        $data['nama'] = $nama;
        $data['kategori'] = $this->Products_model->getAllKategori();
        // Pagination
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/ecomm2022/DartGameCorner/home/index/';
        $config['total_rows'] = $this->Products_model->getTotalProducts();
        $config['per_page'] = 12;
        $config['num_links'] = 2;

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['products'] = $this->Products_model->getListProducts($config['per_page'], $data['start']);

        //Search
        if ($this->input->post('keyword')) {
            $data['products'] = $this->Products_model->cariDataProducts();
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
            //$this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id_produk)
    {
        $data['judul'] = 'Detail Produk';
        $data['products'] = $this->Products_model->getAllProducts();
        $data['products'] = $this->Products_model->getProductsById($id_produk);
        $data['id_produk'] = $id_produk;
        $this->load->view('templates/header', $data);
        $this->load->view('detail_produk', $data);
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
        $this->load->view('templates/header', $data);
        $this->load->view('about', $data);
        $this->load->view('templates/footer');
    }
}
