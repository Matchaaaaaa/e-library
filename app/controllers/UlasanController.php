<?php 
class UlasanController extends Controller
{

  public function index()
  {
    $data = $this->model('KBRelasi')->get();
    $this->view('perpustakaan/home', $data);
  }

  public function detailbuku($id)
  {
    $this->view('perpustakaan/buku', [
      'buku'    => $this->model('Buku')->getById($id),
      'ulasan'  => $this->model('UlasanBuku')->getByBookID($id)
    ]);
  }

  public function ulasanbuku($id)
  {
    $data = $this->model('Buku')->getById($id);
    $this->view('perpustakaan/ulasan', $data);
  }

  public function ulasanstore()
  {
    if ($this->model('Ulasanbuku')->create([
      'UserID'      => $_POST['UserID'],
      'BukuID'      => $_POST['BukuID'],
      'Ulasan'      => $_POST['Ulasan'],
      'Rating'      => $_POST['Rating'],
    ]) > 0) {
      redirectTo('success', 'Selamat, Ulasan Berhasil di Tambahkan', '/perpustakaan/'.$_POST['BukuID'].'/detailbuku');
    } else {
      redirectTo('error', 'Maaf, Ulasan gagal di Tambahkan', '/perpustakaan/'.$_POST['BukuID'].'/detailbuku');
    }
  }

  // Method untuk menghapus ulasan
  public function delete($id)
  {
    if ($this->model('UlasanBukuModel')->delete($id) > 0) {
      redirectTo('success', 'Ulasan berhasil dihapus', '/');
    } else {
      redirectTo('error', 'Maaf, terjadi kesalahan saat menghapus ulasan', '/');
    }
  }

  public function edit($id)
    {
        // Ambil data ulasan berdasarkan ID
        $ulasanModel = $this->model('UlasanBukuModel');
        $ulasan = $ulasanModel->getById($id);

        // Periksa apakah data ulasan ditemukan
        if ($ulasan) {
            // Tampilkan halaman edit ulasan
            $this->view('perpustakaan/edit', ['ulasan' => $ulasan]);
        } else {
            // Redirect ke halaman utama jika data ulasan tidak ditemukan
            redirectTo('error', 'Ulasan tidak ditemukan', '/perpustakaan');
        }
    }

    public function update($id)
    {
        // Ambil data ulasan berdasarkan ID
        $ulasanModel = $this->model('UlasanBukuModel');
        $ulasan = $ulasanModel->getById($id);

        // Periksa apakah data ulasan ditemukan
        if ($ulasan) {
            // Lakukan proses update ulasan
            $updated = $ulasanModel->update($id, [
                'Ulasan' => $_POST['Ulasan'],
                'Rating' => $_POST['Rating']
            ]);

            if ($updated > 0) {
                redirectTo('success', 'Ulasan berhasil diperbarui', '/perpustakaan');
            } else {
                redirectTo('error', 'Terjadi kesalahan saat memperbarui ulasan', '/perpustakaan');
            }
        } else {
            // Redirect ke halaman utama jika data ulasan tidak ditemukan
            redirectTo('error', 'Ulasan tidak ditemukan', '/perpustakaan');
        }
    }

}