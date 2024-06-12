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
                <strong>Perhatian!</strong> Nama Kelas sudah digunakan. Silahkan gunakan nama kelas yang lain.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
  }
  ?>
  <div class="main-content bg-body-tertiary border border-primary-subtle shadow-sm rounded">
    <div class="d-flex flex-row flex-wrap align-item-center gap-1 card-dashboard mt-2 p-2">
      <h2>Tambah Kelas</h2>
      <a href="kelas.php" class="btn btn-success align-items-center">Data Kelas</a>
    </div>
    <section class="section p-2">
      <div class="row">
        <div class="col-12">
          <div class="card bg-body-tertiary">
          </div>
          <div class="text-center mt-4 mb-4">
            <h4>Formulir Tambah Kelas</h4>
          </div>
          <form class="row g-3" method="post" action="proses_tambahkelas.php">
            <div class="col-12">
              <label for="nama_kelas" class="form-label">Nama Kelas</label>
              <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukan nama kelas" required>
            </div>
            <div class="col-12 text-end">
              <button type="submit" class="btn btn-primary">Tambah Kelas</button>
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