<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('admin/index');
		}

		$valid = $this->form_validation;
		$valid->set_rules(
			'email',
			'Email',
			'required|trim',
			array('required' => '%s Harus diisi')
		);
		$valid->set_rules(
			'password',
			'Password',
			'required|trim',
			array('required' => '%s Harus diisi')
		);

		if ($valid->run()) {

			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$cek_login = $this->user_model->login($email, $password);

			if ($cek_login) {
				$this->session->set_userdata('id_user', $cek_login->id_user);
				$this->session->set_userdata('email', $cek_login->email);
				$this->session->set_userdata('nama', $cek_login->nama);
				$this->session->set_userdata('role', $cek_login->role);
				$this->session->set_flashdata('login', 'Selamat datang! Anda berhasil login');
				redirect('admin/index');
			} else {
				$this->session->set_flashdata('message', 'Login gagal');
				redirect('auth');
			}
		}

		$data = array(
			'title' => 'Login Administrator'
		);
		$this->load->view('backend/auth/login', $data, false);
	}

	public function logout()
	{
		// $this->session->unset_userdata('id_user');
		// $this->session->unset_userdata('email');
		// $this->session->unset_userdata('nama');
		// $this->session->unset_userdata('role');

		// $this->session->set_flashdata('message', 'Anda telah keluar dari administrator');
		// redirect(base_url('auth'));
		$this->cek_login->logout();
	}
}