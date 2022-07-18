<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\WriterMultiSheetsAbstract;
use Box\Spout\Common\Entity\Row;

class Coba extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Coba_model');
    }



    public function exportimport()
    {
        $data['title']     = 'Export Import';
        $data['judul']  = 'Percobaan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['semuabarang'] = $this->Coba_model->getDataBarang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('coba/exportimport');
        $this->load->view('templates/footer');
    }

    public function uploaddata()
    {
        $config['upload_path'] = './assets/uploads';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();

            $reader->open('assets/uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        $databarang = array(
                            'kode_barang' => $row->getCellAtIndex(1),
                            'nama_barang' => $row->getCellAtIndex(2),
                            'jumlah_barang'       => $row->getCellAtIndex(3),
                            'date_created' => time(),
                            'date_modified' => time(),
                        );
                        $this->Coba_model->import_data($databarang);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('assets/uploads/' . $file['file_name']);
                $this->session->set_flashdata('pesan', 'import data telah Berhasil');
                redirect('coba/exportimport');
            }
        } else {
            echo "Error : " . $this->upload->display_errors();
        };
    }

    public function mpdf()
    {
        $data['semuabarang'] = $this->Coba_model->getDataBarang();
        $tampilan = $this->load->view('coba/mpdf', $data, TRUE);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($tampilan);
        $mpdf->Output();
    }

    public function excel()
    {
        $data['title']  = 'Export Excel';
        $data['judul']  = 'Percobaan';
        $data['semuabarang'] = $this->Coba_model->getDataBarang();

        $this->load->view('coba/excel', $data);
    }

    public function excel2()
    {

        $semuabarang = $this->Coba_model->getDataBarang();

        $customTempFolderPath = 'C:\Users\hp\Downloads';

        // setup Spout Excel Writer, set tipenya xlsx
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->setTempFolder($customTempFolderPath);
        // download to browser
        $writer->openToBrowser('Contoh-Data-Saja.xlsx');


        $writer->getCurrentSheet()->setName('Barang 1');
        $header = [
            WriterEntityFactory::createCell('No'),
            WriterEntityFactory::createCell('Kode Barang'),
            WriterEntityFactory::createCell('Nama Barang'),
            WriterEntityFactory::createCell('Jumlah Barang'),
            WriterEntityFactory::createCell('Tanggal Masuk Barang')
        ];

        $data1 = array();
        $i = 1;

        foreach ($semuabarang as $b) {
            $barang = [
                WriterEntityFactory::createCell($i++),
                WriterEntityFactory::createCell($b['kode_barang']),
                WriterEntityFactory::createCell($b['nama_barang']),
                WriterEntityFactory::createCell($b['jumlah_barang']),
                WriterEntityFactory::createCell(date('d F Y', $b['date_created']))
            ];
            array_push($data1, WriterEntityFactory::createRow($barang));
        }

        $singleRow = WriterEntityFactory::createRow($header);
        $writer->addRow($singleRow); //tambah row untuk header data
        $writer->addRows($data1); //tambah row data


        // $writer->addNewSheetAndMakeItCurrent()->setName('Barang 2'); // Sheet baru
        // $singleRow = WriterEntityFactory::createRow($header);
        // $writer->addRow($singleRow); //tambah row untuk header data
        // $writer->addRows($data1); //tambah row data

        // $writer->addNewSheetAndMakeItCurrent()->setName('Barang 3'); // Sheet baru
        // $singleRow = WriterEntityFactory::createRow($header);
        // $writer->addRow($singleRow); //tambah row untuk header data
        // $writer->addRows($data1); //tambah row data

        // https://opensource.box.com/spout/docs/#new-sheet-creation

        // close writter
        $writer->close();
    }
}
