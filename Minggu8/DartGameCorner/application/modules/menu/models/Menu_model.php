<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    ";
        return $this->db->query($query)->result_array();
    }

    public function getProductsById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function deleteMenu($id)
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

    public function getListMenu($limit, $start)
    {
        return $this->db->get('user_menu', $limit, $start)->result_array();
    }

    public function getTotalMenu()
    {
        return $this->db->get('user_menu')->num_rows();
    }

    public function getListSubMenu($limit, $start)
    {
        return $this->db->get('user_sub_menu', $limit, $start)->result_array();
    }

    public function getTotalSubMenu()
    {
        return $this->db->get('user_sub_menu')->num_rows();
    }
}
