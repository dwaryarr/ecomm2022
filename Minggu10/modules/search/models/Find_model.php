<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Find_model extends CI_Model
{

    public function viewByNamaProduk($nama_produk)
    {
        $this->db->where('nama_produk', $nama_produk);
        $result = $this->db->get('products')->row(); // Tampilkan datasiswa berdasarkan NamaProduk

        return $result;
    }
}
