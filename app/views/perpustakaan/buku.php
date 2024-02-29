<?php include '../app/views/templates/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center"><?= $data['buku']['Judul']; ?></h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Penulis</b>
                            <label class="badge badge-info float-right"><?= $data['buku']['Penulis']; ?></label>
                        </li>
                        <li class="list-group-item">
                            <b>Penerbit</b>
                            <label class="badge badge-info float-right"><?= $data['buku']['Penerbit']; ?></label>
                        </li>
                        <li class="list-group-item">
                            <b>TahunTerbit</b>
                            <label class="badge badge-info float-right"><?= $data['buku']['TahunTerbit']; ?></label>
                        </li>
                        <a href="<?= urlTo('/perpustakaan'); ?>" class="btn btn-danger btn-block">
                            <b>Kembali</b>
                        </a>
                        <a href="<?= urlTo('/perpustakaan/'.$data['buku']['BukuID'].'/ulasanbuku'); ?>"
                            class="btn btn-success btn-block">
                            <b>Berikan Ulasan</b>
                        </a>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4>Ulasan</h4>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ulasan</th>
                                <th>Rating</th>
                                <th>Pemberi Ulasan</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['ulasan'] as $ulasan): ?>
                            <tr>
                                <td><?= $ulasan['Ulasan']; ?></td>
                                <td><?= $ulasan['Rating']; ?></td>
                                <td><?= $ulasan['NamaLengkap']; ?></td>
                                <td>
                                    <?php if ($_SESSION['UserID'] === $ulasan['UserID']): ?>
                                    <a href="<?= urlTo('/ulasan/' . $ulasan['UlasanID'].'/edit') ?>"
                                        class="btn btn-primary">Edit</a>
                                    <?php endif; ?>
                                    <?php if ($_SESSION['UserID'] === $ulasan['UserID'] || $_SESSION['role'] === 'Petugas' || $_SESSION['role'] === 'Administrator'): ?>
                                    <a href="<?= urlTo('/ulasan/' . $ulasan['UlasanID'].'/delete') ?>"
                                        class="btn btn-danger">Delete</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
<?php include '../app/views/templates/footer.php'; ?>