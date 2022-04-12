<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proyeksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proyeksi_model', 'proyeksi');
    }

    public function aktif()
    {
        $data['judul']    = 'Proyeksi Pensiun';
        $data['title']    = 'Peserta Aktif';
        $data['user']     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('proyeksi/aktif', $data);
        $this->load->view('templates/footer');
    }

    public function pasif()
    {
        $data['judul']    = 'Proyeksi Pensiun';
        $data['title']    = 'Peserta Pasif';
        $data['user']     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('proyeksi/pasif', $data);
        $this->load->view('templates/footer');
    }
}
