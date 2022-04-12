<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
* Simple_login Class
* Class ini digunakan untuk fitur login, proteksi halaman dan logout
*/
class Simple_login
{
    // SET SUPER GLOBAL
    var $CI = NULL;
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->CI = &get_instance();
    }
    /*cek email dan password pada table user, jika ada set
session berdasar data user daritable user.
* @param string email dari input form
* @param string password dari input form*/
    public function login($email, $password)
    {
        //cek email dan password
        $query = $this->CI->db->get_where('user', array('email' => $email, 'password' => md5($password)));
        // setup role_id admin & member
        $user = $this->CI->db->get_where('user', ['email' => $email])->row_array();
        if ($query->num_rows() == 1) {
            //ambil data user berdasar email
            $row = $this->CI->db->query('SELECT id FROM user where email = "' . $email . '"');
            $admin = $row->row();
            $id = $admin->id;
            //set session user
            $this->CI->session->set_userdata(
                'email',
                $email
            );
            $this->CI->session->set_userdata(
                'role_id',
                $user['role_id']
            );
            $this->CI->session->set_userdata(
                'id_login',
                uniqid(rand())
            );
            $this->CI->session->set_userdata('id', $id);
            //redirect ke halaman dashboard + validasi admin & member
            if ($user['role_id'] == 1) {
                redirect('admin/dashboard');
            } else {
                redirect('member/dashboard');
            }
            // redirect(site_url('account/dashboard'));
        } else {
            //jika tidak ada, set notifikasi dalam flashdata.
            $this->CI->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Email atau Password salah, Silakan coba lagi..! </div>');
            //redirect ke halaman login
            redirect(site_url('account/login'));
        }
        return false;
    }
    /**
     * Cek session login, jika tidak ada, set notifikasi dalam flashdata, lalu dialihkan ke halaman
     * login
     */
    public function cek_login()
    {
        //cek session email
        if ($this->CI->session->userdata('email') == '') {
            //set notifikasi
            $this->CI->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Anda belum login!</div>');
            //alihkan ke halaman login
            redirect(site_url('account/login'));
        }
    }
    /**
     * Hapus session, lalu set notifikasi kemudian di alihkan
     * ke halaman login
     */
    public function logout()
    {
        $this->CI->session->unset_userdata('email');
        $this->CI->session->unset_userdata('id_login');
        $this->CI->session->unset_userdata('id');
        $this->CI->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Anda berhasil logout</div>');
        redirect(site_url('account/login'));
    }

    public function cek_akses()
    {
        //cek session email
        if ($this->CI->session->userdata('email') == '') {
            //set notifikasi
            $this->CI->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Anda belum login!</div>');
            //alihkan ke halaman login
            redirect(site_url('account/login'));
        } else {
            $role_id = $this->CI->session->userdata('role_id');
            $menu = $this->CI->uri->segment(1);

            $queryMenu = $this->CI->db->get_where('user_menu', ['menu' => $menu])->row_array();
            $menu_id = $queryMenu['id'];

            $userAccess = $this->CI->db->get_where('user_access_menu', [
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ]);

            if ($userAccess->num_rows() < 1) {
                redirect('account/blocked');
            }
        }
    }
}
