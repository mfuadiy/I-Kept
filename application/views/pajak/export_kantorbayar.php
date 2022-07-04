<?php

header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>

<?php
$ci = get_instance();
$ci->db->select('*');
$ci->db->from('dbpn');
$ci->db->where('p_bln', '07');
$ci->db->where('p_thn', '2022');
$ci->db->group_by('lokgj');
$query = $ci->db->get()->result_array();


?>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Kantor Bayar</th>
            <th>Jumlah Orang</th>
            <th>Jumlah Rupiah</th>
            <th>Selisih</th>
        </tr>

    </thead>

    <tbody>
        <?php $i = 1;
        foreach ($query as $b) : ?>
            <tr>
                <td><?= $b['lokgj']; ?></td>
                <td><?php
                    $kd_bank = $b['lokgj'];
                    $nm_bank = $ci->db->get_where('lokasi_bayar', ['kode_bank' => $kd_bank])->row_array();
                    echo $nm_bank['nama_bank'];

                    ?></td>
                <td><?php

                    $ci->db->select('*');
                    $ci->db->from('dbpn');
                    $ci->db->where('p_bln', '07');
                    $ci->db->where('p_thn', '2022');
                    $ci->db->where('lokgj', $b['lokgj']);
                    echo $ci->db->count_all_results();
                    ?></td>
                <td>
                    <?php
                    $ci->db->select_sum('mp');
                    $ci->db->where('kd_bank', $b['lokgj']);
                    $ci->db->where('p_bln', '07');
                    $ci->db->where('p_thn', '2022');
                    $mp = $ci->db->get('pajak')->row_array();

                    $ci->db->select_sum('pajak');
                    $ci->db->where('kd_bank', $b['lokgj']);
                    $ci->db->where('p_bln', '07');
                    $ci->db->where('p_thn', '2022');
                    $pjk = $ci->db->get('pajak')->row_array();

                    $jml = $mp['mp'] - $pjk['pajak'];
                    echo $jml;
                    ?>
                </td>
                <td>
                    <?php
                    $ci->db->select_sum('pajak_bln');
                    $ci->db->where('lokgj', $b['lokgj']);
                    $ci->db->where('p_bln', '06');
                    $ci->db->where('p_thn', '2022');
                    $pjk_lm = $ci->db->get('dbpn')->row_array();

                    $selisih = $pjk_lm['pajak_bln'] - $pjk['pajak'];
                    echo $selisih;
                    ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>