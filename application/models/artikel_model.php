<?php
class Artikel_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all()
	{
		$this->db->select('artikel.*,kategori.nama_kategori, user.nama');
		$this->db->from('artikel');

		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
		$this->db->join('user', 'user.id_user = artikel.id_user', 'left');
		$this->db->order_by('id_artikel', 'desc');

		$query = $this->db->get();
		return $query->result();
	}

	public function detail($id_artikel)
	{
		$this->db->select('*');
		$this->db->from('artikel');
		$this->db->where('id_artikel', $id_artikel);

		$query = $this->db->get();
		return $query->row();
	}

	public function create($data)
	{
		$this->db->insert('artikel', $data);
	}

	public function update($data)
	{
		$this->db->where('id_artikel', $data['id_artikel']);
		$this->db->update('artikel', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_artikel', $data['id_artikel']);
		$this->db->delete('artikel', $data);
	}

	public function artikel($limit, $start)
	{
		$this->db->select('artikel.*,kategori.nama_kategori, kategori.slug_kategori, user.nama');
		$this->db->from('artikel');

		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
		$this->db->join('user', 'user.id_user = artikel.id_user', 'left');

		$this->db->where(array('status_artikel' => 'Publish'));
		$this->db->order_by('id_artikel', 'desc');
		$this->db->limit($limit, $start);

		$query = $this->db->get();
		return $query->result();
	}

	public function latest()
	{
		$this->db->select('artikel.*,kategori.nama_kategori, kategori.slug_kategori, user.nama');
		$this->db->from('artikel');

		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
		$this->db->join('user', 'user.id_user = artikel.id_user', 'left');

		$this->db->where(array('status_artikel' => 'Publish'));
		$this->db->order_by('id_artikel', 'desc');
		$this->db->limit(6);

		$query = $this->db->get();
		return $query->result();
	}

	public function total()
	{
		$this->db->select('artikel.*,kategori.nama_kategori, kategori.slug_kategori, user.nama');
		$this->db->from('artikel');

		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
		$this->db->join('user', 'user.id_user = artikel.id_user', 'left');

		$this->db->where(array('status_artikel' => 'Publish'));
		$this->db->order_by('id_artikel', 'desc');

		$query = $this->db->get();
		return $query->result();
	}

	public function kategori_artikel($id_kategori, $limit, $start)
	{
		$this->db->select('artikel.*,kategori.nama_kategori, kategori.slug_kategori, user.nama');
		$this->db->from('artikel');

		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
		$this->db->join('user', 'user.id_user = artikel.id_user', 'left');

		$this->db->where(array(
			'status_artikel' => 'Publish',
			'artikel.id_kategori' => $id_kategori
		));
		$this->db->order_by('id_artikel', 'desc');
		$this->db->limit($limit, $start);

		$query = $this->db->get();
		return $query->result();
	}

	public function total_kategori($id_kategori)
	{
		$this->db->select('artikel.*,kategori.nama_kategori, kategori.slug_kategori, user.nama');
		$this->db->from('artikel');

		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
		$this->db->join('user', 'user.id_user = artikel.id_user', 'left');

		$this->db->where(array(
			'status_artikel' => 'Publish',
			'artikel.id_kategori' => $id_kategori
		));
		$this->db->order_by('id_artikel', 'desc');

		$query = $this->db->get();
		return $query->result();
	}

	public function view_detail($slug_artikel)
	{
		$this->db->select('artikel.*,kategori.nama_kategori, kategori.slug_kategori, user.nama, user.avatar');
		$this->db->from('artikel');

		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
		$this->db->join('user', 'user.id_user = artikel.id_user', 'left');

		$this->db->where(array(
			'status_artikel' => 'Publish',
			'artikel.slug_artikel' => $slug_artikel
		));
		$this->db->order_by('id_artikel', 'desc');

		$query = $this->db->get();
		return $query->row();
	}
}