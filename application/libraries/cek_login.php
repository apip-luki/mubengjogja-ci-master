<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek_login
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function cek()
    {

        if ($this->CI->session->userdata('email') == "" && $this->CI->session->userdata('role') == "") {
            $this->CI->session->set_flashdata('message', 'Silahkan Login terlebih dahulu');
            redirect(base_url('auth'));
        }
    }

    public function logout()
    {
        $this->CI->session->unset_userdata('id_user');
        $this->CI->session->unset_userdata('email');
        $this->CI->session->unset_userdata('nama');
        $this->CI->session->unset_userdata('role');

        $this->CI->session->set_flashdata('message', 'Anda telah keluar dari administrator');
        redirect(base_url('auth'));
    }
}