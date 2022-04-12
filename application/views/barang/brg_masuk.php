<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">BARANG MASUK</h3>
        </div>
        <div class="card-body">
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Barang</button>
            <hr>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <!-- Modal Header -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <?= $this->session->flashdata('message'); ?>
                        <form action="<?= base_url('barang/barang_masuk'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <select id="id_brg" name="id_brg" class="form-control">
                                    <?php foreach ($barang as $s) : ?>
                                        <option value="<?= $s['id_brg']; ?>">
                                            <?php echo  $s['nama_brg'] . " - " . $s['merk_brg']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Masuk">
                                <br>
                                <input type="number" class="form-control" id="jml_brg" name="jml_brg" placeholder="Jumlah Barang">
                                <br>
                                <input type="number" class="form-control" id="hrg_satuan" name="hrg_satuan" placeholder="Harga Satuan">
                                <br>
                                <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                            </div>
                        </form>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Barang</th>
                            <th>Tanggal Masuk</th>
                            <th>Jumlah Barang</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah Harga</th>
                            <th>Aksi</th>
                            <!-- <th style="text-align: center;">Aksi</th> -->
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($barang_masuk as $b) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?php
                                    $ci = get_instance();

                                    $result = $ci->db->get_where('barang', ['id_brg' => $b['id_brg']])->row_array();
                                    echo $result['nama_brg'] ?></td>
                                <td><?= $b['tgl_masuk']; ?></td>
                                <td><?= $b['jml_brg']; ?></td>
                                <td>Rp <?= $b['hrg_satuan']; ?></td>
                                <td>Rp <?= $b['jml_brg'] * $b['hrg_satuan']; ?></td>
                                <td>
                                    <!-- <a href="" data-toggle="modal" data-target="#edit<?= $b['id_masuk']; ?>" class="badge badge-warning">edit</a> -->
                                    <a href="<?= base_url('barang/delete_barang_msk'); ?>/<?= $b['id_masuk']  ?>" class="badge badge-danger" onclick="konfirmasi()">hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <script type="text/javascript">
                            function konfirmasi() {
                                confirm('Anda Yakin?')
                            }
                        </script>
                    </tbody>
                </table>
                <?php foreach ($barang_masuk as $b) : ?>
                    <div class="modal fade" id="edit<?= $b['id_masuk']; ?>" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <!-- Modal Header -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Heading</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal Body -->
                                <?= $this->session->flashdata('message'); ?>
                                <form action="<?= base_url('barang/edit_barang_msk'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="text" class="form-control" id="id_masuk" name="id_masuk" value="<?= $b['id_masuk']; ?>" hidden>
                                        <input type="text" class="form-control" id="id_brg" name="id_brg" value="<?= $b['id_brg']; ?>" hidden>
                                        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $b['tgl_masuk']; ?>">
                                        <br>
                                        <input type="number" class="form-control" id="jml_brg" name="jml_brg" value="<?= $b['jml_brg']; ?>">
                                        <br>
                                        <input type="number" class="form-control" id="hrg_satuan" name="hrg_satuan" value="<?= $b['hrg_satuan']; ?>">
                                        <br>
                                        <button type="submit" class="btn btn-primary" name="addnewbarang">Edit</button>
                                    </div>
                                </form>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>
</div>