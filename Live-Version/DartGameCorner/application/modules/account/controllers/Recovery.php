<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recovery extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login();
    }
    //Load Halaman dashboard
    public function index()
    {
        $data['title'] = "Login";
        $this->load->view('account/templates/auth_header', $data);
        $this->load->view('account/vrecovery');
        $this->load->view('account/templates/auth_footer');
    }
}
