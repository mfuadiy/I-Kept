<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Arsip extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//is_logged_in();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
		$this->load->model('Arsip_model', 'arsip');
		$this->load->library('form_validation');
	}

	public function aktif()
	{
		$data['judul'] 	= 'Arsip Kepesertaan';
		$data['title'] 	= 'Peserta Aktif';
		$data['user'] 	= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$role_user = $data['user']['role_id'];

		if ($role_user != 1) {
			redirect('auth/blocked');
		}
		$data['aktif']	= $this->arsip->getAktif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('arsip/aktif', $data);
		$this->load->view('templates/footer');
	}

	public function pasif()
	{
		$data['judul'] 	= 'Arsip Kepesertaan';
		$data['title'] 	= 'Peserta Pasif';
		$data['user'] 	= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$role_user = $data['user']['role_id'];

		if ($role_user != 1) {
			redirect('auth/blocked');
		}
		$data['pasif']	= $this->arsip->getPasif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('arsip/pasif', $data);
		$this->load->view('templates/footer');
	}

	public function detail($npk)
	{
		$data['judul'] 	= 'Arsip Kepesertaan';
		$data['title'] 	= 'Peserta Pasif';
		$data['user'] 	= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$role_user = $data['user']['role_id'];

		if ($role_user != 1) {
			redirect('auth/blocked');
		}

		$result = $this->db->get_where('dbpam_pa', ['noreg' => $npk]);

		if ($result->num_rows() < 1) {
			$data['namaP']	= $this->arsip->getPasifByNpk($npk);
			$data['nama'] = $data['namaP']['nama'];
		} else {
			$data['namaA']	= $this->arsip->getAktifByNpk($npk);
			$data['nama'] = $data['namaA']['nama_pes'];
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('arsip/detail', $data);
		$this->load->view('templates/footer');
	}
	public function scan()
	{
		$data['judul'] 	= 'Arsip Kepesertaan';
		$data['title'] 	= 'Scan QR Code';
		$data['user'] 	= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$role_user = $data['user']['role_id'];

		if ($role_user != 1) {
			redirect('auth/blocked');
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('arsip/scan', $data);
		$this->load->view('templates/footer');
	}
}
