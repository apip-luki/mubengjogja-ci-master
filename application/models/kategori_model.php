<?php
defined('BASEPATH') or exit('No direct srcript access allowed');

class Kategori_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->order_by('id_kategori', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    public function detail($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->where('id_kategori', $id_kategori);
        $this->db->order_by('id_kategori');

        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('kategori', $data);
    }

    public function update($data)
    {
        $this->db->where('id_kategori', $data['id_kategori']);
        $this->db->update('kategori', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_kategori', $data['id_kategori']);
        $this->db->delete('kategori', $data);
    }


    public function view_kategori($slug_kategori)
    {
        $this->db->select('*');
        $this->db->from('kategori');

        $this->db->where(array(
            'kategori.slug_kategori' => $slug_kategori
        ));
        $this->db->order_by('id_kategori', 'desc');

        $query = $this->db->get();
        return $query->row();
    }
}