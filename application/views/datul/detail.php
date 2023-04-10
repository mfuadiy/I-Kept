<div class="container">
	<div class="row mt-2">
		<div class="col-12">

			<h3 style="text-align: center;">DATA ULANG PENSIUNAN</h3>
			<form action="<?= base_url(); ?>datul/update/<?= $pensiun['npk']; ?>" method="post" enctype="multipart/form-data">
				<!-- Data Pensiunan -->
				<div class="card mt-2">
					<div class="card-body">
						<h4 style="text-align: center;">Data Pensiunan</h4><br>


						<?= $this->session->flashdata('simadu'); ?>
						<?= $this->session->flashdata('pesan'); ?>

						<table class="table">

							<tr>
								<th scope="row">Nama</th>
								<td><input class="form-control" type="text" name="nama" id="nama" value="<?php
																											if ($jum > 0) {
																												echo ($datul['nama']);
																											} else {
																												echo ($pensiun['nama']);
																											} ?>" readonly></td>
							</tr>

							<tr>
								<th scope="row">Tanggal Lahir</th>
								<td><input class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" value="<?php
																													if ($jum > 0) {
																														echo ($datul['tgl_lahir']);
																													} else {
																														echo ($pensiun['tglhr']);
																													} ?>" readonly></td>
							</tr>

							<tr>
								<th scope="row">Nomor Pensiun</th>
								<td><input class="form-control" type="text" name="nopen" id="nopen" value="<?php if ($jum > 0) {
																												echo ($datul['nopen']);
																											} else {
																												echo ($pensiun['nopen']);
																											} ?>" readonly></td>
							</tr>

							<tr>
								<th scope="row">Nomor Pegawai</th>
								<td><input class="form-control" type="text" name="npk" id="npk" value="<?php if ($jum > 0) {
																											echo ($datul['npk']);
																										} else {
																											echo ($pensiun['npk']);
																										} ?>" readonly></td>
							</tr>

							<tr>
								<th scope="row">Status Pensiun</th>
								<td>
									<select id="stppp" name="stppp" class="form-control">
										<?php foreach ($jenis_pensiun as $jp) : ?>
											<option value="<?= $jp['stppp']; ?>" <?php
																					if ($jum > 1) {
																						if ($datul['stppp'] == $jp['stppp']) {
																							echo "selected";
																						}
																					} else {
																						if ($pensiun['stppp'] == $jp['stppp']) {
																							echo "selected";
																						}
																					}

																					?>>
												<?php echo "" . $jp['stppp'] . "-" . $jp['desk1'] . "-" . $jp['desk2']; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>

							<tr>
								<th scope="row">Alamat</th>
								<td><input class="form-control" type="text" name="alamat" id="alamat" value="<?php if ($jum > 0) {
																													echo ($datul['alamat']);
																												} else {
																													echo ($pensiun['alamat']);
																												} ?>"></td>
							</tr>

							<tr>
								<th scope="row">RT/RW</th>
								<td><input class="form-control" type="text" name="rt_rw" id="rt_rw" value="<?php if ($jum > 0) {
																												echo ($datul['rt_rw']);
																											} else {
																												echo ($pensiun['rt_rw']);
																											} ?>"></td>
							</tr>

							<tr>
								<th scope="row">Kelurahan</th>
								<td><input class="form-control" type="text" name="kelurahan" id="kelurahan" value="<?php if ($jum > 0) {
																														echo ($datul['kelurahan']);
																													} else {
																														echo ($pensiun['kelurahan']);
																													} ?>"></td>
							</tr>

							<tr>
								<th scope="row">Kecamatan</th>
								<td><input class="form-control" type="text" name="kecamatan" id="kecamatan" value="<?php if ($jum > 0) {
																														echo ($datul['kecamatan']);
																													} else {
																														echo ($pensiun['kecamatan']);
																													} ?>"></td>
							</tr>

							<tr>
								<th scope="row">Kota</th>
								<td><input class="form-control" type="text" name="kota" id="kota" value="<?php if ($jum > 0) {
																												echo ($datul['kota']);
																											} else {
																												echo ($pensiun['kota']);
																											} ?>"></td>
							</tr>

							<tr>
								<th scope="row">Provinsi</th>
								<td>
									<select id="provinsi" name="provinsi" class="form-control">
										<?php foreach ($prov as $p) : ?>
											<option <?php if ($jum > 0) {
														if ($datul['provinsi'] == $p['prov']) {
															echo "selected";
														}
													} ?>>
												<?php echo $p['prov']; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>

							<tr>
								<th scope="row">Kode Pos</th>
								<td><input class="form-control" type="text" name="kodepos" id="kodepos" value="<?php if ($jum > 0) {
																													echo ($datul['kodepos']);
																												} else {
																													echo ($pensiun['kodepos']);
																												} ?>"></td>
							</tr>

							<tr>
								<th scope="row">Nomor Telepon/HP</th>
								<td><input class="form-control" type="text" name="no_hp" id="no_hp" value="<?php if ($jum > 0) {
																												echo ($datul['no_hp']);
																											} else {
																												echo ($pensiun['hp']);
																											} ?>"></td>
							</tr>

							<tr>
								<th scope="row">Nomor HP Suami/Istri</th>
								<td><input class="form-control" type="text" name="no_hplain" id="no_hplain" value="<?php if ($jum > 0) {
																														echo ($datul['no_hplain']);
																													} ?>"></td>
							</tr>

							<tr>
								<th scope="row">Email</th>
								<td><input class="form-control" type="text" name="email" id="email" value="<?php if ($jum > 0) {
																												echo ($datul['email']);
																											} ?>"></td>
							</tr>

							<tr>
								<th scope="row">NPWP</th>
								<td><input class="form-control" type="text" name="npwp" id="npwp" value="<?php if ($jum > 0) {
																												echo ($datul['npwp']);
																											} else {
																												echo ($pensiun['npwp']);
																											} ?>"></td>
							</tr>

						</table>

					</div>
				</div>

				<!-- Data Ahli Waris -->
				<div class="card mt-2 mb-4">
					<div class="card-body">
						<h4 style="text-align: center;">Data Ahli Waris</h4><br>

						<div class="control-group after-add-more">
							<table class="table">
								<?php foreach ($ahli_waris as $aw) : ?>
									<tr>
										<th scope="col">
											<div class="form-group">
												<label>Nama</label>
												<input class="form-control" type="text" value="<?= $aw['nama']; ?>">
											</div>
										</th>
										<th scope="col">
											<div class="form-group">
												<label>Tanggal Lahir</label>
												<input class="form-control" type="date" value="<?= $aw['tgl_lhr_aw']; ?>">
											</div>
										</th>
										<th scope="col">
											<div class="form-group">
												<label>Status Tanggungan</label>
												<input class="form-control" type="text" value="<?= $aw['st_tangg']; ?>">
											</div>
										</th>
										<th scope="col">
											<button class="btn btn-danger remove invisible" type="button"><i class="glyphicon glyphicon-remove"></i>Hapus</button>
										</th>
									</tr>
								<?php endforeach; ?>
							</table>



						</div>

						<div class="copy invisible">
							<div class="control-group">
								<table class="table">
									<tr>
										<th scope="col">
											<label>Nama Anak</label>
											<input class="form-control" type="text">
										</th>
										<th scope="col">
											<label>Tanggal Lahir</label>
											<input class="form-control" type="date">
										</th>
										<th scope="col">
											<br>
											<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>Hapus</button>
										</th>
									</tr>
								</table>
							</div>
						</div>

						<button class="btn btn-success add-more mb-4" type="button">
							<i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Ahli Waris
						</button>

					</div>
				</div>
				<!-- Akhir AHli Waris -->

				<!-- Form Input Dokumen -->
				<button class="btn btn-danger add-more mt-2 mb-4" type="submit" <?= $ada; ?>>
					<i class="glyphicon glyphicon-plus"></i> Simpan
				</button>

			</form>

			<div class="card mt-2 mb-4">
				<div class="card-body">
					<center>
						<h4>Masukan Dokumen Penunjang</h4>
					</center>

					<form action="<?= base_url(); ?>datul/update_ktp/" method="post" enctype="multipart/form-data">
						<div class="alert alert-info">
							<input type="file" class="form-control-file" id="file_ktp" name="file_ktp" accept=".jpg,.png,.jpeg,.bmp, .pdf" <?= $ada1; ?>>
							<label>Masukan Scan KTP | Maks. 2 Megabyte</label>
							<input class="form-control invisible" type="text" name="npk1" id="npk1" value="<?php if ($jum > 0) {
																												echo ($datul['npk']);
																											} else {
																												echo ($pensiun['npk']);
																											} ?>">
							<button class="btn btn-danger add-more mt-2 mb-4" type="submit" <?= $ada1; ?>>
								<i class="glyphicon glyphicon-plus"></i> Simpan
							</button>
						</div>
					</form>

					<form action="<?= base_url(); ?>datul/update_npwp/" method="post" enctype="multipart/form-data">
						<div class="alert alert-info">
							<input type="file" class="form-control-file" id="file_npwp" name="file_npwp" accept=".jpg,.png,.jpeg,.bmp, .pdf" <?= $ada1; ?>>
							<label>Masukan Scan NPWP | Maks. 2 Megabyte</label>
							<input class="form-control invisible" type="text" name="npk2" id="npk2" value="<?php if ($jum > 0) {
																												echo ($datul['npk']);
																											} else {
																												echo ($pensiun['npk']);
																											} ?>">
							<button class="btn btn-danger add-more mt-2 mb-4" type="submit" <?= $ada1; ?>>
								<i class="glyphicon glyphicon-plus"></i> Simpan
							</button>
						</div>
					</form>

					<form action="<?= base_url(); ?>datul/update_mati/" method="post" enctype="multipart/form-data">
						<div class="alert alert-info">
							<input type="file" class="form-control-file" id="file_sk_kematian" name="file_sk_kematian" accept=".jpg,.png,.jpeg,.bmp, .pdf" <?= $ada1; ?>>
							<label>Masukan Scan Surat Keterangan Meninggal jika Pensiunan diatas telah meninggal dunia | Maks. 2 Megabyte</label>
							<input class="form-control invisible" type="text" name="npk3" id="npk3" value="<?php if ($jum > 0) {
																												echo ($datul['npk']);
																											} else {
																												echo ($pensiun['npk']);
																											} ?>">
							<button class="btn btn-danger add-more mt-2 mb-4" type="submit" <?= $ada1; ?>>
								<i class="glyphicon glyphicon-plus"></i> Simpan
							</button>
						</div>
					</form>

					<form action="<?= base_url(); ?>datul/update_nikah/" method="post" enctype="multipart/form-data">
						<div class="alert alert-info">
							<input type="file" class="form-control-file" id="file_akta_nikah" name="file_akta_nikah" accept=".jpg,.png,.jpeg,.bmp, .pdf" <?= $ada1; ?>>
							<label>Masukan Scan Salinan Akta Nikah bila pensiunan janda / duda tsb menikah lagi | Maks. 2 Megabyte</label>
							<input class="form-control invisible" type="text" name="npk4" id="npk4" value="<?php if ($jum > 0) {
																												echo ($datul['npk']);
																											} else {
																												echo ($pensiun['npk']);
																											} ?>">
							<button class="btn btn-danger add-more mt-2 mb-4" type="submit" <?= $ada1; ?>>
								<i class="glyphicon glyphicon-plus"></i> Simpan
							</button>
						</div>
					</form>

					<form action="<?= base_url(); ?>datul/update_kk/" method="post" enctype="multipart/form-data">
						<div class="alert alert-info">
							<input type="file" class="form-control-file" id="file_kk" name="file_kk" accept=".jpg,.png,.jpeg,.bmp, .pdf" <?= $ada1; ?>>
							<label>Masukan Scan Kartu Keluarga Terbaru | Maks. 2 Megabyte</label>
							<input class="form-control invisible" type="text" name="npk5" id="npk5" value="<?php if ($jum > 0) {
																												echo ($datul['npk']);
																											} else {
																												echo ($pensiun['npk']);
																											} ?>">

							<button class="btn btn-danger add-more mt-2 mb-4" type="submit" <?= $ada1; ?>>
								<i class="glyphicon glyphicon-plus"></i> Simpan
							</button>
						</div>
					</form>

				</div>
			</div>


			<button class="btn btn-primary add-more mb-4" onclick="goBack()">Go Back</button>
		</div>
	</div>
</div>



<script>
	function goBack() {
		window.history.back();
	}
</script>