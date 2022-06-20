<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-pqKzwJ7sEfs-cOY_4eRreq-B', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('keranjang/Keranjang_model');
	}

	public function index()
	{
		$data['kategori'] = $this->Keranjang_model->get_kategori_all();
		$email = $this->session->userdata('email');
		$data['email'] = $email;
		$data['judul'] = 'Tampil Cart';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
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
		}
	}

	public function proses_order()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('kota', 'Kota', 'required|trim');
		$this->form_validation->set_rules('telp', 'Telp/No HP', 'required|trim');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Transaksi Gagal!</div>');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			//-------------------------Input data pelanggan--------------------------
			$data_pelanggan = array(
				'role' => $this->input->post('role'),
				'name' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'kota' => $this->input->post('kota'),
				'telp' => $this->input->post('telp'),
				'keterangan' => $this->input->post('keterangan')
			);
			$id_pelanggan = $this->Keranjang_model->tambah_pelanggan($data_pelanggan);
			//-------------------------Input data order------------------------------
			$data_order = array('tgl_order' => date('Y-m-d H:i:s'), 'id_pelanggan' => $id_pelanggan);
			$id_order = $this->Keranjang_model->tambah_order($data_order);
			//-------------------------Input data detail order-----------------------
			$id_produk = $this->input->post('id_produk');
			$stok = '1';
			$harga = $this->input->post('total_bayar');

			if ($cart = $this->cart->contents()) {
				foreach ($cart as $item) {
					$data_detail = array(
						'id_order' => $id_order,
						'id_produk' => $item['id'],
						'stok' => $stok,
						'harga' => $harga
					);
					$this->Keranjang_model->tambah_detail_order($data_detail);
				}
			}
			// redirect('home');
			$result = json_decode($this->input->post('result_data'), true);
			// echo 'RESULT <br><pre>';
			// var_dump($result);
			// echo '</pre>';
			$data = [
				'id_order' => $this->input->post('id_order'),
				'id_transaksi' => $result['order_id'],
				'gross_amount' => $result['gross_amount'],
				'payment_type' => $result['payment_type'],
				'transaction_time' => $result['transaction_time'],
				'bank' => $result['va_numbers'][0]["bank"],
				'va_number' => $result['va_numbers'][0]["va_number"],
				'pdf_url' => $result['pdf_url'],
				'status_code' => $result['status_code']
			];
			$simpan = $this->db->insert('payment', $data);
			if ($simpan) {
				$this->cart->destroy();
				$this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Transaksi Berhasil! Pesanan akan segera diproses.</div>');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Transaksi Gagal!</div>');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function token()
	{
		$id_order = $this->input->post('id_order');
		$id_produk = $this->input->post('id_produk');
		$produk = $this->input->post('produk');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telp = $this->input->post('telp');
		$kota = $this->input->post('kota');
		$keterangan = $this->input->post('keterangan');
		$total_bayar = $this->input->post('total_bayar');

		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $total_bayar, // no decimal allowed for creditcard
		);

		$cart = $this->cart->contents();
		foreach ($cart as $item) {
			$items[] = array(
				'id' => $item['id'],
				'price' => $item['price'],
				'quantity' => $item['qty'],
				'name' => $item['name']
			);
		}

		// // Optional
		// $item1_details = array(
		// 	'id' => $id_produk,
		// 	'price' => $total_bayar,
		// 	'quantity' => 1,
		// 	'name' => $produk
		// );

		// // Optional
		// $item2_details = array(
		// 	'id' => 'a2',
		// 	'price' => 20000,
		// 	'quantity' => 2,
		// 	'name' => "Orange"
		// );

		$item_details = array($items);

		$customer_details = array(
			'first_name'    => $nama,
			'last_name'     => "",
			'email'         => $email,
			'phone'         => $telp
			// 'billing_address'  => $kota,
			// 'shipping_address' => $kota
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'hour',
			'duration'  => 1
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}
}
