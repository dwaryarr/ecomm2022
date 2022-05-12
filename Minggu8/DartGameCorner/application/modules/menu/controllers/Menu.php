<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu/Menu_model');
        $this->simple_login->cek_login();
        $this->simple_login->cek_akses();
    }

    public function index()
    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Menu Management';
        $data['nama'] = $nama;

        // $data['menu'] = $this->db->get('user_menu')->result_array();
        //pagination
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/ecomm2022/DartGameCorner/menu/index/';
        $config['total_rows'] = $this->Menu_model->getTotalMenu();
        $config['per_page'] = 10;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['menu'] = $this->Menu_model->getListMenu($config['per_page'], $data['start']);

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar');
            $this->load->view('index', $data);
            $this->load->view('templates/user_footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'SubMenu Management';
        $data['nama'] = $nama;
        $this->load->model('Menu_model', 'menu');

        // $data['subMenu'] = $this->menu->getSubMenu();
        //pagination
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/ecomm2022/DartGameCorner/menu/submenu/index/';
        $config['total_rows'] = $this->Menu_model->getTotalSubMenu();
        $config['per_page'] = 10;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['submenu'] = $this->Menu_model->getListSubMenu($config['per_page'], $data['start']);

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar');
            $this->load->view('submenu', $data);
            $this->load->view('templates/user_footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">New SubMenu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function editMenu($id)
    {
        $this->db->set('menu', $this->input->post('menu'));
        $this->db->where('id', $id);
        $this->db->update('user_menu');
    }

    public function editSubMenu($id)
    {
        $data['products'] = $this->Menu_model->getSubMenuById($id);
        $data['id'] = $id;
        $this->db->set('menu_id', $this->input->post('menu_id'));
        $this->db->set('title', $this->input->post('title'));
        $this->db->set('url', $this->input->post('url'));
        $this->db->set('icon', $this->input->post('icon'));
        $this->db->set('is_active', $this->input->post('is_active'));
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu');
    }

    public function deleteMenu($id)
    {
        $this->load->model('Menu_model', 'menu');
        $this->menu->deleteMenu($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Menu deleted!</div>');
        redirect('menu');
    }

    public function deleteSubMenu($id)
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">SubMenu deleted!</div>');
        redirect('menu/submenu');
    }
}
