<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        // Fungsi Login
        $valid = $this->form_validation;
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $valid->set_rules('email', 'Email', 'required|valid_email|trim');
        $valid->set_rules('password', 'Password', 'required|trim');
        if ($valid->run()) {
            $this->simple_login->login($email, $password, base_url('account/dashboard'), base_url('account/login'));
        }
        $data['title'] = "Login";
        $this->load->view('account/templates/auth_header', $data);
        $this->load->view('account/vlogin');
        $this->load->view('account/templates/auth_footer');
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin/dashboard');
                    } else {
                        redirect('member/dashboard');
                    }
                    // redirect('account/dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('account/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diaktivasi!</div>');
                redirect('account/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div>');
            redirect('account/login');
        }
    }

    public function logout()
    {
        $this->simple_login->logout();
    }
}
