<div class="card">
    <h5 class="card-header">Daftar Arsip <?= $nama; ?></h5>
    <div class="card-body">
        <div class="table-responsive">
            <a href="" class="btn btn-success mb-2" data-toggle="modal" data-target="#tambahDokumen">
                <i class="fa fa-plus-square" aria-hidden="true"></i>
                Tambah Dokumen
            </a>

            <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 4.5%;">No</th>
                        <th>Perihal</th>
                        <th>Nama File</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    //foreach ($aktif as $a) :
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php //endforeach;
                    ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary" onclick="history.back()">Kembali</button>

    </div>
</div>

<div class="modal fade" id="tambahDokumen" tabindex="-1" role="dialog" aria-labelledby="tambahDokumen" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDokumen">Tambah Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('arsip/tambah_dokumen'); ?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Pilih Dokumen</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>