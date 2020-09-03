<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $user = $this->user_model->get_all();
        $data = array(
            'title' => 'Data User',
            'user' => $user,
            'content' => 'backend/user/get_user'
        );

        $this->load->view('backend/layout/wrapp', $data, false);
    }

    public function create()
    {
        $valid = $this->form_validation;
        $valid->set_rules('nama', 'Nama', 'required', array('requred' => '%s Tidak boleh kosong'));
        $valid->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[user.email]', array('required' => '% Tidak boleh kosong', 'is_unique' => '%s <strong>' . $this->input->post('email') . '</strong> sudah digunakan. Silahkan gunakan email yang lain!!!', 'valid_email' => 'Format %s tidak valid!!!'));
        $valid->set_rules('role', 'Role', 'required', array('required' => '%s tidak boleh kosong!!!'));
        $valid->set_rules('status', 'Status', 'required', array('required' => 'Silahkan Pilih %s'));
        $valid->set_rules('password', 'Password', 'required|trim', array('required' => '%s Tidak boleh kosong'));

        if ($valid->run()) {
            $config['upload_path'] = './assets/upload/avatar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 5000;
            $config['max_width']            = 5000;
            $config['max_height']           = 5000;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('avatar')) {
                $data = array(
                    'title' => 'Tambah User',
                    'error_upload' => $this->upload->display_errors(),
                    'content' => 'backend/user/create'
                );

                $this->load->view('backend/layout/wrapp', $data, false);
            } else {
                $upload_data = array('upload' => $this->upload->data());
                $data = array(
                    'nama' => $this->input->post('nama'),
                    'avatar' => $upload_data['upload']['file_name'],
                    'email' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password')),
                    'role' => $this->input->post('role'),
                    'status' => $this->input->post('status'),
                    'dibuat' => date('Y-m-d H:i:s'),
                    'diperbarui' => date('Y-m-d H:i:s')
                );

                $this->user_model->create($data);
                $this->session->set_flashdata('sukses', 'Data telah ditambahkan');
                redirect(base_url('admin/user'), 'refresh');
            }
        }

        $data = array(
            'title' => 'Tambah User',
            'content' => 'backend/user/create'
        );

        $this->load->view('backend/layout/wrapp', $data, false);
    }

    public function update($id_user)
    {
        $user = $this->user_model->detail($id_user);
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama',
            'Nama',
            'required',
            array('required' => '%s harus diisi')
        );
        $valid->set_rules(
            'email',
            'Email',
            'required|valid_email',
            array('required' => '%s harus diisi', 'valid_email' => 'format %s tidak valid')
        );

        if ($valid->run()) {
            if (!empty($_FILES['avatar']['name'])) {
                $config['upload_path']          = '.assets/upload/avatar/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('avatar')) {
                    $data = array(
                        'title' => 'Update User : ' . $user->nama,
                        'user' => $user,
                        'error_upload' => $this->upload->display_errors(),
                        'content' => 'backend/user/update'
                    );

                    $this->load->view('backend/layout/wrapp', $data, false);
                } else {
                    $upload_data = array('upload' => $this->upload->data());

                    if ($user->avatar != "") {
                        unlink('./assets/upload/avatar/' . $user->avatar);
                    }

                    $data = array(
                        'id_user'       => $id_user,
                        'nama'          => $this->input->post('nama'),
                        'avatar'        => $upload_data['upload']['file_name'],
                        'email'         => $this->input->post('email'),
                        'role'          => $this->input->post('role'),
                        'status'        => $this->input->post('status'),
                        'diperbarui'    => date('Y-m-d H:i:s')
                    );

                    $this->user_model->update($data);
                    $this->session->set_flashdata('message', 'Data user <b>' . $user->nama . '</b> telah di update');
                    redirect(base_url('admin/user'), 'refresh');
                }
            } else {

                $i = $this->input;

                if ($user->avatar != "")
                    $data = array(
                        'id_user' => $id_user,
                        'nama' => $this->input->post('nama'),
                        'email' => $this->input->post('email'),
                        'role' => $this->input->post('role'),
                        'status' => $this->input->post('status'),
                        'diperbarui' => date('Y-m-d H:i:s')
                    );

                $this->user_model->update($data);
                $this->session->set_flashdata('message', 'Data user <b>' . $user->nama . ' </b>telah diubah');
                redirect(base_url('admin/user'), 'refresh');
            }
        }
        $data = array(
            'title' => 'Update User' . $user->nama,
            'user' => $user,
            'content' => 'backend/user/update'
        );

        $this->load->view('backend/layout/wrapp', $data, false);
    }

    public function delete($id_user)
    {
        $this->cek_login->cek();

        $user = $this->user_model->detail($id_user);

        if ($user->avatar != "") {
            unlink('./assets/upload/avatar/' . $user->avatar);
        }

        $data = array('id_user' => $user->id_user);
        $this->user_model->delete($data);
        $this->session->set_flashdata('message', 'Data User <b>' . $user->nama . '</b> telah dihapus');
        redirect(base_url('admin/user'), 'refresh');
    }
}