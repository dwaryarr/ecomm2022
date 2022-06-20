<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recovery extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Fitur dinonaktifkan untuk sementara waktu!</div></div>');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Recovery Password";
            $this->load->view('account/templates/auth_header', $data);
            $this->load->view('account/vrecovery');
            $this->load->view('account/templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            // $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Fitur dinonaktifkan untuk sementara waktu!</div></div>');
            // redirect('account/login');
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                //     $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Please check your email to recovery your password!</div>');
                //     redirect('account/login');
                // } else {
                //     $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
                //     redirect('account/recovery');
            }
        }
    }
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'dartgamecorner@gmail.com',
            'smtp_pass' => 'ngzjqzxkgzgimerd',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('dartgamecorner@gmail.com', 'DartGameCorner');
        $this->email->to($this->input->post('email'));
        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'account/register/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Recovery Password');
            $this->email->message('Click this link to recovery your password : <a href="' . base_url() . 'account/recovery/verifytoken?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Recovery Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
        }
    }

    public function verifytoken()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->resetPassword();
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('account/recovery');
            }
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('account/recovery');
        }
    }

    public function resetPassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('account/login');
        } else {


            $this->form_validation->set_rules('newpassword1', 'Password', 'required|trim|min_length[3]|matches[newpassword2]');
            $this->form_validation->set_rules('newpassword2', 'Repeat Password', 'required|trim|min_length[3]|matches[newpassword1]');
            if ($this->form_validation->run() == false) {
                $data['title'] = "Reset Password";
                $this->load->view('account/templates/auth_header', $data);
                $this->load->view('account/vresetpassword');
                $this->load->view('account/templates/auth_footer');
            } else {
                $password = md5($this->input->post('newpassword1'));
                $email = $this->session->userdata('reset_email');
                $this->db->set('password', $password);
                $this->db->where('email', $email);
                $this->db->update('user');
                $this->db->delete('user_token', ['email' => $email]);
                $this->session->unset_userdata('reset_email');
                $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
                redirect('account/login');
            }
        }
    }
}
