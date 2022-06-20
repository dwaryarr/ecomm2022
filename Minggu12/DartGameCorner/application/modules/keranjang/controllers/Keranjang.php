<?php
if (!defined('BASEPATH')) exit('No direct script access
allowed');
class Keranjang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-pqKzwJ7sEfs-cOY_4eRreq-B', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url');
        $this->load->library('cart');
        $this->load->model('keranjang_model');
        $this->load->model('products/Products_model');
        $this->simple_login->cek_login();
        // $this->simple_login->cek_akses();
    }
    public function index()
    {
        $nama = $this->session->userdata('name');
        $data['email'] = $this->session->userdata('email');
        $data['nama'] = $nama;
        $data['judul'] = 'Daftar Belanja';
        $data['order'] = $this->keranjang_model->getMaxIdOrder();
        $data['products'] = $this->Products_model->getAllProducts();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->keranjang_model->get_kategori_all();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/user_footer');
    }
    public function check_out()
    {
        $data['cart'] = $this->cart->contents();
        $data['email'] = $this->session->userdata('email');
        $data['judul'] = 'Check Out';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->keranjang_model->get_kategori_all();
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telp/No HP', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('checkout', $data);
            $this->load->view('templates/user_footer');
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Check-out Berhasil!</div>');
            redirect('keranjang/proses_order');
        }
    }
    public function tambah($id_produk)
    {
        $products = $this->Products_model->find($id_produk);
        $data = array(
            'id'      => $products->id_produk,
            'qty'     => 1,
            'price'   => $products->harga,
            'name'    => $products->nama_produk,
            'gambar' => $products->gambar,
        );
        $this->cart->insert($data);
        redirect('keranjang');
    }
    function hapus($rowid)
    {
        if ($rowid == "all") {
            $this->cart->destroy();
        } else {
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Hapus Cart Berhasil!</div>');
        redirect('keranjang');
    }
    function ubah_cart()
    {
        $cart_info = $_POST['cart'];
        foreach ($cart_info as $id_produk => $cart) {
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $gambar = $cart['gambar'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];
            $data = array(
                'rowid' => $rowid,
                'price' => $price,
                'gambar' => $gambar,
                'amount' => $amount,
                'qty' => $qty
            );
            $this->cart->update($data);
        }
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Update Cart Berhasil!</div>');
        redirect('keranjang');
    }
}
