<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{

    public function getAllRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function getRoleById($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->row_array();
    }

    public function deleteRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
    }


    public function getListRole($limit, $start)
    {
        return $this->db->get('user_role', $limit, $start)->result_array();
    }

    public function getTotalRole()
    {
        return $this->db->get('user_role')->num_rows();
    }
}
