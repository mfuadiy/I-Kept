<div class="card">
    <h5 class="card-header">File Peserta Aktif</h5>
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPK</th>
                        <th>Nama Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    foreach ($aktif as $a) :
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $a['noreg']; ?></td>
                            <td><?= $a['nama_pes']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>arsip/detail/<?= $a['noreg']; ?>" class="badge badge-warning">detail</a>
                            </td>
                        </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>
        </div>



    </div>
</div>
</div>