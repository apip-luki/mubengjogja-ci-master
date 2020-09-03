<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_model');
		$this->load->model('artikel_model');
		$this->load->model('user_model');
		$this->load->helper('string');
	}

	public function index()
	{
		$user = $this->user_model->get_all();
		$data = array(
			'title' 	=> 'Welcome to Admin',
			'content' 	=> 'backend/dashboard/dashboard',
			'user'		=> $user
		);

		$this->load->view('backend/layout/wrapp', $data, false);
	}

	public function artikel()
	{
		$artikel = $this->artikel_model->get_all();
		$data = array(
			'title' => 'Data Artikel',
			'artikel' => $artikel,
			'content' => 'backend/artikel/get_artikel'
		);

		$this->load->view('backend/layout/wrapp', $data, false);
	}

	public function create()
	{
		$kategori = $this->kategori_model->get_all();
		$valid = $this->form_validation;
		$valid->set_rules(
			'judul',
			'Judul Artikel',
			'required',
			array('required' => '%s Harus diisi')
		);
		$valid->set_rules(
			'judul',
			'Judul Artikel',
			'required',
			array('required' => '%s Harus diisi')
		);
		$valid->set_rules(
			'isi_artikel',
			'Isi Artikel',
			'required',
			array('required' => '%s Harus diisi')
		);
		$valid->set_rules(
			'status_artikel',
			'Status_artikel',
			'required',
			array('required' => '%s Harus diisi')
		);
		$valid->set_rules(
			'id_kategori',
			'Kategori',
			'required',
			array('required' => '%s Harus diisi')
		);

		if ($valid->run()) {
			$config['upload_path']          = './assets/upload/images/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 5000;
			$config['max_width']            = 5000;
			$config['max_height']           = 5000;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {

				$data = array(
					'title'         => 'Buat Artikel',
					'error_upload'  => $this->upload->display_errors(),
					'kategori'      => $kategori,
					'content'       => 'backend/artikel/create'
				);

				$this->load->view('backend/layout/wrapp', $data, false);
			} else {
				$upload_data = array('upload' => $this->upload->data());

				$slug_artikel = url_title($this->input->post('title'), 'dash', true);
				$slug_unik = random_string('numeric', 5);

				$data = array(
					'id_user'        => $this->session->userdata('id_user'),
					'id_kategori'       => $this->input->post('id_kategori'),
					'judul'             => $this->input->post('judul'),
					'slug_artikel'      => $slug_artikel . '-' . $slug_unik,
					'isi_artikel'       => $this->input->post('isi_artikel'),
					'gambar'            => $upload_data['upload']['file_name'],
					'status_artikel'    => $this->input->post('status_artikel'),
					'kata_kunci'        => $this->input->post('kata_kunci'),
					'dibuat'            => date('Y-m-d H:i:s'),
					'diperbarui'        => date('Y-m-d H:i:s')
				);

				$this->artikel_model->create($data);
				$this->session->set_flashdata('sukses', 'Artikel telah ditambahkan');
				redirect(base_url('admin/index/artikel'));
			}
		}

		$data = array(
			'title' => 'Buat Artikel',
			'kategori' => $kategori,
			'content' => 'backend/artikel/create'
		);
		$this->load->view('backend/layout/wrapp', $data, false);
	}

	public function update_art($id_artikel)
	{
		$artikel = $this->artikel_model->detail($id_artikel);
		$kategori = $this->kategori_model->get_all();

		$valid = $this->form_validation;
		$valid->set_rules(
			'judul',
			'Judul Artikel',
			'required',
			array('required' => '%s Harus diisi')
		);
		$valid->set_rules(
			'judul',
			'Judul Artikel',
			'required',
			array('required' => '%s Harus diisi')
		);
		$valid->set_rules(
			'isi_artikel',
			'Isi Artikel',
			'required',
			array('required' => '%s Harus diisi')
		);
		$valid->set_rules(
			'status_artikel',
			'Status Artikel',
			'required',
			array('required' => '%s Harus diisi')
		);
		$valid->set_rules(
			'id_kategori',
			'Kategori',
			'required',
			array('required' => '%s Harus diisi')
		);

		if ($valid->run()) {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path']          = './assets/upload/images/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 5000;
				$config['max_width']            = 5000;
				$config['max_height']           = 5000;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title'         => 'Update Artikel : ' . $artikel->judul,
						'artikel'       => $artikel,
						'kategori'      => $kategori,
						'error_upload'  => $this->upload->display_errors(),
						'content'       => 'backend/artikel/update'
					);

					$this->load->view('backend/layout/wrapp', $data, false);
				} else {
					$upload_data = array('upload' => $this->upload->data());

					if ($artikel->gambar != "") {
						unlink('./assets/upload/images/' . $artikel->gambar);
					}

					$data = array(
						'id_artikel'        => $id_artikel,
						'id_user'           => $this->session->userdata('id_user'),
						'id_kategori'       => $this->input->post('id_kategori'),
						'judul'             => $this->input->post('judul'),
						'isi_artikel'       => $this->input->post('isi_artikel'),
						'gambar'            => $upload_data['upload']['file_name'],
						'status_artikel'    => $this->input->post('status_artikel'),
						'kata_kunci'        => $this->input->post('kata_kunci'),
						'diperbarui'        => date('Y-m-d H:i:s')
					);

					$this->artikel_model->update($data);
					$this->session->set_flashdata('message', 'Artikel <b>' . $artikel->judul . '</b> telah di update');
					redirect(base_url('admin/index/artikel'));
				}
			} else {

				$i = $this->input;
				if ($artikel->gambar != "")

					$data = array(
						'id_artikel' => $id_artikel,
						'id_user' => $this->session->userdata('id_user'),
						'id_kategori' => $this->input->post('id_kategori'),
						'judul' => $this->input->post('judul'),
						'isi_artikel' => $this->input->post('isi_artikel'),
						'status_artikel' => $this->input->post('status_artikel'),
						'kata_kunci' => $this->input->post('kata_kunci'),
						'diperbarui' => date('Y-m-d H:i:s')
					);

				$this->artikel_model->update($data);
				$this->session->set_flashdata('message', 'Artikel <b>' . $artikel->judul . '</b> telah diubah');
				redirect(base_url('admin/index/artikel'));
			}
		}

		$data = array(
			'title'     => 'Update Artikel : <b>' . $artikel->judul . '</b>',
			'artikel'   => $artikel,
			'kategori'  => $kategori,
			'content'   => 'backend/artikel/update'
		);

		$this->load->view('backend/layout/wrapp', $data, false);
	}

	public function delete_art($id_artikel)
	{
		$this->cek_login->cek();
		$artikel = $this->artikel_model->detail($id_artikel);

		if ($artikel->gambar != "") {
			unlink('./assets/upload/images' . $artikel->gambar);
		}

		$data = array(
			'id_artikel' => $artikel->id_artikel
		);

		$this->artikel_model->delete($data);
		$this->session->set_flashdata('message', 'Artikel <b>' . $artikel->judul . '</b> telah dihapus');
		redirect(base_url('admin/index/artikel'));
	}

	public function kategori()
	{
		$kategori = $this->kategori_model->get_all();

		$this->form_validation->set_rules(
			'nama_kategori',
			'Nama kategori',
			'required|is_unique[kategori.nama_kategori]',
			array(
				'required' => '%s Harus Di isi',
				'is_unique' => '%s Sudah ada, buat nama kategori lain'
			)
		);

		if ($this->form_validation->run() === false) {
			$data = array(
				'title' => 'Data Kategori',
				'kategori' => $kategori,
				'content' => 'backend/kategori/get_kategori'
			);

			$this->load->view('backend/layout/wrapp', $data, false);
		} else {
			$slug_kategori = url_title($this->input->post('nama_kategori'), 'dash', true);
			$data = array(
				'slug_kategori' => $slug_kategori,
				'nama_kategori' => $this->input->post('nama_kategori')
			);

			$this->kategori_model->create($data);
			$this->session->set_flashdata('sukses', 'Data berhasil ditambahkan');
			redirect(base_url('admin/index/kategori'));
		}
	}

	public function update_kat($id_kategori)
	{
		$kategori = $this->kategori_model->detail($id_kategori);
		$this->form_validation->set_rules(
			'nama_kategori',
			'Nama kategori',
			'required|is_unique[kategori.nama_kategori]',
			array(
				'required' => '%s Harus Di isi',
				'is_unique' => '%s Sudah ada, buat nama kategori lain'
			)
		);

		if ($this->form_validation->run() === false) {
			$data = array(
				'title' => 'Update Kategori',
				'kategori' => $kategori,
				'content' => 'backend/kategori/update'
			);

			$this->load->view('backend/layout/wrapp', $data, false);
		} else {
			$data = array(
				'id_kategori' => $id_kategori,
				'nama_kategori' => $this->input->post('nama_kategori')
			);

			$this->kategori_model->update($data);
			$this->session->set_flashdata('sukses', 'Data kategori telah diubah');
			redirect(base_url('admin/index/kategori'));
		}
	}

	public function delete_kat($id_kategori)
	{
		$this->cek_login->cek();
		$kategori = $this->kategori_model->detail($id_kategori);
		$data = array('id_kategori' => $kategori->id_kategori);

		$this->kategori_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		redirect(base_url('admin/index/kategori'));
	}

	public function user()
	{
		redirect('admin/user');
	}
}