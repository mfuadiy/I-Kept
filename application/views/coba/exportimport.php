<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<title><?= $title; ?></title>
</head>

<body>
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
		</li>
		<li class="nav-item after-add-more" role="presentation">
			<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
		</li>
	</ul>
	<div class="copy invisible">
		<div class="control-group">
			<li class="nav-item" role="presentation">
				<button type="button" class="close remove" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

				<a class="nav-link" id="contact1-tab" data-toggle="tab" href="#contact1" role="tab" aria-controls="contact1" aria-selected="false">Contact</a>
			</li>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade control-group" id="contact1" role="tabpanel" aria-labelledby="contact-tab"><?php require 'index111.php' ?></div>
			</div>
		</div>
	</div>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">Home</div>
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Profile</div>
		<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">contact</div>

	</div>
	<button class="btn btn-success add-more mb-4" type="button">
		<i class="fa fa-plus-square" aria-hidden="true"></i></button>

	<div class="container">
		<div class="row mt-2">
			<div class="col-12">

				<div class="card">
					<div class="card-body">
						<?= form_open_multipart('coba/uploaddata') ?>
						<div class="form-row">
							<div class="col-4">
								<input type="file" class="form-control-file" id="importexcel" name="importexcel" accept=".xlsx,xls">
							</div>
							<div class="col">
								<button type="submit" class="btn btn-primary">Import</button>
							</div>
							<div class="col">
								<?= $this->session->flashdata('pesan'); ?>
							</div>
						</div>
						<?= form_close(); ?>
					</div>
				</div>

				<div class="card mt-2">
					<div class="card-body">
						<a href="<?= base_url('coba/mpdf'); ?>" class="btn btn-danger">Export PDF</a>
						<a href="<?= base_url('coba/excel'); ?>" class="btn btn-success">Export Simple (Paging) Excel</a>
						<a href="<?= base_url('coba/excel2'); ?>" class="btn btn-success">Export per Sheet Spout Excel</a>
					</div>
				</div>

				<div class="card mt-2">
					<div class="card-body">

						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Kode Barang</th>
									<th scope="col">Nama Barang</th>
									<th scope="col">Jumlah</th>
									<th scope="col">Tanggal Masuk Barang</th>
								</tr>
							</thead>

							<tbody>
								<?php $i = 1;
								foreach ($semuabarang as $barang) : ?>

									<tr>
										<th scope="row"><?= $i++; ?></th>
										<td><?= $barang['kode_barang']; ?></td>
										<td><?= $barang['nama_barang']; ?></td>
										<td><?= $barang['jumlah_barang']; ?></td>
										<td><?= date('d F Y', $barang['date_created']); ?></td>
									</tr>

								<?php endforeach; ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

	<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>