<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\WriterMultiSheetsAbstract;
use Box\Spout\Common\Entity\Row;

class Pajak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('Pajak_model', 'pajak');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul']          = 'Perhitungan Pajak';
        $data['title']          = 'Daftar Peserta Pasif';

        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pensiun']        = $this->pajak->getPensiun();
        $data['jenis_pensiun']  = $this->db->get('jenis_pensiun')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pajak/index', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_spt()
    {
        $data['judul']          = 'Perhitungan Pajak';
        $data['title']          = 'Cetak SPT I';

        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pajak']          = $this->pajak->getPajak();

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('pajak/cetak_spt', $data);
        // $this->load->view('templates/footer');
    }

    public function detail($npk)
    {
        $data['judul']          = 'Perhitungan Pajak';
        $data['title']          = 'Daftar Peserta Pasif';
        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pensiun']        = $this->pajak->getDetail($npk);
        $data['jenis_pensiun']  = $this->db->get('jenis_pensiun')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pajak/detail', $data);
        $this->load->view('templates/footer');
    }


    public function export()
    {

        $data['title']      = 'Rekap Pajak';
        $data['pensiun']    = $this->pajak->getPensiun();

        $this->load->view('laporan/export_pajak', $data);
    }

    public function analisa()
    {

        $data['title']      = 'Analisa Peserta';
        $data['pensiun']    = $this->pajak->getAnalytic();

        $this->load->view('laporan/analisa', $data);
    }

    public function kantor_bayar()
    {

        $data['title']      = 'Rekap Kantor Bayar';
        $data['bank']       = $this->pajak->getBank();

        $this->load->view('laporan/export_kantorbayar', $data);
    }
}
