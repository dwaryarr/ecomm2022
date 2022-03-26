<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Register extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper(array('url', 'form'));
        // $this->load->model('Registration_model'); //call model
    }
    public function index()
    {
        // rules form
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Registration";
            $this->load->view('account/templates/auth_header', $data);
            $this->load->view('account/vregister');
            $this->load->view('account/templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => md5($this->input->post('password1')),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $pesan['message'] = "Pendaftaran berhasil";
            $this->load->view('account/vsuccess', $pesan);
            #insertdata
            $this->db->insert('user', $data);
            redirect('account/login');
        }
    }
}
