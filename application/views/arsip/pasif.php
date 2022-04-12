<div class="card">
    <h5 class="card-header">File Peserta Pasif</h5>
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
                    foreach ($pasif as $p) :
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $p['npk']; ?></td>
                            <td><?= $p['nama']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>arsip/detail/<?= $p['npk']; ?>" class="badge badge-warning">detail</a>
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