<?php
if (!defined('BASEPATH')) exit('No direct script access
allowed');
class Shopping extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('keranjang_model');
        $this->load->model('products/Products_model');
        $this->simple_login->cek_login();
        // $this->simple_login->cek_akses();
    }
    public function index()
    {
        $kategori = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['produk'] = $this->keranjang_model->get_produk_kategori($kategori);
        $data['kategori'] = $this->keranjang_model->get_kategori_all();
        $this->load->view('themes/header', $data);
        $this->load->view('shopping/list_produk', $data);
        $this->load->view('themes/footer');
    }
    public function tampil_cart()
    {
        $nama = $this->session->userdata('name');
        $data['nama'] = $nama;
        $data['judul'] = 'Daftar Belanja';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->keranjang_model->get_kategori_all();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('keranjang/shopping/tampil', $data);
        $this->load->view('templates/user_footer');
    }
    public function check_out()
    {
        $nama = $this->session->userdata('name');
        $data['nama'] = $nama;
        $data['judul'] = 'Check Out';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->keranjang_model->get_kategori_all();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('keranjang/shopping/checkout', $data);
        $this->load->view('templates/user_footer');
    }
    public function detail_produk()
    {
        $id_produk = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['kategori'] = $this->keranjang_model->get_kategori_all();
        $data['detail'] = $this->keranjang_model->get_produk_id($id_produk)->row_array();
        $this->load->view('themes/header', $data);
        $this->load->view('shopping/detail_produk', $data);
        $this->load->view('themes/footer');
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
        redirect('keranjang/shopping/tampil_cart');
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
        redirect('keranjang/shopping/tampil_cart');
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
        redirect('keranjang/shopping/tampil_cart');
    }
    public function proses_order()
    {
        //-------------------------Input data pelanggan--------------------------
        $data_pelanggan = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp')
        );
        $id_pelanggan = $this->keranjang_model->tambah_pelanggan($data_pelanggan);
        //-------------------------Input data order------------------------------
        $data_order = array('tanggal' => date('Y-m-d'), 'pelanggan' => $id_pelanggan);
        $id_order = $this->keranjang_model->tambah_order($data_order);
        //-------------------------Input data detail order-----------------------
        if ($cart = $this->cart->contents()) {
            foreach ($cart as $item) {
                $data_detail = array(
                    'order_id' => $id_order,
                    'produk' => $item['id_produk'],
                    'qty' => $item['qty'],
                    'harga' =>
                    $item['price']
                );
                $proses = $this->keranjang_model->tambah_detail_order($data_detail);
            }
        }
        //-------------------------Hapus shopping cart--------------------------
        $this->cart->destroy();
        $data['kategori'] = $this->keranjang_model->get_kategori_all();
        $nama = $this->session->userdata('name');
        $data['nama'] = $nama;
        $data['judul'] = 'Tampil Cart';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('keranjang/shopping/sukses', $data);
        $this->load->view('templates/user_footer');
    }
}
