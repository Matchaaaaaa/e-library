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
                <div class="card-header">
                    <a href="<?= urlTo('/buku/cetaktransaksiselesai'); ?>" class="btn btn-success float-left mr-3">Cetak
                        Laporan 1</a>
                    <a href="<?= urlTo('/buku/cetaktransaksi'); ?>" class="btn btn-success float-left mr-3">Cetak
                        Laporan
                        2</a>
                    <a href="<?= urlTo('/buku/cetaktransaksiall'); ?>" class="btn btn-success float-left">Cetak Laporan
                        3</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Alamat Peminjam</th>
                                <th>Buku Yang di Pinjam</th>
                                <th>Tanggal di Kembalikan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $k): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $k['NamaLengkap']; ?></td>
                                <td><?= $k['Alamat']; ?></td>
                                <td><?= $k['Judul']; ?></td>
                                <td><?php if($k['StatusPeminjaman'] === 'Belum di Kembalikan'): ?>
                                    <?php echo ''; ?>
                                    <?php else: ?>
                                    <?= date('d-m-Y', strtotime($k['TanggalPengembalian'])); ?>
                                    <?php endif; ?></td>
                                <td><?= $k['StatusPeminjaman']; ?></td>
                            </tr>
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