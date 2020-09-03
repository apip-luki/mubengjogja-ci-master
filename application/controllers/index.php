<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('artikel_model');
		$this->load->model('kategori_model');
	}

	public function index()
	{
		$artikel = $this->artikel_model->get_all();
		$all_kategori = $this->kategori_model->get_all();
		$latepost = $this->artikel_model->latest();

		$this->load->library('pagination');

		$config['base_url'] = base_url('index/index/');
		$config['total_rows'] = count($this->artikel_model->total());
		$config['per_page'] = 4;
		$config['uri_segment'] = 3;
		$limit = $config['per_page'];
		$start = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
		$this->pagination->initialize($config);

		$artikel = $this->artikel_model->artikel($limit, $start);
		$data = array(
			'paginasi' => $this->pagination->create_links(),
			'artikel' => $artikel,
			'all_kategori' => $all_kategori,
			'latepost' => $latepost,
			'content' => 'frontend/artikel/get_all'
		);
		$this->load->view('frontend/layout/wrapp', $data, false);
	}

	public function kategori($slug_kategori)
	{
		$kategori = $this->kategori_model->view_kategori($slug_kategori);
		$all_kategori = $this->kategori_model->get_all();
		$id_kategori = $kategori->id_kategori;
		$latepost = $this->artikel_model->latest();

		$this->load->library('pagination');

		$config['base_url'] = base_url('index/kategori/' . $slug_kategori . '/index/');
		$config['total_rows'] = count($this->artikel_model->total_kategori($id_kategori));
		$config['per_page'] = 4;
		$config['uri_segment'] = 5;
		$limit = $config['per_page'];
		$start = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
		$this->pagination->initialize($config);

		$artikel = $this->artikel_model->kategori_artikel($id_kategori, $limit, $start);
		$data = array(
			'paginasi' => $this->pagination->create_links(),
			'artikel' => $artikel,
			'latepost' => $latepost,
			'all_kategori' => $all_kategori,
			'content' => 'frontend/artikel/get_all'
		);
		$this->load->view('frontend/layout/wrapp', $data, false);
	}

	public function detail($slug_artikel = NULL)
	{
		if (!empty($slug_artikel)) {
			$slug_artikel;
		} else {
			redirect(base_url('index'));
		}

		$this->load->library('disqus');

		$artikel = $this->artikel_model->view_detail($slug_artikel);
		$all_kategori = $this->kategori_model->get_all();
		$latepost = $this->artikel_model->latest();

		$disqus = $this->disqus->get_html();
		$data = array(
			'id_artikel' => $this->session->userdata('id_artikel'),
			'judul' => $artikel->judul,
			'deskripsi' => $artikel->judul,
			'kata_kunci' => $artikel->kata_kunci,
			'artikel' => $artikel,
			'all_kategori' => $all_kategori,
			'latepost' => $latepost,
			'disqus' => $disqus,
			'tanggal_post' => date('Y-m-d H:i:s'),
			'content' => 'frontend/artikel/detail'
		);

		$this->load->view('frontend/layout/wrapp', $data, false);
	}
}