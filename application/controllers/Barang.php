<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\WriterMultiSheetsAbstract;
use Box\Spout\Common\Entity\Row;

class Barang extends CI_Controller
{

    public function index()
    {
        $data['judul'] = 'Stock Barang';
        $data['title'] = 'List Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];
        $data['barang'] = $this->db->get('barang')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('barang/list', $data);
        $this->load->view('templates/footer');
    }

    public function input_barang()
    {
        $data['judul'] = 'Stock Barang';
        $data['title'] = 'List Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];
        $data['detail'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();

        $nama_brg = $this->input->post('nama_brg');
        $merk_brg = $this->input->post('merk_brg');
        $bts_stock = $this->input->post('bts_stock');
        $stock = $this->input->post('stock');
        $stn_barang = $this->input->post('stn_barang');
        $array = array(
            'nama_brg' => $nama_brg,
            'merk_brg' => $merk_brg,
            'bts_stock' => $bts_stock,
            'stock' => $stock,
            'stn_barang' => $stn_barang
        );

        $this->db->insert('barang', $array);
        redirect('barang/index');
    }

    public function edit_barang()
    {
        $data['judul'] = 'Stock Barang';
        $data['title'] = 'List Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];
        $data['detail'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();

        $id_brg = $this->input->post('id_brg');
        $nama_brg = $this->input->post('nama_brg');
        $merk_brg = $this->input->post('merk_brg');
        $bts_stock = $this->input->post('bts_stock');
        $stock = $this->input->post('stock');
        $stn_barang = $this->input->post('stn_barang');
        $array = array(
            'nama_brg' => $nama_brg,
            'merk_brg' => $merk_brg,
            'bts_stock' => $bts_stock,
            'stock' => $stock,
            'stn_barang' => $stn_barang
        );
        $where = array(
            'id_brg' => $id_brg
        );
        $this->db->where($where);
        $this->db->update('barang', $array);
        redirect('barang/index');
    }

    public function delete_barang($nama_brg)
    {
        $this->db->where('id_brg', $nama_brg);
        $this->db->delete('barang');
        redirect('barang/index');
    }

    //BARANG MASUK

    public function brg_masuk()
    {
        $data['judul'] = 'Stock Barang';
        $data['title'] = 'Barang Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];

        $this->db->select('*');
        $this->db->from('barang');
        $this->db->order_by('nama_brg', 'ASC');
        $data['barang'] = $this->db->get()->result_array();

        // $data['barang'] = $this->db->get('barang')->result_array();
        $data['detail'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();
        $data['barang_masuk'] = $this->db->get('barang_masuk')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('barang/brg_masuk', $data);
        $this->load->view('templates/footer');
    }

    public function barang_masuk()
    {
        $data['judul'] = 'Stock Barang';
        $data['title'] = 'Barang Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];
        $data['detail'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();


        $id_brg = $this->input->post('id_brg');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $jml_brg = $this->input->post('jml_brg');
        $hrg_satuan = $this->input->post('hrg_satuan');
        $array = array(
            'id_brg' => $id_brg,
            'tgl_masuk' => $tgl_masuk,
            'jml_brg' => $jml_brg,
            'hrg_satuan' => $hrg_satuan
        );
        $this->db->insert('barang_masuk', $array);


        $array12 = array(
            'id_brg' => $id_brg
        );

        $data['brg'] = $this->db->get_where('barang', $array12)->row_array();
        $data['brg_msk'] = $this->db->get_where('barang_masuk')->row_array();
        $a = intval($jml_brg);
        $b = intval($data['brg']['stock']);
        $jml = $a + $b;
        // var_dump($b);
        // die();

        $array1 = array(
            'stock' => $jml
        );

        $this->db->where($array12);
        $this->db->update('barang', $array1);

        redirect('barang/brg_masuk');
    }

    public function edit_barang_msk()
    {
        $data['judul'] = 'Stock Barang';
        $data['title'] = 'Barang Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];
        $data['detail'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();

        $id_masuk = $this->input->post('id_masuk');
        $id_brg = $this->input->post('id_brg');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $jml_brg = $this->input->post('jml_brg');

        $array = array(
            'id_brg' => $id_brg,
            'tgl_masuk' => $tgl_masuk,
            'jml_brg' => $jml_brg
        );
        $where = array(
            'id_masuk' => $id_masuk
        );
        $this->db->where($where);
        $this->db->update('barang_masuk', $array);
        redirect('barang/brg_masuk');
    }

    public function delete_barang_msk($id_masuk)
    {

        $id_msk = array(
            'id_masuk' => $id_masuk
        );
        $data['brg_msk'] = $this->db->get_where('barang_masuk', $id_msk)->row_array();

        $id_brg = array(
            'id_brg' => $data['brg_msk']['id_brg']
        );
        $data['brg'] = $this->db->get_where('barang', $id_brg)->row_array();

        $a = intval($data['brg_msk']['jml_brg']);
        $b = intval($data['brg']['stock']);
        $jml = $b - $a;
        // var_dump($jml);
        // die();

        $stock = array(
            'stock' => $jml
        );

        $this->db->where($id_brg);
        $this->db->update('barang', $stock);

        $this->db->where('id_masuk', $id_masuk);
        $this->db->delete('barang_masuk');
        redirect('barang/brg_masuk');
    }

    //BARANG KELUAR
    public function brg_keluar()
    {
        $data['judul'] = 'Stock Barang';
        $data['title'] = 'Barang Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];
        $data['barang'] = $this->db->get('barang')->result_array();
        $data['detail'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();
        $data['barang_keluar'] = $this->db->get('barang_keluar')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('barang/brg_keluar', $data);
        $this->load->view('templates/footer');
    }

    public function barang_keluar()
    {
        $data['judul'] = 'Stock Barang';
        $data['title'] = 'Barang Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];
        $data['detail'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();


        $id_brg = $this->input->post('id_brg');
        $tgl_keluar = $this->input->post('tgl_keluar');
        $pengambil = $this->input->post('pengambil');
        $jml_brg = $this->input->post('jml_brg');
        $array = array(
            'id_brg' => $id_brg,
            'tgl_keluar' => $tgl_keluar,
            'pengambil' => $pengambil,
            'jml_brg' => $jml_brg
        );
        $this->db->insert('barang_keluar', $array);

        $array12 = array(
            'id_brg' => $id_brg
        );

        $data['brg'] = $this->db->get_where('barang', $array12)->row_array();
        $data['brg_msk'] = $this->db->get_where('barang_keluar')->row_array();
        $a = intval($jml_brg);
        $b = intval($data['brg']['stock']);
        $jml = $b - $a;
        // var_dump($b);
        // die();

        $array1 = array(
            'stock' => $jml
        );

        $this->db->where($array12);
        $this->db->update('barang', $array1);

        redirect('barang/brg_keluar');
    }

    public function edit_barang_klr()
    {
        $data['judul'] = 'Stock Barang';
        $data['title'] = 'Barang Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];
        $data['detail'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();

        $id_keluar = $this->input->post('id_keluar');
        $id_brg = $this->input->post('id_brg');
        $tgl_keluar = $this->input->post('tgl_keluar');
        $pengambil = $this->input->post('pengambil');
        $jml_brg = $this->input->post('jml_brg');
        $array = array(
            'id_brg' => $id_brg,
            'tgl_keluar' => $tgl_keluar,
            'pengambil' => $pengambil,
            'jml_brg' => $jml_brg
        );
        $where = array(
            'id_keluar' => $id_keluar
        );
        $this->db->where($where);
        $this->db->update('barang_keluar', $array);
        redirect('barang/brg_keluar');
    }

    public function delete_barang_klr($id_keluar)
    {
        $id_msk = array(
            'id_keluar' => $id_keluar
        );
        $data['brg_keluar'] = $this->db->get_where('barang_keluar', $id_msk)->row_array();

        $id_brg = array(
            'id_brg' => $data['brg_keluar']['id_brg']
        );
        $data['brg'] = $this->db->get_where('barang', $id_brg)->row_array();

        $a = intval($data['brg_keluar']['jml_brg']);
        $b = intval($data['brg']['stock']);
        $jml = $b + $a;
        // var_dump($jml);
        // die();

        $stock = array(
            'stock' => $jml
        );

        $this->db->where($id_brg);
        $this->db->update('barang', $stock);

        $this->db->where('id_keluar', $id_keluar);
        $this->db->delete('barang_keluar');
        redirect('barang/brg_keluar');
    }

    public function excel5()

    {
        //$semuabarang = $this->Coba_model->getDataBarang();
        $this->load->model('Datul_model');
        $allbarang = $this->Datul_model->getBarang();

        //$customTempFolderPath = 'C:\Users\hp\Downloads';

        // setup Spout Excel Writer, set tipenya xlsx

        //$writer->setTempFolder($customTempFolderPath);
        // download to browser
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToBrowser('Barang-Stock.xls');


        $writer->getCurrentSheet()->setName('Daftar Surat');
        $header = [
            WriterEntityFactory::createCell('No'),
            WriterEntityFactory::createCell('Nama Barang'),
            WriterEntityFactory::createCell('Merek'),
            WriterEntityFactory::createCell('Batas Stock'),
            WriterEntityFactory::createCell('Stock')
        ];

        $data1 = array();
        $i = 1;

        foreach ($allbarang as $b) {
            $barang = [
                WriterEntityFactory::createCell($i++),
                WriterEntityFactory::createCell($b['nama_brg']),
                WriterEntityFactory::createCell($b['merk_brg']),
                WriterEntityFactory::createCell($b['bts_stock']),
                WriterEntityFactory::createCell($b['stock'])
            ];
            array_push($data1, WriterEntityFactory::createRow($barang));
        }

        $singleRow = WriterEntityFactory::createRow($header);
        $writer->addRow($singleRow); //tambah row untuk header data
        $writer->addRows($data1); //tambah row data


        $writer->addNewSheetAndMakeItCurrent()->setName('Barang 2'); // Sheet baru
        $singleRow = WriterEntityFactory::createRow($header);
        $writer->addRow($singleRow); //tambah row untuk header data
        $writer->addRows($data1); //tambah row data

        $writer->addNewSheetAndMakeItCurrent()->setName('Barang 3'); // Sheet baru
        $singleRow = WriterEntityFactory::createRow($header);
        $writer->addRow($singleRow); //tambah row untuk header data
        $writer->addRows($data1); //tambah row data

        // https://opensource.box.com/spout/docs/#new-sheet-creation

        // close writter
        $writer->close();
    }
}
