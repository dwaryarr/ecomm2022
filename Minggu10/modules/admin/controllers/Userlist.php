<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userlist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('account/User_model');
        $this->simple_login->cek_login();
        $this->simple_login->cek_akses();
    }

    public function index()

    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'User List';
        $data['name'] = $nama;

        // Pagination
        $this->load->library('pagination');
        $config['total_rows'] = $this->User_model->getTotalUsers();
        $config['per_page'] = 10;

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $data['userlist'] = $this->User_model->getListUsers($config['per_page'], $data['start']);

        if ($this->input->post('keyword')) {
            $data['userlist'] = $this->User_model->cariDataUser();
        }
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('admin/vuserlist', $data);
        $this->load->view('templates/user_footer');
    }

    public function edit($id)
    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Edit User Profile';
        $data['nama'] = $nama;
        $data['user'] = $this->User_model->getUserById($id);
        $data['id'] = $id;

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('admin/vedituserprofile', $data);
            $this->load->view('templates/user_footer');
        } else {
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/images/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/images/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $this->input->post('name'));
            $this->db->where('id', $id);
            $this->db->update('user');
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Your profile has been updated!</div>');
            redirect('admin/userlist');
        }
    }

    public function hapus($id_produk)
    {
        $this->User_model->hapusDataUser($id_produk);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Produk Dihapus!</div>');
        redirect('admin/userlist');
    }
}
