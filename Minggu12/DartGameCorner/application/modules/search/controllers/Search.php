<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Find_model');
    }
    public function index()
    {
        $this->load->view('form');
    }
    public function search()
    {
        // Ambil data NIS yang dikirim via ajax post
        $nama_produk = $this->input->post('nama_produk');
        $products = $this->SiswaModel->viewByNamaProduk($nama_produk);
        if (!empty($products)) { // Jika data products ada/ditemukan
            // Buat sebuah array
            $callback = array(
                'status' => 'success', // Set array status dengan success
                'nama' => $products->nama, // Set array nama dengan isi kolom nama pada tabel products
                'jenis_kelamin' => $products->jenis_kelamin, // Set array jenis_kelamin dengan isi kolom jenis_kelamin pada tabel products
                'telepon' => $products->telp, // Set array jenis_kelamin dengan isi kolom telp pada tabel products
                'kota' => $products->kota, // Set array jenis_kelamin dengan isi kolom kota pada tabel siswa
            );
        } else {
            $callback = array('status' => 'failed'); // set array status dengan failed
        }
        echo json_encode($callback); // konversi varibael $callbackmenjadi JSON
    }
}
