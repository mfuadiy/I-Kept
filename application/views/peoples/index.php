<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h3 class="m-0 font-weight-bold text-primary">DAFTAR PESERTA AKTIF</h3>
		</div>
		<div class="card-body">
			<a href="<?= base_url('peoples/analisaPesertaAktif'); ?>" class="btn btn-danger">Analisa Peserta Aktif</a>
			<br><br>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>Nomor Peserta</th>
							<th>Nomor Pegawai</th>
							<th>Nama Peserta</th>
							<th style="text-align: center;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($peoples)) : ?>
							<tr>
								<td colspan="4">
									<div class="alert alert-danger" role="alert">
										DATA TIDAK DITEMUKAN!
									</div>
								</td>
							</tr>
						<?php endif; ?>
						<?php foreach ($peoples as $ppl) : ?>
							<tr>
								<th><?= ++$start; ?></th>
								<td><?= $ppl['nopes']; ?></td>
								<td><?= $ppl['noreg']; ?></td>
								<td><?= $ppl['nama_pes']; ?></td>
								<td style="text-align: center;">
									<a href="<?= base_url(); ?>peoples/detail/<?= $ppl['noreg']; ?>" class="badge badge-warning">detail</a>

									<a href="<?= base_url(); ?>mutasi/data_mutasi/<?= $ppl['noreg']; ?>" class="badge badge-danger">mutasi</a>
									<a href="<?= base_url(); ?>peoples/detail_peserta_simulasi/<?= $ppl['noreg']; ?>" class="badge badge-success">Hitung Proyeksi</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>