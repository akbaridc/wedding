<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()

    {
        parent::__construct();

        // cek_session();
    }

    public function index()
    {
        $data = [
            'title' => 'Login - Admin'
        ];

        $this->load->view('backend/pages/auth/login', $data);
    }

    public function loginRequest()
    {
        $dataPost = $this->input->post();

        $users = $this->db->select("*")->from("user")->where("username", $dataPost['username'])->get()->row();
        if (!empty($users)) {
            if (password_verify($dataPost['password'], $users->password)) {
                $sessionData = array(
                    'login' => true,
                    'users' => $users
                );

                $this->session->set_userdata($sessionData);

                $this->session->set_flashdata("success", 'Login successfully');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata("error", 'Login Failed! Username / Password wrong');
                redirect('login-administrator');
            }
        } else {
            $this->session->set_flashdata("error", 'Login failed, Username not found');
            redirect('login-administrator');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login-administrator');
    }
}
