<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">LIST BARANG</h3>
        </div>
        <div class="card-body">
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Barang</button>
            <a href="<?= base_url('barang/excel5'); ?>" class="btn btn-success">Export Excel</a>
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
                        <form action="<?= base_url('barang/input_barang'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="text" class="form-control" id="nama_brg" name="nama_brg" placeholder="Nama Barang">
                                <br>
                                <input type="text" class="form-control" id="merk_brg" name="merk_brg" placeholder="Merek">
                                <br>
                                <input type="text" class="form-control" id="bts_stock" name="bts_stock" placeholder="Batas Stock">
                                <br>
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock">
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
                            <th>Nama Barang</th>
                            <th>Merek</th>
                            <th>Batas Stock</th>
                            <th>Stock</th>
                            <th>Aksi</th>

                            <!-- <th style="text-align: center;">Aksi</th> -->
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        foreach ($barang as $s) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $s['nama_brg']; ?></td>
                                <td><?= $s['merk_brg']; ?></td>
                                <td><?= $s['bts_stock']; ?></td>
                                <td><?= $s['stock']; ?></td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#edit<?= $s['id_brg']; ?>" class="badge badge-warning">edit</a>
                                    <a href="<?= base_url('barang/delete_barang'); ?>/<?= $s['id_brg']  ?>" class="badge badge-danger" onclick="konfirmasi()">hapus</a>
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
                <?php foreach ($barang as $s) : ?>
                    <div class="modal fade" id="edit<?= $s['id_brg']; ?>" role="dialog">
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
                                <form action="<?= base_url('barang/edit_barang'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="text" class="form-control" id="id_brg" name="id_brg" value="<?= $s['id_brg']; ?>" hidden>
                                        <input type="text" class="form-control" id="nama_brg" name="nama_brg" value="<?= $s['nama_brg']; ?>">
                                        <br>
                                        <input type="text" class="form-control" id="merk_brg" name="merk_brg" value="<?= $s['merk_brg']; ?>">
                                        <br>
                                        <input type="text" class="form-control" id="bts_stock" name="bts_stock" value="<?= $s['bts_stock']; ?>">
                                        <br>
                                        <input type="number" class="form-control" id="stock" name="stock" value="<?= $s['stock']; ?>">
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