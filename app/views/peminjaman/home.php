<?php include '../app/views/templates/header.php'; $no = 1; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col text-lg">
                    <i class="fas fa-book ml-1 mr-2"></i>
                    Peminjaman
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal di Kembalikan</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $buku): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $buku['Judul']; ?></td>
                                <td><?= date('d-m-Y', strtotime($buku['TanggalPeminjaman'])); ?></td>
                                <td>
                                    <?php if($buku['StatusPeminjaman'] === 'Belum di Kembalikan'): ?>
                                    <?php echo ''; ?>
                                    <?php else: ?>
                                    <?= date('d-m-Y', strtotime($buku['TanggalPengembalian'])); ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= $buku['StatusPeminjaman']; ?></td>
                                <td>
                                    <?php if($buku['StatusPeminjaman'] === 'Belum di Kembalikan'): ?>
                                    <form action="<?= urlTo('/peminjaman/'.$buku['PeminjamanID'].'/kembalikan') ?>"
                                        method="post">
                                        <input type="hidden" name="TanggalPengembalian" value="<?= date('Y-m-d'); ?>">
                                        <input type="hidden" name="StatusPeminjaman" value="Sudah di Kembalikan">
                                        <button class="btn btn-info">Kembalikan</button>
                                    </form>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<?php include '../app/views/templates/footer.php'; ?>