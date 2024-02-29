<?php 
class KategoribukuController extends Controller
{
  public function index()
  {
    $data = $this->model('Kategoribuku')->getAll();
    $this->view('kategoribuku/home', $data);
  }

  public function create()
  {
    $this->view('kategoribuku/create');
  }

  public function store()
{
    // Ambil Nama Kategori dari input
    $namaKategori = $_POST['NamaKategori'];

    // Lakukan koneksi ke database (menggunakan PDO)
    $pdo = new PDO('mysql:host=localhost;dbname=digilibrary', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lakukan query untuk memeriksa apakah Nama Kategori sudah ada sebelumnya
    $stmt = $pdo->prepare('SELECT * FROM kategoribuku WHERE NamaKategori = :namaKategori');
    $stmt->execute(['namaKategori' => $namaKategori]);
    $existingCategory = $stmt->fetch();

    // Jika kategori sudah ada, kembalikan pesan kesalahan
    if ($existingCategory) {
        redirectTo('danger', 'Maaf, Kategori sudah ada', '/kategoribuku/create');
        return; // Hentikan eksekusi selanjutnya
    }

    // Jika kategori belum ada, tambahkan kategori baru
    $stmt = $pdo->prepare('INSERT INTO kategoribuku (NamaKategori) VALUES (:namaKategori)');
    $success = $stmt->execute(['namaKategori' => $namaKategori]);

    if ($success) {
        redirectTo('success', 'Selamat, Data Kategori Berhasil ditambahkan', '/kategoribuku');
    } else {
        redirectTo('danger', 'Maaf, Data Kategori gagal ditambahkan', '/kategoribuku');
    }
}


  

  public function edit($id)
  {
    $data = $this->model('KategoriBuku')->getById($id);
    $this->view('kategoribuku/edit', $data);
  }

  public function update($id)
  {
    if ($this->model('Kategoribuku')->update($id) > 0) {
      redirectTo('success', 'Selamat, Data Kategori Berhasil di Update', '/kategoribuku');
    } else {
      redirectTo('danger', 'Maaf, Data Kategori gagal di Update', '/kategoribuku');
    }
  }

  public function delete($id)
	{
		if ($this->model('Kategoribuku')->delete($id) > 0) {
			redirectTo('success', 'Selamat, Data Kategori berhasil di hapus!', '/kategoribuku');
		}
	}

  public function __construct()
  {
    /**
      * Batasi hak akses hanya untuk Administrator dan Petugas
      * Selain Administrator dan Petugas akan langsung diarahkan kembali ke halaman home
    */
    if ($_SESSION['role'] !== 'Administrator' && $_SESSION['role'] !== 'Petugas') {
      redirectTo('error', 'Mohon maaf, Anda tidak berhak mengakses halaman ini', '/');
    }
  }
}