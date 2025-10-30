<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load model dan session (safe)
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        // isi $data['curr'] biar header.php tidak error
        if (isset($_SESSION['username'])) {
            $data['curr'] = $this->db->get_where('cms_admin', ['username' => $_SESSION['username']])->row_array();
        } else {
            $data['curr'] = ['name' => 'Administrator'];
        }

        $data['title'] = 'User Management';
        $data['menu'] = 5;

        // ambil semua user sesuai struktur DB kamu
        $data['users'] = $this->User_model->get_all_users();

        $this->load->view('header', $data);
        $this->load->view('user', $data);   // application/views/user.php
        $this->load->view('footer', $data);
    }

    // public function add() {
    //     if ($this->input->server('REQUEST_METHOD') === 'POST') {
    //         $username = trim($this->input->post('username'));
    //         $password = $this->input->post('password');
    //         $name     = $this->input->post('name');
    //         $email    = $this->input->post('email');
    //         $priv     = $this->input->post('priviledge');

    //         if (empty($username) || empty($password) || empty($name)) {
    //             $_SESSION['flash_error'] = 'Username, password dan nama wajib diisi.';
    //             redirect('user');
    //         }

    //         $data = [
    //             'username'   => $username,
    //             'password'   => password_hash($password, PASSWORD_DEFAULT),
    //             'name'       => $name,
    //             'email'      => $email,
    //             'token'      => '',
    //             'priviledge' => intval($priv)
    //         ];

    //         $this->User_model->insert_user($data);
    //         $_SESSION['flash_success'] = 'User berhasil ditambahkan.';
    //         redirect('user');
    //     }

    //     // fallback (jika diakses langsung)
    //     redirect('user');
    // }

    public function add() {
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $username = trim($this->input->post('username'));
        $password = $this->input->post('password');
        $name     = $this->input->post('name');
        $email    = $this->input->post('email');

        if (empty($username) || empty($password) || empty($name)) {
            $_SESSION['flash_error'] = 'Username, password dan nama wajib diisi.';
            redirect('user/add');
        }

        $data = [
            'username'   => $username,
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'name'       => $name,
            'email'      => $email,
            'token'      => '',
            'priviledge' => 1 // langsung admin seperti permintaanmu
        ];

        $this->User_model->insert_user($data);
        $_SESSION['flash_success'] = 'User berhasil ditambahkan.';
        redirect('user');
    }

    // tampil form tambah user
    if (isset($_SESSION['username'])) {
        $data['curr'] = $this->db->get_where('cms_admin', ['username' => $_SESSION['username']])->row_array();
    } else {
        $data['curr'] = ['name' => 'Administrator'];
    }

    $data['title'] = 'Tambah User';
    $this->load->view('header', $data);
    $this->load->view('user_add', $data);
    $this->load->view('footer', $data);
}


    public function edit($username = null) {
        if (!$username) redirect('user');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $name  = $this->input->post('name');
            $email = $this->input->post('email');
            $priv  = intval($this->input->post('priviledge'));

            $update = [
                'name' => $name,
                'email'=> $email,
                'priviledge' => $priv
            ];

            $pwd = $this->input->post('password');
            if (!empty($pwd)) {
                $update['password'] = password_hash($pwd, PASSWORD_DEFAULT);
            }

            $this->User_model->update_user($username, $update);
            $_SESSION['flash_success'] = 'User berhasil diupdate.';
            redirect('user');
        }

        // tampil form edit (opsional)
        $data['user'] = $this->User_model->get_user_by_username($username);
        if (empty($data['user'])) redirect('user');

        if (isset($_SESSION['username'])) {
            $data['curr'] = $this->db->get_where('cms_admin', ['username' => $_SESSION['username']])->row_array();
        } else {
            $data['curr'] = ['name' => 'Administrator'];
        }

        $data['title'] = 'Edit User';
        $this->load->view('header', $data);
        $this->load->view('user_edit', $data); // create view user_edit.php if you want edit form
        $this->load->view('footer', $data);
    }

    public function delete($username = null) {
        if ($username) {
            $this->User_model->delete_user($username);
            $_SESSION['flash_success'] = 'User dihapus.';
        }
        redirect('user');
    }
}
