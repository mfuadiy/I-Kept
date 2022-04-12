<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->



    <div class="card shadow">
        <div class="card-header py-3">
            <div class="mt-4 mb-0" style="text-align:justify;">

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <!-- Modal Header -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Surat</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal Body -->
                            <?= $this->session->flashdata('message'); ?>
                            <form action="<?= base_url('surat/suratmasuk'); ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="date" class="form-control" id="tgl_agenda" name="tgl_agenda" placeholder="Tanggal Agenda">
                                    <br>
                                    <input type="text" class="form-control" id="pengirim" name="pengirim" placeholder="Pengirim">
                                    <br>
                                    <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat">
                                    <br>
                                    <input type="date" class="form-control" id="tgl_surat" name="tgl_surat" placeholder="Tanggal Surat">
                                    <br>
                                    <input type="text" class="form-control" id="no_agenda" name="no_agenda" placeholder="Nomor Agenda">
                                    <br>
                                    <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal">
                                    <br>
                                    <!-- Button Check Box -->
                                    <div class="form-group" style="text-align:justify;">
                                        <b><label for="file">Tujuan</label></b>
                                        <!-- <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Tujuan"> -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="dirut" value="Direktur Utama," id="dirut">
                                            <label class="form-check-label" for="file">
                                                1. Direktur Utama
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="direktur" value="Direktur," id="direktur">
                                            <label class="form-check-label" for="file">
                                                2. Direktur
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="menku" value="Manager Keuangan," id="menku">
                                            <label class="form-check-label" for="file">
                                                3. Manager Keuangan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="menkep" value="Manager Kepesertaan," id="menkep">
                                            <label class="form-check-label" for="file">
                                                4. Manager Keepesertaan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="menum" value="Manager SDM Umum & TI" id="menum">
                                            <label class="form-check-label" for="file">
                                                5. Manager SDM Umum & TI
                                            </label>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="status" name="status" placeholder="Status">
                                    <br>
                                    <input type="text" class="form-control" id="salur" name="salur" placeholder="Salur">
                                    <br>
                                    <input type="file" class="form-control" id="berkas" name="berkas" accept=".pdf" placeholder="berkas">
                                    <br>
                                    <button type="submit" class="btn btn-primary" id="tsm" name="tsm">Tambah Surat Masuk</button>
                                </div>
                            </form>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg">

                        <center>
                            <div class="card-header py-3">
                                <!-- <div class="card mt-2 mb-4 col-8"> -->
                                <div class="card-body">
                                    <?php if (isset($_POST['tsm'])) : ?>
                                        <?php if (validation_errors()) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= validation_errors(); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="card mt-2 col-12">
                                        <h2 class="mt-4 font-weight-bold text-primary">Data Surat</h2>

                                        <div class="card-body">

                                            <div class="row mt-4">
                                                <div class="col-md-5">
                                                    <form action="<?= base_url('surat/suratmasuk'); ?>" method="post">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Cari Surat" id="keyword" name="keyword" autocomplete="off" autofocus="" value="<?= set_value('keyword'); ?>">
                                                            <div class="input-group-append">
                                                                <input class="btn btn-primary" type="submit" name="submit">
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <h5 style="text-align: left;" class="mb-4">Hasil pencarian sebanyak : <?= $total_rows; ?></h5>
                                                </div>
                                            </div>
                                            <div style="text-align:justify;">
                                                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">Tambah Surat Masuk</button>
                                                <a href="<?= base_url('surat/excel5'); ?>" class="btn btn-success mb-2">Export Excel</a>
                                            </div>



                                            <div class="table-responsive" style="text-align:justify;">
                                                <table class="table table-hover">
                                                    <thead style="text-align:center">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Tanggal Agenda</th>
                                                            <th scope="col">Pengirim</th>
                                                            <th scope="col">Nomor Surat</th>
                                                            <th scope="col">Tanggal Surat</th>
                                                            <th scope="col">Nomor Agenda</th>
                                                            <th scope="col">Perihal</th>
                                                            <th scope="col">Tujuan</th>
                                                            <th scope="col">Isi Disposisi</th>
                                                            <th scope="col">Di Salurkan</th>
                                                            <th scope="col">Berkas</th>
                                                            <th scope="col">Lama Surat</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($allSurat as $as) : ?>
                                                            <tr>
                                                                <th scope="row"><?= ++$start; ?></th>
                                                                <td style="word-wrap: break-word"><?= $as['tgl_agenda']; ?></td>
                                                                <td style="word-wrap: break-word"><?= $as['pengirim']; ?></td>
                                                                <td style="word-wrap: break-word"><?= $as['no_surat']; ?></td>
                                                                <td style="word-wrap: break-word"><?= $as['tgl_surat']; ?></td>
                                                                <td style="word-wrap: break-word"><?= $as['no_agenda']; ?></td>
                                                                <td style="word-wrap: break-word"><?= $as['perihal']; ?></td>
                                                                <td style="word-wrap: break-word"><?= $as['tujuan']; ?></td>
                                                                <td style="word-wrap: break-word"><?= $as['disposisi']; ?></td>
                                                                <td style="word-wrap: break-word"><?= $as['salur']; ?></td>
                                                                <td style="word-wrap: break-word">
                                                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal<?= $i ?>">
                                                                        <?= $as['berkas']; ?>
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $now = new DateTime();
                                                                    $msk = new DateTime($as['tgl_agenda']);
                                                                    $int = date_diff($msk, $now)->days;
                                                                    echo $int;
                                                                    echo " hari";
                                                                    ?>
                                                                </td>

                                                                <td style="text-align: center;">
                                                                    <input class="surat" id="surat" type="checkbox" <?= surat($as['id'], $as['status']); ?> data-id="<?= $as['id']; ?>" data-status="<?= $as['status']; ?>">
                                                                </td>

                                                                <td style="word-wrap: break-word">
                                                                    <a href="<?= base_url(); ?>surat/editsurat/<?= $as['id']; ?>" class="badge badge-warning">Edit</a>
                                                                    <!-- <button type="button" class="badge badge-primary" data-toggle="modal" data-target="#editModal">Edit</button> -->
                                                                    <!-- <a href="" class="badge badge-danger">delet</a> -->
                                                                </td>
                                                            </tr>


                                                            <center>
                                                                <div class="modal fade" id="exampleModal<?= $i ?>">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel"><?= $as['berkas']; ?></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?php
                                                                                $a11 = $as['berkas'];
                                                                                // var_dump($a11);
                                                                                ?>
                                                                                <iframe src="<?php echo base_url('assets/berkas/') . $a11; ?>" frameborder="0" width="100%" height="700px"></iframe>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </center>
                                                            <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <?= $this->pagination->create_links(); ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </center>



                    </div>
                    <!-- /.container-fluid -->

                </div>