<?php
session_start();
include 'koneksi.php';
include 'includes/header.php';

// mengecek apakah di url ada nilai GET id
if (isset($_GET['id'])) {
  // ambil nilai id dari url dan disimpan dalam variabel $id
  $id = ($_GET["id"]);

  // menampilkan data dari database yang mempunyai id=$id
  $query = "SELECT * FROM kelas WHERE id_kelas='$id'";
  $result = mysqli_query($koneksi, $query);
  // jika data gagal diambil maka akan tampil error berikut
  if (!$result) {
    die("Query Error: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  }
  // mengambil data dari database
  $data = mysqli_fetch_assoc($result);
  // apabila data tidak ada pada database maka akan dijalankan perintah ini
  if (!count($data)) {
    echo "<script>alert('Data tidak ditemukan pada database');window.location='kelas.php';</script>";
  }
} else {
  // apabila tidak ada data GET id pada akan di redirect ke index.php
  echo "<script>alert('Masukkan data id.');window.location='kelas.php';</script>";
}
?>

<div class="awal">
  <div class="main-content bg-body-tertiary border border-primary-subtle shadow-sm rounded">
    <div class="d-flex flex-row flex-wrap align-item-center gap-1 card-dashboard mt-2 p-2">
      <h2>Edit Kelas</h2>
      <a href="kelas.php" class="btn btn-success align-items-center">Data Kelas</a>
    </div>
    <section class="section p-2">
      <div class="row">
        <div class="col-12">
          <div class="card bg-body-tertiary">
          </div>
          <div class="text-center mt-4 mb-4">
            <h4>Formulir Edit Kelas</h4>
          </div>
          <form class="row g-3" method="post" action="proses_editkelas.php">
            <input name="id" value="<?php echo $data['id_kelas']; ?>" hidden />
            <div class="col-12">
              <label for="nama_kelas" class="form-label">Nama Kelas</label>
              <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukan nama kelas" value="<?php echo $data['nama_kelas']; ?>" required>
            </div>
            <div class="col-12 text-end">
              <button type="submit" class="btn btn-primary">Ubah Kelas</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>

<?php include 'includes/footer.php' ?>