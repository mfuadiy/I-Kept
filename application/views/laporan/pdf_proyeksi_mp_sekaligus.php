<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
</head>

<body style="font-size: 11px; font-family: helvetica;">

    <table>
        <tr>
            <td><b>Lampiran Surat Nomor&emsp;&emsp;&emsp;</b></td>
            <td>:</td>
            <td>DPK-BPJSTK/DK/&emsp;&emsp;/&emsp;&emsp;&emsp;&emsp;/20</td>
        </tr>
        <tr>
            <td><b>Tanggal</b></td>
            <td>:</td>
            <td><?= date('d/m/Y'); ?></td>
        </tr>
        <tr>
            <td><b>Perihal</b></td>
            <td>:</td>
            <td>Pengurusan Pensiun</td>
        </tr>
    </table>
    <br>
    <div style="text-align: center;">
        <b>PROYEKSI PERHITUNGAN MANFAAT PENSIUN</b>
        <hr style="height: 3px; color: black;">
    </div>

    <table>
        <tr>
            <td><b>1.</b></td>
            <td><b>Data Pegawai</b></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; NPK</td>
            <td>=</td>
            <td><?= $npk; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Nama</td>
            <td>=</td>
            <td><?= $nama_pes; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>2.</b></td>
            <td><b>Dasar Perhitungan Manfaat Pensiun :&emsp;&emsp;</b></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; PhDP</td>
            <td>=</td>
            <td><?= $p_phdp; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Tanggal Lahir</td>
            <td>=</td>
            <td><?= date('d/m/Y', strtotime($tgl_lhr)); ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Tanggal Mulai Bekerja</td>
            <td>=</td>
            <td><?= date('d/m/Y', strtotime($tgl_mb)); ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Tanggal Berhenti</td>
            <td>=</td>
            <td><?= date('d/m/Y', strtotime($tgl_brnt)); ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Usia Pensiun</td>
            <td>=</td>
            <td><?= $usia_pensiun; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Status Kawin</td>
            <td>=</td>
            <td><?= $st_kwn; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Masa Bekerja</td>
            <td>=</td>
            <td><?= $p_mk; ?></td>
        </tr>
        <!-- <tr>
			<td></td>
			<td>&emsp;&emsp; Faktor Sekaligus</td>
			<td>=</td>
			<td><?= $fgus; ?></td>
		</tr> -->
        <tr>
            <td></td>
            <td>&emsp;&emsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>3.</b></td>
            <td><b>Perhitungan Manfaat Pensiun(MP)</b></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table>
        <tr>
            <td></td>
            <td>&emsp; <b>3.1 Pilihan Pertama (Bila Manfaat Pensiun Dibayarkan Berkala Penuh)</b></td>
        </tr>
    </table>
    <table>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; Manfaat Pensiun&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;</td>
            <td>=</td>
            <td>
                Nilai Sekarang x Masa Kerja x Faktor Penghargaan x PhDP
            </td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;</td>
            <td>=</td>
            <td>
                <?= $ns; ?> x <?= $s_mk; ?> x 2,50% x <?= $p_phdp; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;</td>
            <td>=</td>
            <td><?= $p_mp; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; PPh Pasal 21</td>
            <td>=</td>
            <td><u><?= $pph21mpber; ?> &emsp;-</u></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; Total Penerimaan MP Berkala</td>
            <td>=</td>
            <td><?= $totpenmp; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;</td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <hr style="height: 2px; color: black;">
    <br><br>
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<b>PENGURUS</b>
    <br><br><br><br><br><br><br>
    &emsp;&emsp;&emsp;&emsp;<b>Yogi Dharmawanto</b><br>
    &emsp;&emsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;Direktur Utama
</body>

</html>