<?php
session_start();
include 'koneksi.php';
include 'includes/header.php';

if (isset($_GET['id'])) {
  $id = ($_GET["id"]);

  $query = "SELECT * FROM kepala_sekolah WHERE id_kepsek='$id'";
  $result = mysqli_query($koneksi, $query);
  if (!$result) {
    die("Query Error: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  }
  $data = mysqli_fetch_assoc($result);
  if (!count($data)) {
    echo "<script>alert('Data tidak ditemukan pada database');window.location='kepsek.php';</script>";
  }
} else {
  echo "<script>alert('Masukkan data id.');window.location='kepsek.php';</script>";
}
?>

<div class="awal">
  <?php
  if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "sudahada") {
      echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                <strong>Perhatian!</strong> Username sudah digunakan. Silahkan gunakan username yang lain.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
  }
  ?>
  <div class="main-content bg-body-tertiary border border-primary-subtle shadow-sm rounded">
    <div class="d-flex flex-row flex-wrap align-item-center gap-1 card-dashboard mt-2 p-2">
      <h2>Edit kepsek</h2>
      <a href="kepsek.php" class="btn btn-success align-items-center">Data kepsek</a>
    </div>
    <section class="section p-2">
      <div class="row">
        <div class="col-12">
          <div class="card bg-body-tertiary">
          </div>
          <div class="text-center mt-4 mb-4">
            <h4>Formulir Edit kepsek</h4>
          </div>
          <form class="row g-3" method="post" action="proses_editkepsek.php">
            <input name="id_kepsek" value="<?php echo $data['id_kepsek']; ?>" hidden />
            <div class="col-12">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username kepsek" value="<?php echo $data['username_kepsek']; ?>" required>
            </div>
            <div class="col-12">
              <label for="password" class="form-label">Password</label>
              <input type="text" class="form-control" id="password" name="password" value="">
            </div>
            <div class="col-12">
              <label for="nama" class="form-label">Nama kepsek</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama kepsek" value="<?php echo $data['nama_kepsek']; ?>" required>
            </div>
            <div class="col-12">
              <label for="alamat" class="form-label">Alamat kepsek</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat bendahar" value="<?php echo $data['alamat_kepsek']; ?>" required>
            </div>
            <div class="col-md-12">
              <label for="no_telp" class="form-label">No Telepon kepsek</label>
              <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan nomor telepon" value="<?php echo $data['no_telp_kepsek']; ?>" required>
            </div>
            <div class="col-12 text-end">
              <button type="submit" class="btn btn-primary">Edit kepsek</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>
<?php include 'includes/footer.php' ?>