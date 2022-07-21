<?php

header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NPK</th>
            <th>Nama Peserta</th>
            <th>Tanggal Lahir</th>
            <th>PhDP</th>
            <th>Unit Kerja</th>
            <th>Jabatan</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $i = 1;
        foreach ($aktif as $pa) : ?>
            <tr>
                <th><?= $i++; ?></th>
                <td><?= $pa['noreg']; ?></td>
                <td><?= $pa['nama_pes']; ?></td>
                <td><?= $pa['tgl_lhr']; ?></td>
                <td><?= $pa['phdp']; ?></td>
                <td>
                    <?php
                    $ci = get_instance();
                    $result = $ci->db->get_where('cabang', ['cab' => $pa['cab']])->row_array();
                    $cab = $ci->db->get_where('cabang', ['cab' => $pa['cab']]);
                    if ($cab->num_rows() > 0) {
                        echo $result['nama_cab'];
                    } else {
                        echo '-';
                    }

                    ?>
                </td>
                <td><?= $pa['st_peg']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>