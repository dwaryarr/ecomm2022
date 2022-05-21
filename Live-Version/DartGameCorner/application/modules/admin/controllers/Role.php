<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Role_model');
        $this->simple_login->cek_login();
        $this->simple_login->cek_akses();
    }

    public function index()
    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Role';
        $data['nama'] = $nama;

        // $data['role'] = $this->db->get('user_role')->result_array();
        //pagination
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/ecomm2022/DartGameCorner/admin/role/index/';
        $config['total_rows'] = $this->Role_model->getTotalRole();
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
        $data['role'] = $this->Role_model->getListRole($config['per_page'], $data['start']);
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar');
            $this->load->view('admin/vrole', $data);
            $this->load->view('templates/user_footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">New Role added!</div>');
            redirect('admin/role');
        }
    }

    public function editRole($id)
    {
        $data['role'] = $this->Role_model->getRoleById($id);
        $data['id'] = $id;
        $this->db->set('role', $this->input->post('role'));
        $this->db->where('id', $id);
        $this->db->update('user_role');
        redirect('admin/role');
    }

    public function deleteRole($id)
    {
        $this->Role_model->deleteRole($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Role deleted!</div>');
        redirect('admin/role');
    }

    public function roleaccess($id)
    {
        $nama = $this->session->userdata('name');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Role Management';
        $data['nama'] = $nama;
        $data['role'] = $this->db->get_where('user_role', ['id' => $id])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('admin/vroleaccess', $data);
        $this->load->view('templates/user_footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }
}
