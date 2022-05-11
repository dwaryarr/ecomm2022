<?php

class User_model extends CI_model
{
    public function getAllUser()
    {
        return $this->db->get('user')->result_array();
    }

    public function tambahDataUser()
    {
        $name = $this->input->post('name', true);
        $email = $this->input->post('email', true);
        $role_id = $this->input->post('role_id', true);
        $is_active = $this->input->post('is_active', true);
        $date_created = $this->input->post('date_created', true);
        $image = $_FILES['image'];
        if ($image = '') {
        } else {
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                echo "Upload Gambar Gagal";
                die;
            } else {
                $image = $this->upload->data('file_name');
            }
        }

        $data = array(
            'name' => $name,
            'image' => $image,
            'email' => $email,
            'role_id' => $role_id,
            'is_active' => $is_active,
            'date_created' => $date_created
        );

        $this->db->insert('user', $data);
    }

    public function hapusDataUser($id)
    {
        $this->db->delete('user', ['id' => $id]);
    }

    public function getUserById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function cariDataUser()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('name', $keyword);
        //$this->db->or_like('genre', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('role_id', $keyword);
        return $this->db->get('user')->result_array();
    }

    public function getUser($id = null)
    {
        if ($id === null) {
            return $this->db->get('user')->result_array();
        } else {
            return $this->db->get_where('user', ['id' => $id])->result_array();
        }
    }

    public function getListUsers($limit, $start)
    {
        return $this->db->get('user', $limit, $start)->result_array();
    }

    public function getTotalUsers()
    {
        return $this->db->get('user')->num_rows();
    }
}
