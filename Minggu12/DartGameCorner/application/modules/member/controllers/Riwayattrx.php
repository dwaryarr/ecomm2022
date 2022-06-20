<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayattrx extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products/Products_model');
        $this->load->helper(array('form', 'url'));
        $this->simple_login->cek_login();
    }

    public function index()
    {
        $nama = $this->session->userdata('name');
        $data['nama'] = $nama;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Riwayat Transaksi';
        $data['products'] = $this->Products_model->getAllProducts();
        $data['riwayat'] = $this->Products_model->getRiwayatByEmail();
        //$data['transaksi'] = $this->Products_model->getRiwayatTRXById($id_order);
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('riwayat_transaksi', $data);
        $this->load->view('templates/user_footer');
    }
}
