<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id_user', 'desc');

        $query = $this->db->get();
        return $query->result();
    }

    public function detail($id_user)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id_user);

        $query = $this->db->get();
        return $query->row();
    }

    public function login($email, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where(array(
            'email' => $email,
            'password' => sha1($password),
            'status' => 1
        ));

        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('user', $data);
    }

    public function update($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('user', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('user', $data);
    }
}