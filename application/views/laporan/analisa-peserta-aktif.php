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
            <th>Tanggal Wafat</th>
            <th>Nama Keluarga</th>
            <th>Tanggal Lahir Keluarga</th>
            <th>Status Keluarga</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $i = 1;
        foreach ($aktif as $pa) : ?>
            <tr>
                <th><?= $i++; ?></th>
                <td><?= $pa['npk']; ?></td>
                <td><?= $pa['nama']; ?></td>
                <td><?= $pa['tglhr']; ?></td>
                <td><?= $pa['tgl_wafat']; ?></td>
                <td>
                    <?php
                    $query = $this->db->get_where('aw_pn', ['npk' => $pa['npk']])->result_array();

                    ?>

                    <?php foreach ($query as $q) : ?>
                        <?= $q['nama']; ?> <br>
                    <?php endforeach; ?>

                </td>
                <td><?php foreach ($query as $q) : ?>
                        <?= $q['tgl_lhr_aw']; ?> <br>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?php foreach ($query as $q) : ?>
                        <?php
                        if ($q['st_kel'] == "0") {
                            echo ("Peserta");
                        } elseif ($q['st_kel'] == "1") {
                            echo ("Suami/Istri");
                        } elseif ($q['st_kel'] == "2") {
                            echo ("Anak");
                        } elseif ($q['st_kel'] == "3") {
                            echo ("Orang Tua");
                        } elseif ($q['st_kel'] == "4") {
                            echo ("Pihak Ditunjuk");
                        } else {
                            echo ("");
                        }
                        ?> <br>
                    <?php endforeach; ?>
                </td>
                <td><?php foreach ($query as $q) : ?>
                        <?= $q['ket']; ?> <br>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>