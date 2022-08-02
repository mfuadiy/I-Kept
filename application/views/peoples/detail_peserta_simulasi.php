<?php


// Post
$henti 		= @$_POST['tgl_brnt'];
$mulai 		= @$_POST['tgl_mb'];
$ns 		= @$_POST['ns'];
$naik       = @$_POST['naik'];
$persen20   = @$_POST['persen20'];
$st_kwn     = @$_POST['st_kwn'];
$mkth_diakui = @$_POST['mkth_diakui'];
$mkbl_diakui = @$_POST['mkbl_diakui'];
$phdp 		= @$_POST['phdp'];
$setor     	= intval(@$_POST['setor']);
$penghasilan = intval(@$_POST['penghasilan']);

// Deklarasi
$mp 		= "";
$x 			= 0;
$p_henti	= date('Y-m-d', strtotime('+ ' . $mkth_diakui . ' year + ' . $mkbl_diakui . ' month', strtotime($henti)));
$brnt 		= new DateTime($p_henti);
$mli		= new DateTime($mulai);

// Perhitungan Proyeksi Pensiun
$lhr 	= $alldata['tgl_lhr'];
$th1965 = date('1965-01-01');
$th1968 = date('1968-01-01');
$th1971 = date('1971-01-01');
if ($lhr >= $th1965 && $lhr <= $th1968) {
	$pensiun = date('Y/m/d', strtotime('+58 year', strtotime($lhr)));
} else if ($lhr >= $th1968 && $lhr <= $th1971) {
	$pensiun = date('Y/m/d', strtotime('+59 year', strtotime($lhr)));
} else if ($lhr >= $th1971) {
	$pensiun = date('Y/m/d', strtotime('+60 year', strtotime($lhr)));
} else if ($lhr <= $th1965) {
	$pensiun = date('Y/m/d', strtotime('+57 year', strtotime($lhr)));
}

// Deklarasi Perhitungan Proyeksi Sisa Masa Bekerja
$pensi 		= new DateTime($pensiun);
$now		= new DateTime();
$sisaMb		= date_diff($pensi, $now);
$sisaMbTh 	= $sisaMb->y;

// Deklarasi untuk codeigneter
$ci 		= get_instance();
$mbk		= new DateTime($alldata['tgl_lhr']);
$now		= new DateTime($henti);
$valkrj		= date_diff($mbk, $now);
$lamakrj	= ($valkrj->y + $mkth_diakui) + round((($valkrj->m + $mkbl_diakui + 1) / 12), 2);
$t 			= $valkrj->y;
$b 			= $valkrj->m;
$s 			= $st_kwn;
$ptkp 		= 0;

// Penentuan Status Pajak
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
		$s = "TK0";
		break;
	case 'TK0':
		$s = "TK0";
		break;
	case 'J0':
		$s = "TK0";
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

// Penentuan PTKP
switch ($st_kwn) {
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


// Menentukan Umur Tahun Bulan dan Status Kawin Untuk Penentuan Faktor Sekaligus
$where = array(
	'umr_th' 	=> $t,
	'umr_bln' 	=> $b,
	'stkwn'		=> $s
);

// Kode Codeigneter Untuk Mencari Faktor Sekaligus
$result 	= $ci->db->get_where('aktuaria', $where)->row_array();
$fgus 		= floatval($result['fktr_sgus']);

// Perhitungan Masa Kerja
$intervalmk = date_diff($mli, $brnt);
$mk			= $intervalmk->y + round((($intervalmk->m) / 12), 2);

// Perhitungan Manfaat Pensiun
if (isset($_POST['hitung'])) {

	if (isset($naik)) {
		do {
			$x++;
			$phdp = ($phdp * 1.04);
		} while ($x < $sisaMbTh);

		$cutmp		= $phdp * 0.8;
		$temp		= $mk * $ns * 0.025 * $phdp;

		if ($temp > $cutmp) {
			$mp = $cutmp;
		} else {
			$mp = $temp;
		}
	} else {
		$cutmp		= $phdp * 0.8;
		$temp		= $mk * $ns * 0.025 * $phdp;

		if ($temp > $cutmp) {
			$mp = $cutmp;
		} else {
			$mp = $temp;
		}
	}

	// Perhitungan MP Sekaligus, MP Sekaligus 20% sampai dengan MP berkala 80%
	$mpsek 		= $mp * $fgus;
	$mpsek20	= $mpsek * 0.2;
	$sek2050 	= round(($mpsek20 - 50000000), -2); // PTKP Pajak Final

	// Perhitungan Pajak Final MP Sekaligus
	$mpsek2050  = 0;
	if ($sek2050 < 0) {
		$mpsek2050  = 0;
	} else {
		$mpsek2050 = $sek2050;
	}
	$sek2120	= round(($sek2050  * 0.05), -2);
	$pph2120	= 0;
	if ($sek2120 < 0) {
		$pph2120	= 0;
	} else {
		$pph2120 = $sek2120;
	}

	// Perihutngan MP 80% Jika Mengambil MP Sekaligus 20%
	$mp80 		= $mp * 0.8;
	$bp 		= 0; //Biaya Jabatan
	if (isset($persen20)) {
		if ($mp80 < 4000000) {
			$bp = $mp80 * 0.05;
		} else {
			$bp = 200000;
		}
	} else {
		if ($mp < 4000000) {
			$bp = $mp * 0.05;
		} else {
			$bp = 200000;
		}
	}

	// Perhitungan Sisa Bulan Pajak
	$bln 		= date('m', strtotime($henti));
	$p_bln      = intval($bln);
	$sisabln	= 13 - $p_bln;
	if ($penghasilan == 0) {
		$sisabln = 12;
	} else {
		$sisabln = $sisabln;
	}

	// Perhitungan Penentuan Penghasilan Netto 1 Tahun
	$mpnetto	= "";
	if (isset($persen20)) {
		$mpnetto	= ($mp80 - $bp) * $sisabln;
	} else {
		$mpnetto	= ($mp - $bp) * $sisabln;
	}
	$hasil_tahun 	= $mpnetto + $penghasilan;

	// Perhitungan Penetuan PKP
	$p_pkp_1 		= round($hasil_tahun - $ptkp);
	$_p_pkp 		= substr($p_pkp_1, 0, -3) . "000";
	$p_pkp 			= intval($_p_pkp);
	if ($p_pkp < 0) {
		$pkp = 0;
	} else {
		$pkp = $p_pkp;
	}
	$pkp_1 		= round($hasil_tahun - $ptkp);
	$_pkp = substr($pkp_1, 0, -3) . "000";
	$pkp = intval($_pkp);

	// Klasifikasi Pajak Progresif
	$pph5 		= 60000000 * 0.05;
	$pph15 		= 190000000 * 0.15;
	$pph25 		= 250000000 * 0.25;
	$pph30      = 4500000000 * 0.30;
	$pph35      = ($pkp - 5000000000) * 0.35;

	// Perhitungan Pajak Progresif

	// PPh 5%
	if ($pkp > 0 && $pkp < 60000000) {
		$pph5 = $pkp * 0.05;
	} else if ($pkp > 60000000) {
		$pph5 = $pph5;
	} else {
		$pph5 = 0;
	}

	// PPh 15%
	if ($pkp > 60000000 && $pkp < 250000000) {
		$pph15 = ($pkp - 60000000) * 0.15;
	} else if ($pkp > 250000000) {
		$pph15 = $pph15;
	} else {
		$pph15 = 0;
	}

	// PPh 25%
	if ($pkp > 250000000 && $pkp < 500000000) {
		$pph25 = ($pkp - 250000000) * 0.25;
	} else if ($pkp > 250000000) {
		$pph25 = $pph25;
	} else {
		$pph25 = 0;
	}

	// PPh 30%
	if ($pkp > 500000000 && $pkp < 5000000000) {
		$pph30 = ($pkp - 500000000) * 0.30;
	} else if ($pkp > 5000000000) {
		$pph30 = $pph30;
	} else {
		$pph30 = 0;
	}

	// PPh 35%
	if ($pkp > 5000000000) {
		$pph35 = $pph35;
	} else {
		$pph35 = 0;
	}

	// PPh 21 Per Tahun
	$pph21thn 	= $pph5 + $pph15 + $pph25 + $pph30 + $pph35;

	// Total Pajak Perbulan
	$pph21mpber	= ($pph21thn - $setor) / $sisabln; //PPh 21 MP Berkala

	// Total Penerimaan MP Berkala
	$totpenmp 	= "";
	if (isset($_POST['persen20'])) {
		$totpenmp 	= $mp80 - $pph21mpber;
	} else {
		$totpenmp 	= $mp - $pph21mpber;
	}
	$totalmp_pajak = ((($mp - $bp) * 12) - $ptkp);
	$totpenmp80 = $mp80 - $pph21mpber;
}

function rupiah($angka)
{

	$hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
	return $hasil_rupiah;
}
$gaji 	= $alldata['phdp'];
$hasil 	= $gaji;
$sisaMsBk = $sisaMb->y;

?>

<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">

			<div class="card">
				<div class="card-header">
					Proyeksi Manfaat Pensiun
				</div>
				<div class="card-body">



					<!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  					<li class="nav-item">
    					<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Data Pribadi</a>
  					</li>
			  		<li class="nav-item">
			    		<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pekerjaan</a>
			  		</li>
			  		<li class="nav-item">
			    		<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Alamat</a>
			  		</li>
			  		<li class="nav-item">
			    		<a class="nav-link" id="pills-keluarga-tab" data-toggle="pill" href="#pills-keluarga" role="tab" aria-controls="pills-keluarga" aria-selected="false">Data Keluarga</a>
			  		</li>
			  		<li class="nav-item">
			    		<a class="nav-link" id="pills-pensiun-tab" data-toggle="pill" href="#pills-pensiun" role="tab" aria-controls="pills-pensiun" aria-selected="false">Simulasi Manfaat Pensiun</a>
			  		</li>
			  	</ul> -->

					<!-- <nav class="nav nav-pills nav-justified mb-4">
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_peserta/<?= $alldata['noreg']; ?>">Data Pribadi</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_peserta_pekerjaan/<?= $alldata['noreg']; ?>">Pekerjaan</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_peserta_alamat/<?= $alldata['noreg']; ?>">Alamat</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_peserta_keluarga/<?= $alldata['noreg']; ?>">Data Keluarga</a>
				  <a class="nav-link active" href="#">Simulasi Pensiun</a>
				</nav> -->


					<div class="tab-content" id="pills-tabContent">
						<!--DATA PRIBADI-->

						<!--PEKERJAAN-->

						<!--ALAMAT-->

						<!--DATA KELUARGA-->

						<!--MANFAAT PENSIUN-->
						<div class="tab-pane fade show active" id="pills-pensiun" role="tabpanel" aria-labelledby="pills-pensiun-tab">
							<!-- Variabel Perhitungan Proyeksi -->


							<form method="post" action="">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="nama_pes" id="nama_pes" value="<?= $alldata['nama_pes'] ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">NPK</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="noreg" id="noreg" value="<?= $alldata['noreg'] ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Perkiraan Pensiun</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_pensiun" id="p_pensiun" value="<?php echo date("01/m/Y", strtotime($pensiun)); ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Perkiraan Masa Bekerja</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_mk" id="p_mk" value="<?php
																												$pensN		= new DateTime($pensiun);
																												$mbk		= new DateTime($alldata['tgl_mb']);
																												$intervalkrj = date_diff($mbk, $pensN);
																												$lamakerja	= $intervalkrj->y + round((($intervalkrj->m + 1) / 12), 2);
																												//var_dump($lamakerja);
																												echo $intervalkrj->y . ' Tahun ';
																												echo $intervalkrj->m . ' Bulan ';
																												//echo $intervalkrj->d.' hari.';
																												?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Usia</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="usia" id="usia" value="<?php
																												$pensN		= new DateTime($pensiun);
																												$lhr		= new DateTime($alldata['tgl_lhr']);
																												$now		= new DateTime();
																												$intervallhr = "";
																												if (isset($_POST['hitung'])) {
																													$intervallhr = date_diff($lhr, $brnt);
																												} else {
																													$intervallhr = date_diff($lhr, $now);
																												}
																												//$intervallhr= date_diff($lhr, $now);

																												$usia	= $intervallhr->y + round((($intervallhr->m + 1) / 12), 2);
																												//var_dump($lamakerja);
																												echo $intervallhr->y . ' Tahun ';
																												echo $intervallhr->m . ' Bulan ';
																												//echo $intervalkrj->d.' hari.';
																												?>" readonly>
									</div>
								</div>


								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Sisa Masa Bekerja</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="s_mk" id="s_mk" value="<?php

																												$sisaMb		= date_diff($pensN, $now);
																												//$lamakerja	= $interval->y + round((($interval->m)/12),2);
																												//var_dump($lamakerja);
																												echo $sisaMb->y . ' tahun ';
																												echo $sisaMb->m . ' bulan ';
																												//echo $intervallhr->d.' hari.';

																												?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Lahir</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" name="tgl_lhr" id="tgl_lhr" value="<?= $alldata['tgl_lhr'] ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Mulai Kerja</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" name="tgl_mb" id="tgl_mb" value="<?= $alldata['tgl_mb'] ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Berhenti</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" name="tgl_brnt" id="tgl_brnt" value="<?= @$_POST['tgl_brnt']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Masa Kerja Diakui</label>
									<div class="col-sm-8">
										<div class="form-row">
											<div class="col">
												<input type="number" class="form-control" name="mkth_diakui" id="mkth_diakui" value="<?php if (isset($_POST['hitung'])) {
																																			echo $mkth_diakui;
																																		} else {
																																			echo "0";
																																		}  ?>">
											</div>
											<div class="col col-form-label">
												<label>Tahun</label>
											</div>
											<div class="col">
												<input type="number" class="form-control" name="mkbl_diakui" id="mkbl_diakui" value="<?php if (isset($_POST['hitung'])) {
																																			echo $mkbl_diakui;
																																		} else {
																																			echo "0";
																																		}  ?>">
											</div>
											<div class="col col-form-label">
												<label>Bulan</label>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PhDP Saat Ini
									</label>
									<div class="col-sm-8">
										<input type="number" class="form-control" name="phdp" id="phdp" value="<?php if (isset($_POST['hitung'])) {
																													echo $phdp;
																												} else {
																													echo $gaji;
																												}
																												?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Status Kawin</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="st_kwn" id="st_kwn" value="<?php if (isset($_POST['hitung'])) {
																														echo $st_kwn;
																													} else {
																														echo $alldata['st_kwn'];
																													}
																													?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Faktor Sekaligus</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="fgus" id="fgus" value="<?php

																												if (isset($_POST['hitung'])) {
																													echo $fgus;
																												} else {
																													echo $akt['fktr_sgus'];
																												}
																												//$akt['fktr_sgus'];
																												?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Nilai Sekarang</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="ns" id="ns" value="<?php if (isset($_POST['hitung'])) {
																												echo @$_POST['ns'];
																											} else {
																												echo "1";
																											} ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Asumsi Kenaikan 4%</label>
									<div class="col-sm-8">
										<input type="checkbox" class="form-control" name="naik" id="naik" value="checked" <?= @$_POST['naik']; ?>>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">MP Sekaligus 20%</label>
									<div class="col-sm-8">
										<input type="checkbox" class="form-control" name="persen20" id="persen20" value="checked" <?= @$_POST['persen20']; ?>>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan Sebelumnya</label>
									<div class="col-sm-8">
										<input type="number" class="form-control" name="penghasilan" id="penghasilan" value="<?php if (isset($_POST['hitung'])) {
																																	echo @$_POST['penghasilan'];
																																} else {
																																	echo "0";
																																} ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Pajak Yang Sudah Disetorkan</label>
									<div class="col-sm-8">
										<input type="number" class="form-control" name="setor" id="setor" value="<?php if (isset($_POST['hitung'])) {
																														echo @$_POST['setor'];
																													} else {
																														echo "0";
																													} ?>">
									</div>
								</div>

								<button type="submit" class="btn btn-success mt-2 mb-4" id="hitung" name="hitung">Hitung</button>
							</form>




















							<!-- Tampilan Perhitungan Proyeks -->
							<form method="post" action="<?php
														if (isset($_POST['persen20'])) {
															echo base_url(); ?>laporan/pdf_proyeksi_mp/<?= $alldata['noreg'];
																									} else {
																										echo base_url(); ?>laporan/pdf_proyeksi_mp_sekaligus/<?= $alldata['noreg'];
																																							}

																																								?>" target="_blank">
								<!-- Data Hidden -->
								<div hidden>
									<input type="text" class="form-control" name="nama_pes" id="nama_pes" value="<?= $alldata['nama_pes'] ?>">
									<input type="text" class="form-control" name="noreg" id="noreg" value="<?= $alldata['noreg'] ?>">
									<input type="text" class="form-control" name="p_pensiun" id="p_pensiun" value="<?php echo date("01/m/Y", strtotime($pensiun)); ?>">


									<input type="text" class="form-control" name="usia" id="usia" value="<?php
																											$pensN		= new DateTime($pensiun);
																											$lhr		= new DateTime($alldata['tgl_lhr']);
																											$now		= new DateTime();
																											$intervallhr = date_diff($lhr, $now);
																											$usia	= $intervallhr->y + round((($intervallhr->m + 1) / 12), 2);
																											//var_dump($lamakerja);
																											echo $intervallhr->y . ' Tahun ';
																											echo $intervallhr->m . ' Bulan ';
																											//echo $intervalkrj->d.' hari.';
																											?>">
									<input type="text" class="form-control" name="s_mk" id="s_mk" value="<?= $mk; 	?>" hidden>
									<input type="date" class="form-control" name="tgl_lhr" id="tgl_lhr" value="<?= $alldata['tgl_lhr'] ?>">
									<input type="date" class="form-control" name="tgl_mb" id="tgl_mb" value="<?= $alldata['tgl_mb'] ?>">
									<input type="date" class="form-control" name="tgl_brnt" id="tgl_brnt" value="<?= @$_POST['tgl_brnt']; ?>">
									<input type="text" class="form-control" name="phdp" id="phdp" value="<?php
																											$gaji 	= $alldata['phdp'];
																											$hasil 	= $gaji;
																											$sisaMsBk = $sisaMb->y;
																											echo rupiah($gaji); ?>">
									<input type="text" class="form-control" name="st_kwn" id="st_kwn" value="<?= $st_kwn; ?>">
									<input type="text" class="form-control" name="p_mpsek2050" id="p_mpsek2050" value="<?php if (isset($_POST['hitung'])) {
																															echo rupiah($mpsek2050);
																														} else {
																															echo "1";
																														} ?>">
									<input type="text" class="form-control" name="totpenmp80" id="totpenmp80" value="<?php if (isset($_POST['hitung'])) {
																															echo rupiah($totpenmp80);
																														} else {
																															echo "1";
																														} ?>">
									<input type="text" class="form-control" name="par20" id="par20" value="<?php if (isset($_POST['persen20'])) {
																												echo "1";
																											} else {
																												echo "0";
																											} ?>">
									<input type="text" class="form-control" name="fgus" id="fgus" value="<?= $fgus; ?>" hidden>
									<input type="text" class="form-control" name="ns" id="ns" value="<?php if (isset($_POST['hitung'])) {
																											echo @$_POST['ns'];
																										} else {
																											echo "1";
																										} ?>" required>

								</div>
								<!-- Akhir Data Hidden -->










								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Proyeksi PhDP <br><br></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_phdp" id="p_phdp" value="<?php error_reporting(0);
																													echo rupiah($phdp); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Usia Pensiun<br><br></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="usia_pensiun" id="usia_pensiun" value="<?php echo $t . ' tahun ' . $b . ' bulan'; ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Masa Bekerja<br><br></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_mk" id="p_mk" value="<?php

																												$lamakerja	= $intervalmk->y + round((($intervalmk->m + 1) / 12), 2);

																												echo ($intervalmk->y) . ' Tahun ';
																												echo $intervalmk->m . ' Bulan ';

																												?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Proyeksi Manfaat Pensiun <br>
										<small style="color: blue;"><?= rupiah($phdp); ?> x 2.5% x <?= $mk; ?> x <?= $ns; ?></small></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_mp" id="p_mp" value="<?php error_reporting(0);
																												echo rupiah($mp); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Proyeksi Nilai Sekarang Manfaat Pensiun <br>
										<small style="color: blue;"><?= $fgus; ?> x <?= rupiah($mp); ?></small></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_mpsek" id="p_mpsek" value="<?php error_reporting(0);
																													echo rupiah($mpsek); ?>">
									</div>
								</div>

								<div class="form-group row" <?php if (isset($_POST['persen20'])) {
																echo "";
															} else {
																echo "hidden";
															} ?>>
									<label for="inputEmail3" class="col-sm-4 col-form-label">Proyeksi MP Sekaligus 20% <br>
										<small style="color: blue;"><?= rupiah($mpsek); ?> x 20%</small></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_mpsek20" id="p_mpsek20" value="<?php error_reporting(0);
																														echo rupiah($mpsek20); ?>">
									</div>
								</div>

								<div class="form-group row" <?php if (isset($_POST['persen20'])) {
																echo "";
															} else {
																echo "hidden";
															} ?>>
									<label for="inputEmail3" class="col-sm-4 col-form-label">PPh 21 MP Sekaligus 20% <br>
										<small style="color: blue;"><?= rupiah($mpsek20); ?> x 5%</small></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_pph2120" id="p_pph2120" value="<?php error_reporting(0);
																														echo rupiah($pph2120); ?>">
									</div>
								</div>

								<div class="form-group row" <?php if (isset($_POST['persen20'])) {
																echo "";
															} else {
																echo "hidden";
															} ?>>
									<label for="inputEmail3" class="col-sm-4 col-form-label">Penerimaan MP Sekaligus 20% <br>
										<small style="color: blue;"><?= rupiah($mpsek20) . " - " . rupiah($pph2120); ?></small></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_mp20" id="p_mp20" value="<?php error_reporting(0);
																													echo rupiah($mpsek20 - $pph2120); ?>">
									</div>
								</div>



								<div class="form-group row" <?php if (isset($_POST['persen20'])) {
																echo "";
															} else {
																echo "hidden";
															} ?>>
									<label for="inputEmail3" class="col-sm-4 col-form-label">Proyeksi MP Berkala 80% <br>
										<small style="color: blue;"><?= rupiah($mp); ?> x 80%</small></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="p_mp80" id="p_mp80" value="<?php error_reporting(0);
																													echo rupiah($mp80); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan Netto <?= $sisabln; ?> Bulan</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="hasil_tahun" id="hasil_tahun" value="<?= rupiah($mpnetto); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan Netto Sebelumnya <?php if ($penghasilan == 0) {
																																echo "";
																															} else {
																																echo $p_bln - 1 . " Bulan";
																															} ?></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="hasil_tahun" id="hasil_tahun" value="<?= rupiah($penghasilan); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan 1 Tahun</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="hasil_tahun" id="hasil_tahun" value="<?= rupiah($hasil_tahun); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PTKP</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="ptkp" id="ptkp" value="<?= rupiah($ptkp); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan Kena Pajak</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="pkp" id="pkp" value="<?= rupiah($pkp); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (5%)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="pph5" id="pph5" value="<?= rupiah($pph5); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (15%)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="pph15" id="pph15" value="<?= rupiah($pph15); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (25%)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="pph25" id="pph25" value="<?= rupiah($pph25); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (30%)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="pph30" id="pph30" value="<?= rupiah($pph30); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (35%)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="pph30" id="pph30" value="<?= rupiah($pph35); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 / Tahun</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="pph30" id="pph30" value="<?= rupiah($pph21thn); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 Yang Telah Dipotong / Disetor</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="setor" id="setor" value="<?= rupiah($setor); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 MP Berkala <br>
										<small style="color: blue;"><?php
																	$abc = $pph21thn - $setor;
																	echo rupiah($pph21thn) . "  -  " . rupiah($setor) . " = " . rupiah($abc) . " / " . $sisabln;  ?></small></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="pph21mpber" id="pph21mpber" value="<?= rupiah($pph21mpber); ?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Total Penerimaan MP Berkala</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="totpenmp" id="totpenmp" value="<?= rupiah($totpenmp); ?>">
									</div>
								</div>

								<!-- <a href="<?= base_url(); ?>laporan/pdf_proyeksi_mp/<?= $alldata['noreg'];  ?>" class="btn btn-danger">Export PDF</a> -->

								<button type="submit" class="btn btn-danger mt-2 mb-4" id="cetak_pdf" name="cetak_pdf" <?php if (isset($_POST['hitung'])) {
																														} else {
																															echo "disabled";
																														} ?>>Export PDF</button>
							</form>



							<!-- <br><br><br><br><br><br><br>
					<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-4 col-form-label">PhDP Proyeksi<br>
 					<small>Asumsi Kenaikan Gaji Pokok sebesar 4% Pertahun</small></label>
				    <div class="col-sm-8">

				      <input type="text" class="form-control" value="<?php

																		$x = 0;
																		do {
																			$x++;
																			$hasil = ($hasil * 1.04);
																		} while ($x < $sisaMsBk);

																		echo rupiah(round($hasil, -3));

																		$mp = $hasil * 0.025 * $lamakerja;
																		$cutmp = $hasil * 0.8;
																		if ($mp > $cutmp) {
																			$mpber = $cutmp;
																		} else {
																			$mpber = $mp;
																		}
																		$mpsek = $mpber * 147.35181;
																		$mpsek20 = 0.2 * $mpsek;
																		$mpber80 = 0.8 * $mpber;
																		?>">
				     				
				   
				    </div>
					</div>

					<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-4 col-form-label">Perkiraan MP Berkala Perbulan* <br>
				    <small>PhDP x 2.5% x Masa Bekerja</small>
				    </label>
				    <div class="col-sm-8">
				    <input type="text" class="form-control" value="<?php echo rupiah(round($mpber, -3)); ?>">
				    </div>
					</div>

					<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-4 col-form-label">Total Nilai Manfaat Pensiun
				    				<br>
				    				<small>MP x Faktor Sekaligus**</small>
				    </label>
				    <div class="col-sm-8">
				    <input type="text" class="form-control" value="<?php echo rupiah(round($mpsek, -3)); ?>">
				    </div>
					</div>

					<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-4 col-form-label">Perhitungan MP Sekaligus 20%
				    				<br>
				    				<small>Total MP x 20%</small>
				    </label>
				    <div class="col-sm-8">
				    <input type="text" class="form-control" value="<?php echo rupiah(round($mpsek20, -3)); ?>">
				    </div>
					</div>

					<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-4 col-form-label">Perkiraan MP Berkala Perbulan Setelah Diambil 20%
				    				<br>
				    				<small>Perkiraan MP x 80%</small>
				    </label>
				    <div class="col-sm-8">
				    <input type="text" class="form-control" value="<?php echo rupiah(round($mpber80, -3)); ?>">
				    </div>
				</div> -->

						</div>
					</div>
				</div>

				<div class="ml-3">
					<small>
						*Berdasarkan PDP Karyawan BPJS Ketenagakerjaan, besarnya manfaat pensiun setinggi-tingginya 80% dari PhDP(Gaji Pokok 3 Tahun Terkahir) <br>
						**Nilai Aktuaria saat ini adalah 147,35181
					</small>
				</div>
			</div>
		</div>
	</div>

</div>
</div>
<br>