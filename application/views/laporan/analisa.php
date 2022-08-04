<?php

header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>



<table border="1" width="100%">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th colspan="6">Data Peserta</th>
            <th colspan="2">Data Peserta</th>
        </tr>
        <tr>
            <th>NPK</th>
            <th>Nomor Pensiun</th>
            <th>Nama Peserta</th>
            <th>Tanggal Lahir</th>
            <th>Usia</th>
            <th>NIK</th>
            <th>Nama Ahli Waris</th>
            <th>Jenis Kelamin Ahli Waris</th>
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
                <td><?= $p['tglhr']; ?></td>
                <td><?php
                    $now        = new DateTime();
                    $lhr        = new DateTime($p['tglhr']);
                    $intervallhr = "";
                    $intervallhr = date_diff($lhr, $now);
                    echo $intervallhr->y;
                    ?></td>
                <td><?= "'" . $p['nik']; ?></td>
                <?php
                $ci = get_instance();
                $ahliWaris = $ci->db->get_where('aw_pn', ['npk' => $p['npk']])->result_array();
                ?>
                <td>
                    <?php foreach ($ahliWaris as $aw) : ?>
                        <?= $aw['nama']; ?><br>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?php foreach ($ahliWaris as $aw) : ?>
                        <?= $aw['jk_aw']; ?><br>
                    <?php endforeach; ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>