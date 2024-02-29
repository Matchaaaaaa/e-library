<?php 
use Dompdf\Dompdf;
class BukuController extends Controller

{
  public function index()
  {
    $data = $this->model('KBRelasi')->get();
    $this->view('buku/home', $data);
  }

  public function create()
  {
    $data = $this->model('KategoriBuku')->getAll();
    $this->view('buku/create', $data);
  }

  public function store()
  {
    $BukuID = $this->model('Buku')->create([
      'Judul'       => $_POST['Judul'],
      'Penulis'     => $_POST['Penulis'],
      'Penerbit'    => $_POST['Penerbit'],
      'TahunTerbit' => $_POST['TahunTerbit']
    ]);

    $KategoriID = $_POST['KategoriID'];

    if ($this->model('KBRelasi')->create([
      'BukuID'      => $BukuID,
      'KategoriID'  => $KategoriID
    ]) > 0) {
      redirectTo('success', 'Selamat, Buku berhasil di tambahkan', '/buku');
    } else {
      redirectTo('error', 'Maaf, Buku gagal di tambahkan', '/buku/create');
    }
  }

  public function edit($id)
  {
    $data = $this->model('Buku')->getById($id);
    $this->view('buku/edit', $data);
  }

  public function update($id)
  {
    if ($this->model('Buku')->update($id) > 0) {
      redirectTo('success', 'Selamat, Data Buku Berhasil di Update', '/buku');
    } else {
      redirectTo('danger', 'Maaf, Data Buku gagal di Update', '/buku');
    }
  }

  public function delete($id)
	{
		if ($this->model('Buku')->delete($id) > 0) {
			redirectTo('success', 'Selamat, Data Buku berhasil di hapus!', '/buku');
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

    // Method untuk menghapus ulasan
    public function deleteulasan($id)
    {
      if ($this->model('UlasanBukuModel')->delete($id) > 0) {
        redirectTo('success', 'Ulasan berhasil dihapus', '/');
      } else {
        redirectTo('error', 'Maaf, terjadi kesalahan saat menghapus ulasan', '/');
      }
    }

  public function ulasan($id)
  {
      $this->view('buku/ulasan', [
          'buku'    => $this->model('Buku')->getById($id),
          'ulasan'  => $this->model('UlasanBukuModel')->getByBookID($id)
      ]);
  }
  


  public function cetakbuku()
  {
    $data = $this->model('KBRelasi')->get();
		$html 	= "<h1>Kyoto</h1>";
		$html 	.= "<h2>E-Library</h2>";
		$html 	.= "<hr>";
    $html 	.= "<br>";
    $html 	.= "<h3>DAFTAR BUKU</h3>";
    $html 	.= "<center>";
    $html   .= "<table align='center' border='1' cellpadding='10' cellspacing='0'>";
		$html   .= "<tr><th>No</th><th>Kategori</th><th>Judul Buku</th><th>Penulis</th><th>Penerbit</th><th>Tahun Terbit</th></tr>";
    $no = 1;
    foreach ($data as $buku) {
      $html .= "<tr>";
      $html .= "<td>".$no."</td>";
      $html .= "<td>".$buku['NamaKategori']."</td>";
      $html .= "<td>".$buku['Judul']."</td>";
      $html .= "<td>".$buku['Penulis']."</td>";
      $html .= "<td>".$buku['Penerbit']."</td>";
      $html .= "<td>".$buku['TahunTerbit']."</td>";
      $html .= "</tr>";
      $no++;
    }
    $html   .= "</table>";
    $html 	.= "</center>";
    $html 	.= "<h3><center>Terimakasih</center></h3>";
    $dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('4A', 'potrait');
		$dompdf->render();
		$dompdf->stream('Data Buku', ['Attachment' => 0]);
  }

  public function cetaktransaksi()
{
    $data = $this->model('Peminjaman')->get();
		$html 	= "<h1>Kyoto</h1>";
		$html 	.= "<h2>E-Library</h2>";
		$html 	.= "<hr>";
    $html 	.= "<br>";
    $html 	.= "<h3>DAFTAR BUKU(BELUM DIKEMBALIKAN)</h3>";
    $html 	.= "<center>";
    $html  .= "<table align='center' border='1' cellpadding='10' cellspacing='0'>";
    $html  .= "<tr><th>No</th><th>Nama Peminjam</th><th>Alamat Peminjam</th><th>Buku yang dipinjam</th><th>Tanggal di pinjam</th><th>Status</th></tr>";
    $no = 1;
    foreach ($data as $peminjaman) {
        // Periksa apakah tanggal pengembalian tidak ada (belum dikembalikan)
        if ($peminjaman['TanggalPengembalian'] == null) {
            $html .= "<tr>";
            $html .= "<td>".$no."</td>";
            $html .= "<td>".$peminjaman['NamaLengkap']."</td>";
            $html .= "<td>".$peminjaman['Alamat']."</td>";
            $html .= "<td>".$peminjaman['Judul']."</td>";
            $html .= "<td>".date('d-m-Y', strtotime($peminjaman['TanggalPeminjaman']))."</td>";
            $html .= "<td>".$peminjaman['StatusPeminjaman']."</td>";
            $html .= "</tr>";
            $no++;
        }
    }
    $html  .= "</table>";
    $html  .= "</center>";
    $html  .= "<p style='font-size: 20px; margin-left: 500px;'>Tanda Tangan</p>";
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // Mengubah '4A' menjadi 'A4' dan 'potrait' menjadi 'portrait'
    $dompdf->render();
    $dompdf->stream('Data Buku Belum Dikembalikan', ['Attachment' => 0]); // Mengubah nama file
}

public function cetaktransaksiselesai()
{
    $data = $this->model('Peminjaman')->get();
    $html 	= "<h1>Kyoto</h1>";
		$html 	.= "<h2>E-Library</h2>";
		$html 	.= "<hr>";
    $html 	.= "<br>";
    $html 	.= "<h3>DAFTAR BUKU(SUDAH DIKEMBALIKAN)</h3>";
    $html 	.= "<center>";
    $html  .= "<table align='center' border='1' cellpadding='10' cellspacing='0'>";
    $html  .= "<tr><th>No</th><th>Nama Peminjam</th><th>Alamat Peminjam</th><th>Buku yang dipinjam</th><th>Tanggal di pinjam</th><th>Tanggal di Kembalikan</th><th>Status</th></tr>";
    $no = 1;
    foreach ($data as $peminjaman) {
        // Periksa apakah tanggal pengembalian tidak null (sudah dikembalikan)
        if ($peminjaman['TanggalPengembalian'] != null) {
            $html .= "<tr>";
            $html .= "<td>".$no."</td>";
            $html .= "<td>".$peminjaman['NamaLengkap']."</td>";
            $html .= "<td>".$peminjaman['Alamat']."</td>";
            $html .= "<td>".$peminjaman['Judul']."</td>";
            $html .= "<td>".date('d-m-Y', strtotime($peminjaman['TanggalPeminjaman']))."</td>";
            $html .= "<td>".date('d-m-Y', strtotime($peminjaman['TanggalPengembalian']))."</td>";
            $html .= "<td>".$peminjaman['StatusPeminjaman']."</td>";
            $html .= "</tr>";
            $no++;
        }
    }
    $html  .= "</table>";
    $html  .= "</center>";
    $html  .= "<center><p style='font-size: 20px;'>Terima Kasih</p></center>";
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // Mengubah '4A' menjadi 'A4' dan 'potrait' menjadi 'portrait'
    $dompdf->render();
    $dompdf->stream('Data Buku Sudah Dikembalikan', ['Attachment' => 0]); // Mengubah nama file
}

public function cetaktransaksiall()
{
    $data = $this->model('Peminjaman')->get();
		$html 	= "<h1>Kyoto</h1>";
		$html 	.= "<h2>E-Library</h2>";
		$html 	.= "<hr>";
    $html 	.= "<br>";
    $html 	.= "<h3>DAFTAR BUKU(ALL)</h3>";
    $html 	.= "<center>";
    $html  .= "<table align='center' border='1' cellpadding='10' cellspacing='0'>";
    $html  .= "<tr><th>No</th><th>Nama Peminjam</th><th>Alamat Peminjam</th><th>Buku yang dipinjam</th><th>Tanggal di pinjam</th><th>Status</th></tr>";
    $no = 1;
    foreach ($data as $peminjaman) {
            $html .= "<tr>";
            $html .= "<td>".$no."</td>";
            $html .= "<td>".$peminjaman['NamaLengkap']."</td>";
            $html .= "<td>".$peminjaman['Alamat']."</td>";
            $html .= "<td>".$peminjaman['Judul']."</td>";
            $html .= "<td>".date('d-m-Y', strtotime($peminjaman['TanggalPeminjaman']))."</td>";
            $html .= "<td>".$peminjaman['StatusPeminjaman']."</td>";
            $html .= "</tr>";
            $no++;
        
    }
    $html  .= "</table>";
    $html  .= "</center>";
    $html  .= "<p style='font-size: 20px; margin-left: 500px;'>Tanda Tangan</p>";
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // Mengubah '4A' menjadi 'A4' dan 'potrait' menjadi 'portrait'
    $dompdf->render();
    $dompdf->stream('Data Buku Belum Dikembalikan', ['Attachment' => 0]); // Mengubah nama file
}

}