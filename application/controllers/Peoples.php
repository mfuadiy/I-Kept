<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\WriterMultiSheetsAbstract;
use Box\Spout\Common\Entity\Row;

/**
 * 
 */
class Peoples extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//is_logged_in();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
		$this->load->model('Peoples_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Peserta Aktif';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$role_user = $data['user']['role_id'];

		if ($role_user == 3) {
			redirect('auth/blocked');
		}

		$this->load->model('Peoples_model', 'peoples');


		//load library
		$this->load->library('pagination');
		//ambil data keyword
		// if ($this->input->post('submit')) {
		// 	$data['keyword'] = $this->input->post('keyword');
		// 	$this->session->set_userdata('keyword', $data['keyword']);
		// } else {
		// 	$data['keyword'] = $this->session->userdata('keyword');
		// }
		//Config
		// $this->db->like('noreg', $data['keyword']);
		// $this->db->or_like('nama_pes', $data['keyword']);
		// $this->db->from('dbpam_pa');
		// $config['total_rows']  = $this->db->count_all_results();
		// $data['total_rows'] = $config['total_rows'];
		// $config['per_page'] = 10;
		//Initialize
		// $this->pagination->initialize($config);


		$data['start'] = $this->uri->segment(3);

		$this->db->order_by('nama_pes', 'ASC');
		$data['peoples']	= $this->peoples->getPeoples();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/index', $data);
		$this->load->view('templates/footer');
	}

	public function analisaPesertaAktif()
	{
		$this->load->model('Peoples_model', 'peoples');
		$data['title'] 	= 'Lab Peserta Aktif';
		$data['aktif'] = $this->peoples->getAnalytic();
		$this->load->view('laporan/analisa-peserta-aktif', $data);
	}

	public function detail($npk)
	{
		$data['title'] 	= 'Peserta Aktif';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$role_user = $data['user']['role_id'];

		if ($role_user == 3) {
			redirect('auth/blocked');
		}

		$data['alldata'] = $this->Peoples_model->getAllDataById($npk);
		$data['peoples'] = $this->Peoples_model->getPeoplesById($npk);
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisById($npk);
		$data['detail'] = $this->Peoples_model->getDetailById($npk);
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$data['jk'] = $this->db->get('jk')->result_array();
		$data['agama'] = $this->db->get('agama')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail', $data);
		$this->load->view('templates/footer');
	}

	public function detail_pekerjaan($npk)
	{
		$data['title'] 	= 'Peserta Aktif';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$role_user = $data['user']['role_id'];

		if ($role_user == 3) {
			redirect('auth/blocked');
		}

		$data['alldata'] = $this->Peoples_model->getAllDataById($npk);
		$data['peoples'] = $this->Peoples_model->getPeoplesById($npk);
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisById($npk);
		$data['detail'] = $this->Peoples_model->getDetailById($npk);
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$this->db->order_by('nama_cab', 'ASC');
		$data['cabang'] = $this->db->get('cabang')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail_pekerjaan', $data);
		$this->load->view('templates/footer');
	}

	public function detail_alamat($npk)
	{
		$data['title'] 	= 'Peserta Aktif';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$role_user = $data['user']['role_id'];

		if ($role_user == 3) {
			redirect('auth/blocked');
		}

		$data['alldata'] = $this->Peoples_model->getAllDataById($npk);
		$data['peoples'] = $this->Peoples_model->getPeoplesById($npk);
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisById($npk);
		$data['detail'] = $this->Peoples_model->getDetailById($npk);
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail_alamat', $data);
		$this->load->view('templates/footer');
	}

	public function detail_keluarga($npk)
	{
		$data['title'] 	= 'Peserta Aktif';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$role_user = $data['user']['role_id'];

		if ($role_user == 3) {
			redirect('auth/blocked');
		}

		$data['alldata'] = $this->Peoples_model->getAllDataById($npk);
		$data['peoples'] = $this->Peoples_model->getPeoplesById($npk);
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisById($npk);
		$data['detail'] = $this->Peoples_model->getDetailById($npk);
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail_keluarga', $data);
		$this->load->view('templates/footer');
	}

	public function detail_simulasi()
	{
		$data['title'] 	= 'Simulasi Pensiun';
		$data['judul'] = 'Kepesertaan';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$npk = $data['user']['npk'];


		$data['alldata'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();
		$data['ahli_waris'] = $this->db->get_where('ahli_waris', ['id' => $npk])->result_array();

		$mbk		= new DateTime($data['alldata']['tgl_lhr']);
		$now		= new DateTime();
		$intervalkrj = date_diff($mbk, $now);
		$lamakerja	= $intervalkrj->y + round((($intervalkrj->m + 1) / 12), 2);
		//var_dump($lamakerja);
		$t = $intervalkrj->y;
		$b = $intervalkrj->m;
		$s = $data['alldata']['st_kwn'];

		switch ($s) {
			case 'K0':
				$s = "K0";
				break;
			case 'K2':
				$s = "K1";
				break;
			case 'K1':
				$s = "K1";
				break;
			case 'K3':
				$s = "K1";
				break;
			case 'K4':
				$s = "K1";
				break;
			case 'K5':
				$s = "K1";
				break;
			case 'K6':
				$s = "K1";
				break;
			case '0':
				$s = "K1";
				break;
			case 'K':
				$s = "K1";
				break;
			case 'TK':
				$s = "TK0";
				break;
			case 'TK0':
				$s = "TK0";
				break;
			case 'J0':
				$s = "TK0";
				break;
			case 'J1':
				$s = "TK1";
				break;
			case 'J2':
				$s = "TK1";
				break;
			case 'J3':
				$s = "TK1";
				break;
			case 'T2':
				$s = "TK1";
				break;
			case 'T3':
				$s = "TK1";
				break;

			default:
				$s = "K1";
				break;
		}

		$where = array(
			'umr_th' 	=> $t,
			'umr_bln' 	=> $b,
			'stkwn'		=> $s
		);


		$data['akt']  = $this->db->get_where('aktuaria', $where)->row_array();

		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail_peserta_simulasi', $data);
		$this->load->view('templates/footer');
	}

	public function detail_peserta()
	{
		$data['title'] 	= 'Data Peserta';
		$data['judul'] = 'Data Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$npk = $data['user']['npk'];


		$data['alldata'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();
		$data['ahli_waris'] = $this->db->get_where('ahli_waris', ['id' => $npk])->result_array();
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$data['jk'] = $this->db->get('jk')->result_array();
		$data['agama'] = $this->db->get('agama')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail_peserta', $data);
		$this->load->view('templates/footer');
	}

	public function detail_peserta_pekerjaan()
	{
		$data['title'] 	= 'Data Peserta';
		$data['judul'] = 'Data Kepesertaan';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$npk = $data['user']['npk'];


		$data['alldata'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();
		$data['ahli_waris'] = $this->db->get_where('ahli_waris', ['id' => $npk])->result_array();
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$this->db->order_by('nama_cab', 'ASC');
		$data['cabang'] = $this->db->get('cabang')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail_peserta_pekerjaan', $data);
		$this->load->view('templates/footer');
	}

	public function detail_peserta_alamat()
	{
		$data['title'] 	= 'Data Peserta';
		$data['judul'] = 'Data Kepesertaan';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$npk = $data['user']['npk'];


		$data['alldata'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();
		$data['ahli_waris'] = $this->db->get_where('ahli_waris', ['id' => $npk])->result_array();
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail_peserta_alamat', $data);
		$this->load->view('templates/footer');
	}

	public function detail_peserta_keluarga()
	{
		$data['title'] 	= 'Data Peserta';
		$data['judul'] = 'Data Kepesertaan';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$npk = $data['user']['npk'];


		$data['alldata'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();
		$data['ahli_waris'] = $this->db->get_where('ahli_waris', ['id' => $npk])->result_array();
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail_peserta_keluarga', $data);
		$this->load->view('templates/footer');
	}

	public function detail_peserta_simulasi($npk)
	{
		$data['title'] 	= 'Simulasi Pensiun';
		$data['judul'] = 'Kepesertaan';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		//$npk = $data['user']['npk'];


		$data['alldata'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();
		$data['ahli_waris'] = $this->db->get_where('ahli_waris', ['id' => $npk])->result_array();

		$mbk		= new DateTime($data['alldata']['tgl_lhr']);
		$now		= new DateTime();
		$intervalkrj = date_diff($mbk, $now);
		$lamakerja	= $intervalkrj->y + round((($intervalkrj->m + 1) / 12), 2);
		//var_dump($lamakerja);
		$t = $intervalkrj->y;
		$b = $intervalkrj->m;
		$s = $data['alldata']['st_kwn'];

		switch ($s) {
			case 'K0':
				$s = "K0";
				break;
			case 'K2':
				$s = "K1";
				break;
			case 'K1':
				$s = "K1";
				break;
			case 'K3':
				$s = "K1";
				break;
			case 'K4':
				$s = "K1";
				break;
			case 'K5':
				$s = "K1";
				break;
			case 'K6':
				$s = "K1";
				break;
			case '0':
				$s = "K1";
				break;
			case 'K':
				$s = "K1";
				break;
			case 'TK':
				$s = "TK0";
				break;
			case 'TK0':
				$s = "TK0";
				break;
			case 'J0':
				$s = "TK0";
				break;
			case 'J1':
				$s = "TK1";
				break;
			case 'J2':
				$s = "TK1";
				break;
			case 'J3':
				$s = "TK1";
				break;
			case 'T2':
				$s = "TK1";
				break;
			case 'T3':
				$s = "TK1";
				break;

			default:
				$s = "K1";
				break;
		}

		$where = array(
			'umr_th' 	=> $t,
			'umr_bln' 	=> $b,
			'stkwn'		=> $s
		);


		$data['akt']  = $this->db->get_where('aktuaria', $where)->row_array();

		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/detail_peserta_simulasi', $data);
		$this->load->view('templates/footer');
	}

	public function edit_profile($npk)
	{
		$data['title'] 	= 'Edit Profile';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Peoples_model', 'peoples');

		$data['peoples'] = $this->Peoples_model->getPeoplesById($npk);
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisById($npk);
		$data['detail'] = $this->Peoples_model->getDetailById($npk);


		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/edit_profile', $data);
		$this->load->view('templates/footer');
	}

	public function edit_ahliwaris($no_id)
	{
		$data['title'] 	= 'Edit Ahli Waris';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$npk = $data['user']['npk'];

		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisByNoId($no_id);

		$id = $data['ahli_waris']['id'];

		$data['alldata'] = $this->Peoples_model->getAllDataById($id);
		$this->load->model('Peoples_model', 'peoples');

		$data['jk'] = $this->db->get('jk')->result_array();
		$data['status_keluarga'] = $this->db->get('status_keluarga')->result_array();
		$data['status_tanggungan'] = $this->db->get('status_tanggungan')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/edit_ahliwaris', $data);
		$this->load->view('templates/footer');
	}

	public function preview($npk)
	{
		$data['title'] 	= 'Peserta Aktif';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['alldata'] = $this->Peoples_model->getAllDataById($npk);
		$data['peoples'] = $this->Peoples_model->getPeoplesById($npk);
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisById($npk);
		$data['detail'] = $this->Peoples_model->getDetailById($npk);
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$data['jk'] = $this->db->get('jk')->result_array();
		$data['agama'] = $this->db->get('agama')->result_array();
		$data['cabang'] = $this->db->get('cabang')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/preview', $data);
		$this->load->view('templates/footer');
	}

	public function preview_peserta($npk)
	{
		$data['title'] 	= 'Preview';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['alldata'] = $this->Peoples_model->getAllDataById($npk);
		$data['peoples'] = $this->Peoples_model->getPeoplesById($npk);
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisById($npk);
		$data['detail'] = $this->Peoples_model->getDetailById($npk);
		$data['temp'] = $this->Peoples_model->getAllTempDataById($npk);

		$data['jk'] = $this->db->get('jk')->result_array();
		$data['agama'] = $this->db->get('agama')->result_array();
		$data['cabang'] = $this->db->get('cabang')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/preview_peserta', $data);
		$this->load->view('templates/footer');
	}

	public function riwayat($npk)
	{
		$data['title'] 	= 'Peserta Aktif';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['alldata'] 	= $this->Peoples_model->getAllDataById($npk);
		$data['peoples'] 	= $this->Peoples_model->getPeoplesById($npk);
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisById($npk);
		$data['detail'] 	= $this->Peoples_model->getDetailById($npk);
		$data['temp'] 		= $this->Peoples_model->getAllTempDataById($npk);

		$this->db->order_by('date_created', 'DESC');
		$data['riwayat']	= $this->db->get_where('backup_dbpam_pa', ['noreg' => $npk])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/riwayat', $data);
		$this->load->view('templates/footer');
	}

	public function riwayat_peserta($npk)
	{
		$data['title'] 	= 'Riwayat';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['alldata'] 	= $this->Peoples_model->getAllDataById($npk);
		$data['peoples'] 	= $this->Peoples_model->getPeoplesById($npk);
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisById($npk);
		$data['detail'] 	= $this->Peoples_model->getDetailById($npk);
		$data['temp'] 		= $this->Peoples_model->getAllTempDataById($npk);

		$this->db->order_by('date_created', 'DESC');
		$data['riwayat']	= $this->db->get_where('backup_dbpam_pa', ['noreg' => $npk])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/riwayat_peserta', $data);
		$this->load->view('templates/footer');
	}

	public function riwayat_ahliwaris($no_id)
	{
		$data['title'] 	= 'Edit Ahli Waris';
		$data['judul'] = 'Kepesertaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$npk = $data['user']['npk'];

		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisByNoId($no_id);

		$id = $data['ahli_waris']['id'];

		$data['alldata'] = $this->Peoples_model->getAllDataById($id);
		$data['ahli_waris1'] = $this->db->get_where('ahli_waris', ['id' => $id])->result_array();

		$this->db->order_by('date_created', 'DESC');
		$data['riwayat']	= $this->db->get_where('backup_ahli_waris', ['no_id' => $no_id])->result_array();

		$this->load->model('Peoples_model', 'peoples');

		$data['jk'] = $this->db->get('jk')->result_array();
		$data['status_keluarga'] = $this->db->get('status_keluarga')->result_array();
		$data['status_tanggungan'] = $this->db->get('status_tanggungan')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/riwayat_ahliwaris', $data);
		$this->load->view('templates/footer');
	}







































	public function update_fotoprofil()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$noreg = $this->input->post('noreg');

		$data['alldata'] 	= $this->Peoples_model->getAllDataById($noreg);

		$upload_image = $_FILES['image']['name'];

		if ($upload_image) {
			$waktu = time();
			$namafile = "profile_" . $noreg . "-" . $waktu;
			$config['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/profile';
			$config['file_name'] = $namafile;


			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {

				$old_image = $data['alldata']['img'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/profile/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->db->set('img', $new_image);
				$this->db->where('noreg', $noreg);
				$this->db->update('dbpam_pa');
			} else {
				echo $this->upload->display_errors();
			}
		}
		redirect('peoples/detail/' . $noreg);
	}

	public function update_fotoprofil_p()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$noreg = $this->input->post('noreg');

		$data['alldata'] 	= $this->Peoples_model->getAllDataById($noreg);

		$upload_image = $_FILES['image']['name'];

		if ($upload_image) {
			$waktu = time();
			$namafile = "profile_" . $noreg . "-" . $waktu;
			$config['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/profile';
			$config['file_name'] = $namafile;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {

				$old_image = $data['alldata']['img'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/profile/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->db->set('img', $new_image);
				$this->db->where('noreg', $noreg);
				$this->db->update('dbpam_pa');
			} else {
				echo $this->upload->display_errors();
			}
		}

		redirect('peoples/detail_peserta');
	}

	public function update_datapribadi()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$noregDataPribadi 	= htmlspecialchars($this->input->post('noregDataPribadi'));
		$nama 				= htmlspecialchars($this->input->post('nama'));
		$jk 				= htmlspecialchars($this->input->post('jk'));
		$tgl_lhr 			= htmlspecialchars($this->input->post('tgl_lhr'));
		$tp_lhr 			= htmlspecialchars($this->input->post('tp_lhr'));
		$nik 				= htmlspecialchars($this->input->post('nik'));
		$npwp 				= htmlspecialchars($this->input->post('npwp'));
		$agama 				= htmlspecialchars($this->input->post('agama'));

		$data['alldata'] 	= $this->Peoples_model->getAllDataById($noregDataPribadi);

		$upload_image = $_FILES['image']['name'];


		if ($upload_image) {
			$namafile = "ktp_" . $noregDataPribadi;
			$config['allowed_types'] = 'jpeg|jpg|png|bmp|pdf';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/ktp';
			$config['file_name'] = $namafile;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {

				$old_image = $data['alldata']['scan_ktp'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/ktp/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->db->set('scan_ktp', $new_image);
				$this->db->where('noreg', $noregDataPribadi);
				$this->db->update('dbpam_pa');
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = array(

			'nama_pes' => $nama,
			'jk' => $jk,
			'tp_lhr' => $tp_lhr,
			'tgl_lhr' => $tgl_lhr,
			'nik' => $nik,
			'npwp' => $npwp,
			'agama' => $agama
		);

		$where = array(
			'noreg' => $noregDataPribadi
		);
		$this->Peoples_model->update_datapribadi($where, $data);
		$this->load->view('peoples/update_datapribadi');
	}

	public function update_pekerjaan()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$noreg 		= htmlspecialchars($this->input->post('noreg'));
		$st_peg 	= htmlspecialchars($this->input->post('st_peg'));
		$tgl_mb 	= htmlspecialchars($this->input->post('tgl_mb'));
		$golongan 	= htmlspecialchars($this->input->post('golongan'));
		$phdp 		= htmlspecialchars($this->input->post('phdp'));
		$nskst 		= htmlspecialchars($this->input->post('nskst'));
		$cabang 	= htmlspecialchars($this->input->post('cabang'));

		$data['alldata'] 	= $this->Peoples_model->getAllDataById($noreg);

		$upload_image = $_FILES['image']['name'];


		if ($upload_image) {
			$namafile = "sk_" . $noreg;
			$config['allowed_types'] = 'jpeg|jpg|png|bmp|pdf';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/sk';
			$config['file_name'] = $namafile;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {

				$old_image = $data['alldata']['scan_sk'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/sk/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->db->set('scan_sk', $new_image);
				$this->db->where('noreg', $noreg);
				$this->db->update('dbpam_pa');
			} else {
				echo $this->upload->display_errors();
			}
		}


		$data = array(
			'st_peg' => $st_peg,
			'noreg' => $noreg,
			'tgl_mb' => $tgl_mb,
			'golongan' => $golongan,
			'phdp' => $phdp,
			'nskst' => $nskst,
			'cab' => $cabang
		);

		$where = array(
			'noreg' => $noreg
		);
		$this->Peoples_model->update_datapribadi($where, $data);
		$this->load->view('peoples/update_datapribadi');
	}

	public function update_alamat()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$noreg 		= htmlspecialchars($this->input->post('noregAlamat'));
		$almt 		= htmlspecialchars($this->input->post('almt'));
		$rt_rw 		= htmlspecialchars($this->input->post('rt_rw'));
		$kelurahan 	= htmlspecialchars($this->input->post('kelurahan'));
		$kecamatan 	= htmlspecialchars($this->input->post('kecamatan'));
		$kota 		= htmlspecialchars($this->input->post('kota'));
		$kodepos 	= htmlspecialchars($this->input->post('kodepos'));
		$phone 		= htmlspecialchars($this->input->post('phone'));
		$hp 		= htmlspecialchars($this->input->post('hp'));

		$data['alldata'] 	= $this->Peoples_model->getAllDataById($noreg);

		$upload_image = $_FILES['image']['name'];


		if ($upload_image) {
			$namafile = "kk_" . $noreg;
			$config['allowed_types'] = 'jpeg|jpg|png|bmp|pdf';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/kk';
			$config['file_name'] = $namafile;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {

				$old_image = $data['alldata']['scan_kk'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/kk/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->db->set('scan_kk', $new_image);
				$this->db->where('noreg', $noreg);
				$this->db->update('dbpam_pa');
			} else {
				echo $this->upload->display_errors();
			}
		}


		$data = array(
			'almt' 			=> $almt,
			'rt_rw' 		=> $rt_rw,
			'kelurahan' 	=> $kelurahan,
			'kecamatan' 	=> $kecamatan,
			'kota' 			=> $kota,
			'kodepos' 		=> $kodepos,
			'phone' 		=> $phone,
			'telphp' 		=> $hp
		);

		$where = array(
			'noreg' => $noreg
		);
		$this->Peoples_model->update_datapribadi($where, $data);
		$this->load->view('peoples/update_datapribadi');
	}

	public function update_ahliwaris()
	{


		$no_id 			= htmlspecialchars($this->input->post('no_id'));
		$nama 			= htmlspecialchars($this->input->post('nama'));
		$jk_aw 			= htmlspecialchars($this->input->post('jk_aw'));
		$stts_kel 		= htmlspecialchars($this->input->post('stts_kel'));
		$stts_tanggn 	= htmlspecialchars($this->input->post('stts_tanggn'));
		$tgl_lhr_aw 	= htmlspecialchars($this->input->post('tgl_lhr_aw'));
		$ket 			= htmlspecialchars($this->input->post('ket'));

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['ahli_waris'] = $this->Peoples_model->getAhliWarisByNoId($no_id);

		$no_id0			= $data['ahli_waris']['no_id'];
		$id0 			= $data['ahli_waris']['id'];
		$nama0 			= $data['ahli_waris']['nama_aw'];
		$jk_aw0			= $data['ahli_waris']['jk_aw'];
		$stts_kel0 		= $data['ahli_waris']['stts_kel'];
		$stts_tanggn0 	= $data['ahli_waris']['stts_tanggn'];
		$tgl_lhr_aw0 	= $data['ahli_waris']['tgl_lhr_aw'];
		$ket0 			= $data['ahli_waris']['ket'];
		$dok_pendukung0	= $data['ahli_waris']['dok_pendukung'];
		$penyunting0	= $data['user']['name'];
		$date_created	= time();


		$npk = $data['ahli_waris']['id'];
		$upload_image = $_FILES['image']['name'];


		if ($upload_image) {

			$namafile = "dok_pendukung_" . $no_id;
			$config['allowed_types'] = 'jpeg|jpg|png|bmp|pdf';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/dok_pendukung';
			$config['file_name'] = $namafile;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {

				$old_image = $data['ahli_waris']['dok_pendukung'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/dok_pendukung/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->db->set('dok_pendukung', $new_image);
				$this->db->where('no_id', $no_id);
				$this->db->update('ahli_waris');
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data0 = array(

			'nama_aw' 		=> $nama0,
			'jk_aw' 		=> $jk_aw0,
			'stts_kel' 		=> $stts_kel0,
			'stts_tanggn' 	=> $stts_tanggn0,
			'tgl_lhr_aw' 	=> $tgl_lhr_aw0,
			'ket' 			=> $ket0,
			'no_id'			=> $no_id0,
			'id'			=> $id0,
			'dok_pendukung'	=> $dok_pendukung0,
			'penyunting'	=> $penyunting0,
			'date_created'  => $date_created
		);

		$this->db->insert('backup_ahli_waris', $data0);

		$data = array(

			'nama_aw' 		=> $nama,
			'jk_aw' 		=> $jk_aw,
			'stts_kel' 		=> $stts_kel,
			'stts_tanggn' 	=> $stts_tanggn,
			'tgl_lhr_aw' 	=> $tgl_lhr_aw,
			'ket' 			=> $ket
		);




		$where = array(
			'no_id' => $no_id
		);
		$this->Peoples_model->update_ahliwaris($where, $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  			Data Berhasil Disimpan Dalam Data Master!
			</div>');


		$this->load->view('peoples/back_twice');
	}

	public function update_preview($npk)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		//$npk 		= $data['user']['npk'];
		$penyunting = $data['user']['name'];
		$role_user	= $data['user']['role_id'];
		$data['alldata'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('jk', 'Nama', 'required|trim');
		$this->form_validation->set_rules('agama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tgl_lhr', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tp_lhr', 'Nama', 'required|trim');
		$this->form_validation->set_rules('nik', 'Nama', 'required|trim');
		$this->form_validation->set_rules('noreg', 'Nama', 'required|trim');
		$this->form_validation->set_rules('st_peg', 'Nama', 'required|trim');
		$this->form_validation->set_rules('cab', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tgl_mb', 'Nama', 'required|trim');
		$this->form_validation->set_rules('golongan', 'Nama', 'required|trim');
		$this->form_validation->set_rules('phdp', 'Nama', 'required|trim');
		$this->form_validation->set_rules('nskst', 'Nama', 'required|trim');
		$this->form_validation->set_rules('almt', 'Nama', 'required|trim');
		$this->form_validation->set_rules('rt_rw', 'Nama', 'required|trim');
		$this->form_validation->set_rules('kelurahan', 'Nama', 'required|trim');
		$this->form_validation->set_rules('kecamatan', 'Nama', 'required|trim');
		$this->form_validation->set_rules('kota', 'Nama', 'required|trim');
		$this->form_validation->set_rules('kodepos', 'Nama', 'required|trim');
		$this->form_validation->set_rules('phone', 'Nama', 'required|trim');
		$this->form_validation->set_rules('hp', 'Nama', 'required|trim');




		$nama0		= $data['alldata']['nama_pes'];
		$jk0		= $data['alldata']['jk'];
		$agama0		= $data['alldata']['agama'];
		$tgl_lhr0	= $data['alldata']['tgl_lhr'];
		$tp_lhr0	= $data['alldata']['tp_lhr'];
		$npwp0		= $data['alldata']['npwp'];
		$nik0		= $data['alldata']['nik'];

		$nama 		= htmlspecialchars($this->input->post('nama', true));
		$jk 		= htmlspecialchars($this->input->post('jk', true));
		$agama 		= htmlspecialchars($this->input->post('agama', true));
		$tgl_lhr 	= htmlspecialchars($this->input->post('tgl_lhr', true));
		$tp_lhr 	= htmlspecialchars($this->input->post('tp_lhr', true));
		$npwp 		= htmlspecialchars($this->input->post('npwp', true));
		$nik 		= htmlspecialchars($this->input->post('nik', true));

		$noreg0		= $data['alldata']['noreg'];
		$st_peg0 	= $data['alldata']['st_peg'];
		$cab0	 	= $data['alldata']['cab'];
		$tgl_mb0	= $data['alldata']['tgl_mb'];
		$golongan0 	= $data['alldata']['golongan'];
		$phdp0 		= $data['alldata']['phdp'];
		$nskst0		= $data['alldata']['nskst'];

		$noreg 		= htmlspecialchars($this->input->post('noreg', true));
		$st_peg 	= htmlspecialchars($this->input->post('st_peg', true));
		$cab 		= htmlspecialchars($this->input->post('cabang', true));
		$tgl_mb 	= htmlspecialchars($this->input->post('tgl_mb', true));
		$golongan 	= htmlspecialchars($this->input->post('golongan', true));
		$phdp 		= htmlspecialchars($this->input->post('phdp', true));
		$nskst 		= htmlspecialchars($this->input->post('nskst', true));

		$almt0 		= $data['alldata']['almt'];
		$rt_rw0		= $data['alldata']['rt_rw'];
		$kelurahan0	= $data['alldata']['kelurahan'];
		$kecamatan0	= $data['alldata']['kecamatan'];
		$kota0 		= $data['alldata']['kota'];
		$kodepos0 	= $data['alldata']['kodepos'];
		$phone0		= $data['alldata']['phone'];
		$hp0		= $data['alldata']['telphp'];

		$almt 		= htmlspecialchars($this->input->post('almt', true));
		$rt_rw 		= htmlspecialchars($this->input->post('rt_rw', true));
		$kelurahan 	= htmlspecialchars($this->input->post('kelurahan', true));
		$kecamatan 	= htmlspecialchars($this->input->post('kecamatan', true));
		$kota 		= htmlspecialchars($this->input->post('kota', true));
		$kodepos 	= htmlspecialchars($this->input->post('kodepos', true));
		$phone 		= htmlspecialchars($this->input->post('phone', true));
		$hp 		= htmlspecialchars($this->input->post('hp', true));

		$data = array(

			'nama_pes' 		=> $nama,
			'jk' 			=> $jk,
			'tp_lhr' 		=> $tp_lhr,
			'tgl_lhr' 		=> $tgl_lhr,
			'npwp' 			=> $npwp,
			'nik' 			=> $nik,
			'agama' 		=> $agama,

			'st_peg' 		=> $st_peg,
			'cab' 			=> $cab,
			'noreg' 		=> $noreg,
			'tgl_mb' 		=> $tgl_mb,
			'golongan' 		=> $golongan,
			'phdp'			=> $phdp,
			'nskst' 		=> $nskst,

			'almt' 			=> $almt,
			'rt_rw' 		=> $rt_rw,
			'kelurahan' 	=> $kelurahan,
			'kecamatan' 	=> $kecamatan,
			'kota' 			=> $kota,
			'kodepos' 		=> $kodepos,
			'phone' 		=> $phone,
			'telphp' 		=> $hp
		);


		$data0 = array(

			'penyunting' 	=> $penyunting,
			'nama_pes' 		=> $nama0,
			'jk' 			=> $jk0,
			'tp_lhr' 		=> $tp_lhr0,
			'tgl_lhr' 		=> $tgl_lhr0,
			'npwp' 			=> $npwp0,
			'nik' 			=> $nik0,
			'agama' 		=> $agama0,

			'st_peg' 		=> $st_peg0,
			'cab' 			=> $cab0,
			'noreg' 		=> $noreg0,
			'tgl_mb' 		=> $tgl_mb0,
			'golongan' 		=> $golongan0,
			'phdp'			=> $phdp0,
			'nskst' 		=> $nskst0,

			'almt' 			=> $almt0,
			'rt_rw' 		=> $rt_rw0,
			'kelurahan' 	=> $kelurahan0,
			'kecamatan' 	=> $kecamatan0,
			'kota' 			=> $kota0,
			'kodepos' 		=> $kodepos0,
			'phone' 		=> $phone0,
			'telphp' 		=> $hp0,
			'date_created'	=> time()
		);

		$where = array(
			'noreg' => $noreg
		);

		$this->db->insert('backup_dbpam_pa', $data0);



		$this->Peoples_model->update_preview_datapribadi($where, $data);




		$config = [
			'protocol' 	=> 'smtp',
			'smtp_host'	=> 'ssl://dpkbpjamsostek.com',
			'smtp_user'	=> 'admin@dpkbpjamsostek.com',
			'smtp_pass'	=> 'Widya25#09',
			'smtp_port' => 465,
			'mailtype'	=> 'html',
			'charset'	=> 'utf-8',
			'newline'	=> "\r\n"

		];


		$mpdf 		= new \Mpdf\Mpdf();
		ob_start();
		$data['alldata1'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();

		$this->db->order_by('seq', 'DESC');
		$data['backup'] = $this->db->get_where('backup_dbpam_pa', ['noreg' => $npk])->row_array();

		$data['riwayat'] = $this->db->get_where('ahli_waris', ['id' => $npk])->result_array();

		echo $this->load->view('peoples/laporan_pdf_preview', $data, true);
		$html 		= ob_get_contents();
		ob_end_clean();
		$mpdf->WriteHTML(utf8_encode($html));
		$content = $mpdf->Output('', 'S');
		$filename 	= "Perubahan-Data-" . $nama . ".pdf";

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('admin@dpkbpjamsostek.com', 'DPK BP JAMSOSTEK');
		$this->email->to('admin@dpkbpjamsostek.com');
		$this->email->subject('Perubahan Data-' . $nama0);
		$this->email->message($nama0 . ' telah melakukan perubahan data, klik link untuk melihat : <a href="' . base_url() . 'peoples/riwayat/' . $noreg0 . '">Klik Disini Untuk Melihat Perubahan</a>');
		$this->email->attach($content, 'attachment', $filename, 'application/pdf');
		$this->email->send();







		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  			Data Berhasil Disimpan Dalam Data Master!
			</div>');

		if ($role_user == 3) {
			$this->load->view('peoples/back_twice');
		} else {
			redirect('peoples/detail/' . $npk);
		}

		// redirect('peoples/detail/'.$npk);
	}

	public function tambah_ahliwaris($no_id)
	{
		$data['title'] 		= 'Tambah Ahli Waris';
		$data['judul'] = 'Kepesertaan';
		$data['user'] 		= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['alldata'] 	= $this->Peoples_model->getAllDataById($no_id);
		$this->load->model('Peoples_model', 'peoples');

		// $data['ahli_waris'] = $this->Peoples_model->getAhliWarisByNoId($no_id);
		$data['jk'] 				= $this->db->get('jk')->result_array();
		$data['status_keluarga'] 	= $this->db->get('status_keluarga')->result_array();
		$data['status_tanggungan'] 	= $this->db->get('status_tanggungan')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peoples/tambah_ahliwaris', $data);
		$this->load->view('templates/footer');
	}

	public function insert_ahliwaris()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$roleId	= $data['user']['role_id'];

		$id 			= htmlspecialchars($this->input->post('noreg'));
		$nama 			= htmlspecialchars($this->input->post('nama'));
		$jk_aw 			= htmlspecialchars($this->input->post('jk_aw'));
		$stts_kel 		= htmlspecialchars($this->input->post('stts_kel'));
		$stts_tanggn 	= htmlspecialchars($this->input->post('stts_tanggn'));
		$tgl_lhr_aw 	= htmlspecialchars($this->input->post('tgl_lhr_aw'));
		$ket 			= htmlspecialchars($this->input->post('ket'));

		$upload_image = $_FILES['image']['name'];


		if ($upload_image) {

			$namafile = "dok_pendukung_" . $id;
			$config['allowed_types'] = 'jpeg|jpg|png|bmp|pdf';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/dok_pendukung';
			$config['file_name'] = $namafile;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {

				// $old_image = $data['ahli_waris']['dok_pendukung'];
				// if ($old_image != 'default.jpg') {
				// 	unlink(FCPATH . 'assets/img/dok_pendukung/' . $old_image);
				// }

				$new_image = $this->upload->data('file_name');
				$data = array(

					'id' => $id,
					'nama_aw' => $nama,
					'jk_aw' => $jk_aw,
					'stts_kel' => $stts_kel,
					'stts_tanggn' => $stts_tanggn,
					'tgl_lhr_aw' => $tgl_lhr_aw,
					'ket' => $ket,
					'dok_pendukung' => $new_image
				);
				$this->db->insert('ahli_waris', $data);
			} else {
				echo $this->upload->display_errors();
			}
		}

		// $data = array(

		// 	'id' => $id,
		// 	'nama_aw' => $nama,
		// 	'jk_aw' => $jk_aw,
		// 	'stts_kel' => $stts_kel,
		// 	'stts_tanggn' => $stts_tanggn,
		// 	'tgl_lhr_aw' => $tgl_lhr_aw,
		// 	'ket' => $ket
		// );

		// $this->db->insert('ahli_waris', $data);

		$this->load->view('peoples/back_twice');
	}

	public function hapus_ahliwaris($no_id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->where('no_id', $no_id);
		$this->db->delete('ahli_waris');

		$this->load->view('peoples/back');
	}

	public function back_twice()
	{
		$this->load->view('peoples/back_twice');
	}

	public function back()
	{
		$this->load->view('peoples/back');
	}

	public function pdf_preview($npk)
	{
		$this->load->library('dompdf_gen');

		$data['alldata1'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();

		$this->db->order_by('seq', 'DESC');
		$data['backup'] = $this->db->get_where('backup_dbpam_pa', ['noreg' => $npk])->row_array();


		$this->load->view('peoples/laporan_pdf_preview', $data);
		$paper_size  = 'A4';
		$orientation = 'potrait';
		$html 		 = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("LaporanPerubahanData.pdf", array('Attachment' => 0));
	}

	public function mpdf_preview($npk)
	{
		$data['alldata1'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();

		$this->db->order_by('seq', 'DESC');
		$data['backup'] = $this->db->get_where('backup_dbpam_pa', ['noreg' => $npk])->row_array();


		$this->load->view('peoples/back_twice');

		$html = $this->load->view('peoples/laporan_pdf_preview', $data, true);
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output('Perubahan-Data-' . $data['alldata1']['nama_pes'] . '.pdf', \Mpdf\Output\Destination::INLINE);
	}
}
