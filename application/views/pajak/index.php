<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">DAFTAR PESERTA PASIF BULAN</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="<?= base_url('pajak/export'); ?>" class="btn btn-success">Export Data Excel</a>
                <a href="<?= base_url('pajak/kantor_bayar'); ?>" class="btn btn-success">Export Rekap Kantor Bayar</a>
                <a href="<?= base_url('pajak/analisa'); ?>" class="btn btn-danger">Analisa</a>
                <br><br>

                <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPK</th>
                            <th>Nomor Pensiun</th>
                            <th>Nama Peserta</th>
                            <th>Bank Bayar</th>
                            <th>Nama Bank</th>
                            <th>Atas Nama Bank</th>
                            <th>Jenis Pensiun</th>
                            <th>Manfaat Pensiun Lama</th>
                            <th>Manfaat Pensiun Baru</th>
                            <th>Pajak Lama</th>
                            <th>Pajak Baru</th>
                            <th>Selisih</th>
                            <th>Status Kawin</th>
                            <th>PTKP</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($pensiun as $p) : ?>
                            <tr>
                                <th><?= $i++; ?></th>
                                <td><?= $p['npk']; ?></td>
                                <td><?= $p['nopen']; ?></td>
                                <td><?= $p['nama']; ?></td>
                                <td><?= strval($p['lokgj']); ?></td>
                                <td><?php
                                    $ci = get_instance();
                                    $kd_bank = $p['lokgj'];
                                    $nm_bank = $ci->db->get_where('lokasi_bayar', ['kode_bank' => $kd_bank])->row_array();
                                    echo $nm_bank['nama_bank'];
                                    ?></td>
                                <td><?= $p['an_bank']; ?></td>
                                <td>
                                    <?php
                                    $ci = get_instance();
                                    $tjp = $p['stppp'];


                                    $hjp = $ci->db->get_where('jenis_pensiun', ['stppp' => $tjp])->row_array();
                                    ?>
                                    <?= $hjp['desk1'] . "-" . $hjp['desk2']; ?>
                                </td>
                                <td><?php
                                    $mp = intval($p['pen_bln']);
                                    $mp_lama = round(($mp / 0.02) / 51);
                                    echo Rupiah($mp_lama);
                                    ?>
                                </td>

                                <td><?php
                                    $mp = intval($p['pen_bln']);
                                    $mp_naik = $mp;
                                    echo Rupiah($mp_naik);
                                    ?>
                                </td>

                                <?php

                                $s = $p['stkwn'];

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
                                        $s = "TK";
                                        break;
                                    case 'J0':
                                        $s = "TK";
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

                                $ptkp = '';
                                switch ($p['stkwn']) {
                                    case 'TK':
                                        $ptkp = 54000000;
                                        break;
                                    case 'T3':
                                        $ptkp = 67500000;
                                        break;
                                    case 'T2':
                                        $ptkp = 63000000;
                                        break;
                                    case 'T1':
                                        $ptkp = 58500000;
                                        break;
                                    case 'J6':
                                        $ptkp = 67500000;
                                        break;
                                    case 'J5':
                                        $ptkp = 67500000;
                                        break;
                                    case 'J4':
                                        $ptkp = 67500000;
                                        break;
                                    case 'J3':
                                        $ptkp = 67500000;
                                        break;
                                    case 'J2':
                                        $ptkp = 63000000;
                                        break;
                                    case 'J1':
                                        $ptkp = 58500000;
                                        break;
                                    case 'J0':
                                        $ptkp = 54000000;
                                        break;
                                    case 'D6':
                                        $ptkp = 67500000;
                                        break;
                                    case 'D5':
                                        $ptkp = 67500000;
                                        break;
                                    case 'D4':
                                        $ptkp = 67500000;
                                        break;
                                    case 'D3':
                                        $ptkp = 67500000;
                                        break;
                                    case 'D2':
                                        $ptkp = 63000000;
                                        break;
                                    case 'D1':
                                        $ptkp = 58500000;
                                        break;
                                    case 'D0':
                                        $ptkp = 54000000;
                                        break;
                                    case '0':
                                        $ptkp = 54000000;
                                        break;
                                    case 'K0':
                                        $ptkp = 58500000;
                                        break;
                                    case 'K1':
                                        $ptkp = 63000000;
                                        break;
                                    case 'K2':
                                        $ptkp = 67500000;
                                        break;
                                    case 'K3':
                                        $ptkp = 72000000;
                                        break;
                                    case 'K4':
                                        $ptkp = 72000000;
                                        break;
                                    case 'K5':
                                        $ptkp = 72000000;
                                        break;
                                    case 'K6':
                                        $ptkp = 72000000;
                                        break;
                                    case 'K7':
                                        $ptkp = 72000000;
                                        break;
                                    case 'K8':
                                        $ptkp = 72000000;
                                        break;
                                    case 'K9':
                                        $ptkp = 72000000;
                                        break;
                                    case 'K10':
                                        $ptkp = 72000000;
                                        break;
                                    default:
                                        $ptkp = 54000000;
                                        break;
                                }
                                $jabatan        = $mp_naik * 0.05;
                                if ($jabatan > 200000) {
                                    $jabatan    = 200000;
                                } else {
                                    $jabatan    =  $jabatan;
                                }

                                $hasil_tahun    = ($mp_naik - $jabatan) * 12;
                                $pkp            = floor(($hasil_tahun - $ptkp) / 1000) * 1000;

                                $pph5           = 60000000 * 0.05;
                                $pph15          = 190000000 * 0.15;
                                $pph25          = 250000000 * 0.25;
                                $pph30          = 4500000000 * 0.30;
                                $pph35          = ($pkp - 5000000000) * 0.35;

                                if ($pkp > 0 && $pkp < 60000000) {
                                    $pph5 = $pkp * 0.05;
                                } else if ($pkp > 60000000) {
                                    $pph5 = $pph5;
                                } else {
                                    $pph5 = 0;
                                }

                                if ($pkp > 60000000 && $pkp < 250000000) {
                                    $pph15 = ($pkp - 60000000) * 0.15;
                                } else if ($pkp > 250000000) {
                                    $pph15 = $pph15;
                                } else {
                                    $pph15 = 0;
                                }

                                if ($pkp > 250000000 && $pkp < 500000000) {
                                    $pph25 = ($pkp - 250000000) * 0.25;
                                } else if ($pkp > 500000000) {
                                    $pph25 = $pph25;
                                } else {
                                    $pph25 = 0;
                                }

                                if ($pkp > 500000000 && $pkp < 5000000000) {
                                    $pph30 = ($pkp - 500000000) * 0.25;
                                } else if ($pkp > 5000000000) {
                                    $pph30 = $pph30;
                                } else {
                                    $pph30 = 0;
                                }

                                if ($pkp > 5000000000) {
                                    $pph35 = $pph35;
                                } else {
                                    $pph35 = 0;
                                }

                                if ($pkp > 0) {
                                    $pph21thn     = round(($pph5 + $pph15 + $pph25 + $pph30 + $pph35) / 12);
                                } else {
                                    $pph21thn     = 0;
                                }

                                $selisih = $p['pajak_bln'] - $pph21thn;

                                ?>
                                <td><?= Rupiah($p['pajak_bln']); ?></td>
                                <td><?= Rupiah($pph21thn); ?></td>
                                <td><?= Rupiah($selisih); ?></td>
                                <td><?= $p['stkwn']; ?></td>
                                <td><?= Rupiah($ptkp); ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= base_url(); ?>pajak/detail/<?= $p['npk']; ?>" class="badge badge-warning">Detail Pajak</a>
                                    <!-- <a href="<?= base_url(); ?>mutasi/data_mutasi/<?= $p['npk']; ?>" class="badge badge-danger">mutasi</a>
                                    <a href="<?= base_url(); ?>peoples/detail_peserta_simulasi/<?= $p['npk']; ?>" class="badge badge-success">Hitung Proyeksi</a> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>