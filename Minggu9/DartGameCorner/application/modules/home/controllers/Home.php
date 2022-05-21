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
        // $data['products'] = $this->Products_model->getAllProducts();
        // Pagination
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/ecomm2022/DartGameCorner/home/index/';
        $config['total_rows'] = $this->Products_model->getTotalProducts();
        $config['per_page'] = 12;
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
        $data['start'] = $this->uri->segment(3);
        $data['products'] = $this->Products_model->getListProducts($config['per_page'], $data['start']);

        if ($this->input->post('keyword')) {
            $data['products'] = $this->Products_model->cariDataProducts();
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

    public function about()
    {
        $data['judul'] = 'About';
        $this->load->view('templates/header', $data);
        $this->load->view('about', $data);
        $this->load->view('templates/footer');
    }
}
