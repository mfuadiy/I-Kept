<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

$ptkp = '';
switch ($pensiun['stkwn']) {
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
$jabatan        = $pensiun['pen_bln'] * 0.05;
if ($jabatan > 200000) {
    $jabatan    = 200000;
} else {
    $jabatan    =  $jabatan;
}

$hasil_tahun    = ($pensiun['pen_bln'] - $jabatan) * 12;
//$pkp            = floor(($hasil_tahun - $ptkp) / 1000) * 1000;

$pkp_1          = $hasil_tahun - $ptkp;
$_pkp           = substr($pkp_1, 0, -3) . "000";
$pkp            = intval($_pkp);

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
    $pph21thn     = round(($pph5 + $pph15 + $pph25 + $pph30 + $pph35));
    $pph21bln     = round(($pph5 + $pph15 + $pph25 + $pph30 + $pph35) / 12);
} else {
    $pph21thn     = 0;
    $pph21bln     = 0;
}

?>
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">
                <button type="button" class="btn btn-primary" onclick="window.location.href = 'javascript:window.history.go(-1);';"><a class="fas fa-arrow-circle-left"></a></button>
                Detail Pajak <?= $pensiun['nama']; ?>
            </h3>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= $pensiun['nama'] ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">NPK</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= $pensiun['npk'] ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">NPWP</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= $pensiun['npwp'] ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Status Kawin</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= $pensiun['stkwn'] ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">PTKP</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($ptkp) ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">PKP</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pkp) ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Manfaat Pensiun</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pensiun['pen_bln'])  ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan Satu Tahun</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($hasil_tahun)  ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">PKP</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pkp)  ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">PPh 5%</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pph5)  ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">PPh 15%</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pph15)  ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">PPh 25%</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pph25)  ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">PPh 30%</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pph30)  ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">PPh 35%</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pph35)  ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Jumlah Pajak Terhutang Satu Tahun</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pph21thn)  ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Jumlah Pajak Terhutang Perbulan</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="" name="" value="<?= Rupiah($pph21bln)  ?>" readonly>
                </div>
            </div>

        </div>
    </div>
</div>
</div>