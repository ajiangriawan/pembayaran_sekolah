<?php
session_start();
include 'koneksi.php';
include 'includes/header.php';

// mengecek apakah di url ada nilai GET id
if (isset($_GET['id'])) {
  // ambil nilai id dari url dan disimpan dalam variabel $id
  $id = ($_GET["id"]);

  // menampilkan data dari database yang mempunyai id=$id
  $query = "SELECT * FROM siswa,kelas,spp where siswa.nisn='$id' AND siswa.id_kelas=kelas.id_kelas AND siswa.id_spp=spp.id_spp";
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
    echo "<script>alert('Data tidak ditemukan pada database');window.location='siswa.php';</script>";
  }
} else {
  // apabila tidak ada data GET id pada akan di redirect ke index.php
  echo "<script>alert('Masukkan data id.');window.location='siswa.php';</script>";
}
?>

<div class="awal">
  <div class="main-content bg-body-tertiary border border-primary-subtle shadow-sm rounded">
    <div class="d-flex flex-row flex-wrap align-item-center gap-1 card-dashboard mt-2 p-2">
      <h2>Edit Siswa</h2>
      <a href="siswa.php" class="btn btn-success align-items-center">Data Siswa</a>
    </div>
    <section class="section p-2">
      <div class="row">
        <div class="col-12">
          <div class="card bg-body-tertiary">
          </div>
          <div class="text-center mt-4 mb-4">
            <h4>Formulir Edit Siswa</h4>
          </div>
          <form class="row g-3" method="post" action="proses_editsiswa.php">
            <input name="id" value="<?php echo $data['nisn']; ?>" hidden />
            <div class="col-12">
              <label for="nisn" class="form-label">NISN</label>
              <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukan nisn" value="<?php echo $data['nisn']; ?>" required>
            </div>
            <div class="col-12">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama siswa" value="<?php echo $data['nama']; ?>" required>
            </div>
            <div class="col-12">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat siswa" value="<?php echo $data['alamat']; ?>" required>
            </div>
            <div class="col-md-4">
              <label for="no_telp" class="form-label">No Telepon</label>
              <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan nomor telepon" value="<?php echo $data['no_telp'] ?>" required>
            </div>
            <div class="col-md-4">
              <label for="id_kelas" class="form-label">Id Kelas</label>
              <select name="id_kelas" id="id_kelas" class="form-select">

                <?php
                $kelasselected = $data['id_kelas'];
                // jalankan query untuk menampilkan semua data diurutkan berdasarkan id
                $query = "SELECT * FROM kelas ORDER BY nama_kelas ASC";
                $result = mysqli_query($koneksi, $query);
                //mengecek apakah ada error ketika menjalankan query
                if (!$result) {
                  die("Query Error: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
                }

                //buat perulangan untuk element tabel dari data mahasiswa
                $no = 1; //variabel untuk membuat nomor urut
                // hasil query akan disimpan dalam variabel $data dalam bentuk array
                // kemudian dicetak dengan perulangan while
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <option value="<?php echo $row['id_kelas']; ?>" <?php if ($row['id_kelas'] == "$kelasselected") { ?> selected="selected" <?php } ?>><?php echo $row['nama_kelas']; ?></option>
                <?php
                  $no++; //untuk nomor urut terus bertambah 1
                }
                ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="tahun" class="form-label">Tahun Masuk</label>
              <select name="tahun" class="form-select">

                <?php
                $kelasselected = $data['id_spp'];
                // jalankan query untuk menampilkan semua data diurutkan berdasarkan id
                $query = "SELECT * FROM spp ORDER BY tahun ASC";
                $result = mysqli_query($koneksi, $query);
                //mengecek apakah ada error ketika menjalankan query
                if (!$result) {
                  die("Query Error: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
                }

                //buat perulangan untuk element tabel dari data mahasiswa
                $no = 1; //variabel untuk membuat nomor urut
                // hasil query akan disimpan dalam variabel $data dalam bentuk array
                // kemudian dicetak dengan perulangan while
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <option value="<?php echo $row['id_spp']; ?>" <?php if ($row['id_spp'] == "$kelasselected") { ?> selected="selected" <?php } ?>><?php echo $row['tahun']; ?></option>
                <?php
                  $no++; //untuk nomor urut terus bertambah 1
                }
                ?>
              </select>
            </div>

            <div class="col-12 text-end">
              <button type="submit" class="btn btn-primary">Ubah Siswa</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>
<?php include 'includes/footer.php' ?>