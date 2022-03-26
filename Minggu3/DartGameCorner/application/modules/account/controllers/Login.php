<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Login";
        $this->load->view('templates/auth_header', $data);
        $this->load->view('account/vlogin');
        $this->load->view('templates/auth_footer');
        // Fungsi Login
        $valid = $this->form_validation;
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $valid->set_rules('email', 'Email', 'required|valid_email|trim');
        $valid->set_rules('password', 'Password', 'required|trim');
        if ($valid->run()) {
            $this->simple_login->login($email, $password, base_url('account/dashboard'), base_url('account/login'));
        }
    }

    public function logout()
    {
        $this->simple_login->logout();
    }
}
