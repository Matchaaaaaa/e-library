<?php include '../app/views/templates/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col text-lg">
            <i class="fas fa-home ml-1 mr-2"></i>
            Dashboard
        </div>
    </div>
    <div class="row mt-lg-3">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <div class="row">
                        <div class="col">
                            <p>Total buku</p>
                            <h3><?= hitung('buku'); ?></h3>
                        </div>
                        <div class="col">
                            <center>
                                <i class="fas fa-book" style="font-size: 80px; margin-top: 5px;"></i>
                            </center>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <div class="row">
                        <div class="col">
                            <p>Kategori buku</p>
                            <h3><?= hitung('kategoribuku'); ?></h3>
                        </div>
                        <div class="col">
                            <center>
                                <i class="fas fa-list" style="font-size: 80px; margin-top: 5px;"></i>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <div class="row">
                        <div class="col">
                            <p>Total user</p>
                            <h3><?= hitung('users'); ?></h3>
                        </div>
                        <div class="col">
                            <center>
                                <i class="fas fa-user" style="font-size: 80px; margin-top: 5px;"></i>
                            </center>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row m-xl-5">
        <div class="col">
            <h3 class="text-center">E-Library</h3>
            <p class="pt-3 text-justify">
                Perpustakaan digital (Inggris: digital library atau electronic library atau virtual library) adalah
                perpustakaan yang mempunyai koleksi buku sebagian besar dalam bentuk format digital dan yang bisa
                diakses dengan komputer. Jenis perpustakaan ini berbeda dengan jenis perpustakaan konvensional yang
                berupa kumpulan buku tercetak, film mikro (microform dan microfiche), ataupun kumpulan kaset audio,
                video, dll. Isi dari perpustakaan digital berada dalam suatu komputer server yang bisa ditempatkan
                secara lokal, maupun di lokasi yang jauh, namun dapat diakses dengan cepat dan mudah lewat jaringan
                komputer.
            </p>
        </div>
        <div class="col">
            <center>
                <img src="<?= urlTo('/public/adminlte/img/book.png'); ?>" width="350px;">
            </center>
        </div>
    </div>
</div>
<?php include '../app/views/templates/footer.php'; ?>