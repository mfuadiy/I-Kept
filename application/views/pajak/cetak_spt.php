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
            <h3 class="m-0 font-weight-bold text-primary">DAFTAR PAJAK PESERTA PASIF</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableUser" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPK</th>
                            <th>Nama Peserta</th>
                            <th>PTKP</th>
                            <th>MP</th>
                            <th>Pajak</th>
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
                                    $ci->db->select('ptkp, mp');
                                    $ci->db->select_sum('pajak');
                                    $ci->db->from('pajak');
                                    $ci->db->where('npk', $p['npk']);
                                    $pjk = $ci->db->get()->row_array();
                                    echo rupiah($pjk['ptkp']); ?></td>
                                <td><?= rupiah($pjk['mp']); ?></td>
                                <td><?= rupiah($pjk['pajak']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>