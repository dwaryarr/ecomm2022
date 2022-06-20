<?php

class Products_model extends CI_model
{
    public function getAllProducts()
    {
        return $this->db->get('products')->result_array();
    }

    public function getListProducts($limit, $start)
    {
        return $this->db->get('products', $limit, $start)->result_array();
    }

    public function getTotalProducts()
    {
        return $this->db->get('products')->num_rows();
    }

    public function getAllKategori()
    {
        return $this->db->get('kategori')->result_array();
    }

    public function getAllTambahStok()
    {
        $this->db->select('*');
        $this->db->from('tambah_stok');
        $this->db->join('products', 'products.id_produk = tambah_stok.id_produk');
        return $this->db->get()->result();
    }

    public function tambahDataProducts()
    {
        $nama_produk = $this->input->post('nama_produk', true);
        $harga = $this->input->post('harga', true);
        $stok = $this->input->post('stok', true);
        $keterangan = $this->input->post('keterangan', true);
        $kategori = $this->input->post('kategori', true);
        $gambar = $_FILES['gambar'];
        if ($gambar = '') {
        } else {
            $config['upload_path'] = './assets/images/produk/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                echo "Upload Gambar Gagal";
                die;
                // $error = array('error' => $this->upload->display_errors());
                // $this->load->view('products/tambah', $error);
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }

        $data = array(
            'nama_produk' => $nama_produk,
            'gambar' => $gambar,
            'harga' => $harga,
            'stok' => $stok,
            'keterangan' => $keterangan,
            'kategori' => $kategori
        );

        $this->db->insert('products', $data);
    }

    public function tambahDataKategori()
    {
        $nama_kategori = $this->input->post('nama_kategori', true);
        $this->db->insert('kategori', ['nama_kategori' => $nama_kategori]);
    }

    public function tambahDataStok()
    {
        $id_produk = $this->input->post('id_produk', true);
        $stok = $this->input->post('stok', true);
        $data = array(
            'id_produk' => $id_produk,
            'stok' => $stok
        );
        $this->db->insert('tambah_stok', $data);
    }

    public function hapusDataProducts($id_produk)
    {
        $this->db->delete('products', ['id_produk' => $id_produk]);
    }

    public function getProductsById($id_produk)
    {
        return $this->db->get_where('products', ['id_produk' => $id_produk])->row_array();
    }

    public function hapusDataKategori($id_kategori)
    {
        $this->db->delete('kategori', ['id_kategori' => $id_kategori]);
    }

    public function getKategoriById($id_kategori)
    {
        return $this->db->get_where('kategori', ['id_kategori' => $id_kategori])->row_array();
    }

    public function getKategoriByName($nama_kategori)
    {
        return $this->db->get_where('kategori', ['nama_kategori' => $nama_kategori])->row_array();
    }

    public function getProductsByKategori($id_kategori)
    {
        $query = "SELECT `products`.*, `kategori`.`id_kategori` FROM `products`,`kategori` 
        WHERE `kategori`.`nama_kategori`=`products`.`kategori` AND `id_kategori`=$id_kategori;";
        return $this->db->query($query)->result_array();
    }

    public function cariDataProducts()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_produk', $keyword);
        $this->db->or_like('harga', $keyword);
        $this->db->or_like('keterangan', $keyword);
        $this->db->or_like('kategori', $keyword);
        return $this->db->get('products')->result_array();
    }

    public function getProducts($id_produk = null)
    {
        if ($id_produk === null) {
            return $this->db->get('products')->result_array();
        } else {
            return $this->db->get_where('products', ['id_produk' => $id_produk])->result_array();
        }
    }


    public function find($id_produk)
    {
        $result = $this->db->where('id_produk', $id_produk)->limit(1)->get('products');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function getRiwayatTRX()
    {
        $query = "SELECT o.id_order,pg.name,pg.email,pr.nama_produk,dot.stok AS qty,(dot.stok*dot.harga) 
        AS total,o.tgl_order FROM `order` o,pelanggan pg, products pr,detail_order dot 
        WHERE o.id_order=dot.id_order AND dot.id_produk=pr.id_produk AND o.id_pelanggan=pg.id_pelanggan 
        ORDER BY id_order;";
        return $this->db->query($query)->result_array();
    }

    public function getRiwayatTRXById($id_order)
    {
        // $id_order = $this->input->post('id_order', true);
        $query = "SELECT o.id_order,pg.name,pg.email,pr.nama_produk,dot.stok AS qty,(dot.stok*dot.harga) 
        AS total,o.tgl_order FROM `order` o,pelanggan pg, products pr,detail_order dot 
        WHERE o.id_order=dot.id_order AND dot.id_produk=pr.id_produk AND o.id_pelanggan=pg.id_pelanggan AND o.id_order='" . $id_order . "'";
        return $this->db->query($query)->row_array();
    }

    public function getRiwayatByEmail()
    {
        $email = $this->session->userdata('email');
        $query = "SELECT o.id_order,pr.nama_produk,dor.stok AS qty,(dor.stok*dor.harga) AS total_harga,o.tgl_order 
            FROM `order` o,products pr,detail_order dor,pelanggan pg WHERE o.id_order=dor.id_order AND dor.id_produk=pr.id_produk 
            AND o.id_pelanggan=pg.id_pelanggan AND pg.email='" . $email . "';";
        return $this->db->query($query)->result_array();
    }

    // public function getRiwayatById($id_order)
    // {
    //     $email = $this->session->userdata('email');
    //     //$id_order = $this->db->get_where('order', ['id_order' => $id_order])->row_array();
    //     $query = "SELECT o.id_order,pr.nama_produk,dor.stok AS qty,(dor.stok*dor.harga) AS total_harga,o.tgl_order 
    //         FROM `order` o,products pr,detail_order dor,pelanggan pg WHERE o.id_order=dor.id_order AND dor.id_produk=pr.id_produk 
    //         AND o.id_pelanggan=pg.id_pelanggan AND pg.email='" . $email . " AND o.id_order='" . $id_order . "';";
    //     return $this->db->query($query)->result_array();
    // }

}
