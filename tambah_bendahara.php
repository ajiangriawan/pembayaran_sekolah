<?php
session_start();

// Check if user is logged in and has the 'bendahara' role
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'bendahara') {
    header("Location:login.php"); // or you could redirect to an unauthorized access page
    exit();
}
include('koneksi.php');
include('includes/header.php');
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
      <h2>Tambah Bendahara</h2>
      <a href="bendahara.php" class="btn btn-success align-items-center">Data Bendahara</a>
    </div>
    <section class="section p-2">
      <div class="row">
        <div class="col-12">
          <div class="card bg-body-tertiary">
          </div>
          <div class="text-center mt-4 mb-4">
            <h4>Formulir Tambah Bendahara</h4>
          </div>
          <form class="row g-3" method="post" action="proses_tambahbendahara.php">
            <div class="col-12">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username bendahara" required>
            </div>
            <div class="col-12">
              <label for="nama" class="form-label">Nama Bendahara</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama bendahara" required>
            </div>
            <div class="col-12">
              <label for="alamat" class="form-label">Alamat Bendahara</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat bendahar" required>
            </div>
            <div class="col-md-12">
              <label for="no_telp" class="form-label">No Telepon Bendahara</label>
              <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan nomor telepon" required>
            </div>
            <div class="col-12 text-end">
              <button type="submit" class="btn btn-primary">Tambah Bendahara</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>

<?php
include('includes/footer.php');
?>