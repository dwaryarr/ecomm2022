<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blocked extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    //Load Halaman dashboard
    public function index()
    {
        $data['title'] = "404 Error";
        $this->load->view('templates/auth_header', $data);
        $this->load->view('account/vblocked');
        $this->load->view('templates/auth_footer');
    }
}
