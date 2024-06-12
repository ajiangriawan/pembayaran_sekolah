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
                <strong>Perhatian!</strong> NISN sudah digunakan. Silahkan gunakan nisn yang lain.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
  }
  ?>
  <div class="main-content bg-body-tertiary border border-primary-subtle shadow-sm rounded">
    <div class="d-flex flex-row flex-wrap align-item-center gap-1 card-dashboard mt-2 p-2">
      <h2>Tambah Siswa</h2>
      <a href="siswa.php" class="btn btn-success align-items-center">Data Siswa</a>
    </div>
    <section class="section p-2">
      <div class="row">
        <div class="col-12">
          <div class="card bg-body-tertiary">
          </div>
          <div class="text-center mt-4 mb-4">
            <h4>Formulir Tambah Siswa</h4>
          </div>
          <form class="row g-3" method="post" action="proses_tambahsiswa.php">
            <div class="col-12">
              <label for="nisn" class="form-label">NISN</label>
              <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukan nisn" required>
            </div>
            <div class="col-12">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama siswa" required>
            </div>
            <div class="col-12">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat siswa" required>
            </div>
            <div class="col-md-4">
              <label for="no_telp" class="form-label">No Telepon</label>
              <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan nomor telepon" required>
            </div>
            <div class="col-md-4">
              <label for="id_kelas" class="form-label">Id Kelas</label>
              <select id="id_kelas" name="id_kelas" class="form-select" required>
                <option value="">Silahkan pilih kelas</option>
                <?php
                // jalankan query untuk menampilkan semua data diurutkan berdasarkan
                $query = "SELECT * FROM kelas ORDER BY nama_kelas ASC";
                $result = mysqli_query($koneksi, $query);
                //mengecek apakah ada error ketika menjalankan query
                if (!$result) {
                  die("Query Error: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
                }

                //buat perulangan untuk element tabel dari data mahasiswa
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <option value="<?php echo $row['id_kelas']; ?>"><?php echo $row['nama_kelas']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="tahun" class="form-label">Tahun Masuk</label>
              <select id="tahun" name="tahun" class="form-select" required>
                <option value="">Silahkan pilih tahun masuk</option>
                <?php
                // jalankan query untuk menampilkan semua data diurutkan berdasarkan
                $query = "SELECT * FROM spp ORDER BY tahun ASC";
                $result = mysqli_query($koneksi, $query);
                //mengecek apakah ada error ketika menjalankan query
                if (!$result) {
                  die("Query Error: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
                }

                //buat perulangan untuk element tabel dari data mahasiswa
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <option value="<?php echo $row['id_spp']; ?>"><?php echo $row['tahun']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>

            <div class="col-12 text-end">
              <button type="submit" class="btn btn-primary">Tambah Siswa</button>
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