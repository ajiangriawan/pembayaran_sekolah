<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

// membuat variabel untuk menampung data dari form
$nama_kelas = $_POST['nama_kelas'];

$sql_check = "SELECT * FROM kelas WHERE nama_kelas = '$nama_kelas'";
$result_check = mysqli_query($koneksi, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
  header("location:tambah_kelas.php?pesan=sudahada");
} else {
  $query = "INSERT INTO kelas VALUES ('','$nama_kelas')";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  } else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil ditambah.');window.location='kelas.php';</script>";
  }
}
