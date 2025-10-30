<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $table = 'cms_admin';

    public function get_all_users() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_user_by_username($username) {
        return $this->db->get_where($this->table, ['username' => $username])->row_array();
    }

    public function insert_user($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update_user($username, $data) {
        $this->db->where('username', $username);
        return $this->db->update($this->table, $data);
    }

    public function delete_user($username) {
        $this->db->where('username', $username);
        return $this->db->delete($this->table);
    }
}
