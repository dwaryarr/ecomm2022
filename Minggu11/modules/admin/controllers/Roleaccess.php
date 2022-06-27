<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Roleaccess extends CI_Controller
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
        //pagination
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost:8073/ecomm2022/DartGameCorner/admin/roleaccess/index/';
        $config['total_rows'] = $this->Role_model->getTotalRole();
        $config['per_page'] = 10;
        $config['num_links'] = 2;

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
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Role Baru Berhasil Ditambahkan!</div>');
            redirect('admin/roleaccess');
        }
    }

    public function editRole($id)
    {
        $data['role'] = $this->Role_model->getRoleById($id);
        $data['id'] = $id;
        $this->db->set('role', $this->input->post('role'));
        $this->db->where('id', $id);
        $this->db->update('user_role');
        redirect('admin/roleaccess');
    }

    public function deleteRole($id)
    {
        $this->Role_model->deleteRole($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Role Terhapus!</div>');
        redirect('admin/roleaccess');
    }

    public function roleaccessmenu($id)
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
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Update Akses Berhasil!</div>');
    }
}
