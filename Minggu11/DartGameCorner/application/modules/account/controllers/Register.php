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
                'image' => 'default.png',
                'password' => md5($this->input->post('password1')),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];
            $this->load->view('account/vsuccess');
            //token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $this->input->post('email'),
                'token' => $token,
                'date_created' => time()
            ];

            #insertdata
            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please active your account!</div>');
            redirect('account/login');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'dartgamecorner@gmail.com',
            'smtp_pass' => 'dartgc123',
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
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'account/recovery?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Recovery Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
                    redirect('account/login');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                    redirect('account/login');
                }
            } else {
                $this->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
                redirect('account/login');
            }
        } else {
            $this->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
            redirect('account/login');
        }
    }
}
