<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Edit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Edit Profile';
        $data['nama'] = $nama;

        $this->form_validation->set_rules('name', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('veditprofile', $data);
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
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user');
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Update Profile Berhasil!</div>');
            redirect('account/edit');
        }
    }

    public function changepassword()
    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Change Password';
        $data['nama'] = $nama;

        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newPassword1', 'New Password', 'required|trim|min_length[3]|matches[newPassword2]');
        $this->form_validation->set_rules('newPassword2', 'Confirm New Password', 'required|trim|min_length[3]|matches[newPassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('vchangepassword', $data);
            $this->load->view('templates/user_footer');
        } else {
            $current_password = md5($this->input->post('currentPassword'));
            $new_password = $this->input->post('newPassword1');
            if ($current_password != $data['user']['password']) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Wrong current password!</div>');
                redirect('account/edit/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            New password cannot be the same as current password!</div>');
                    redirect('account/edit/changepassword');
                } else {
                    //password ok
                    $password_hash = md5($new_password);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            Password changed!</div>');
                    redirect('account/edit/changepassword');
                }
            }
        }
    }
}
