<?php

header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>

<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<!-- <div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">DAFTAR PAJAK PESERTA PASIF</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive"> -->
<table class="table table-bordered" id="dataTableUser" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NPK</th>
            <th>Nama Peserta</th>
            <th>PTKP</th>
            <th>MP Bruto</th>
            <th>Pajak</th>
            <th>Biaya Jabatan</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($pajak as $p) : ?>
            <tr>
                <th><?= $i++; ?></th>
                <td><?= $p['npk']; ?></td>
                <td><?= $p['nama']; ?></td>
                <td><?php
                    $ci = get_instance();
                    $ci->db->select('ptkp');
                    $ci->db->select_sum('pajak');
                    $ci->db->select_sum('mp');
                    $ci->db->from('pajak');
                    $ci->db->where('npk', $p['npk']);
                    $pjk = $ci->db->get()->row_array();

                    $jabatan        = $pjk['mp'] * 0.05;
                        if ($jabatan > 200000) {
                            $jabatan    = 200000;
                        } else {
                            $jabatan    =  $jabatan;
                        }
                    echo rupiah($pjk['ptkp']); ?></td>
                <td><?= rupiah($pjk['mp']); ?></td>
                <td><?= rupiah($pjk['pajak']); ?></td>
                <td><?= rupiah($jabatan); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- </div>
        </div>
    </div>
</div> -->