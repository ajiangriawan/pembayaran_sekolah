<?php
include 'koneksi.php';

$nisn = $_POST['nisn'];
$nama = $_POST['nama'];
$id_kelas = $_POST['id_kelas'];
$alamat = $_POST['alamat'];
$telp = $_POST['no_telp'];
$id_spp = $_POST['tahun']; 

// Cek apakah nisn sudah ada di database
$sql_check = "SELECT * FROM siswa WHERE nisn = '$nisn'";
$result_check = mysqli_query($koneksi, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
  header("location:tambah_siswa.php?pesan=sudahada");
} else {
  $sql_siswa = "INSERT INTO siswa (nisn, nama, id_kelas, alamat, no_telp, id_spp) VALUES ('$nisn', '$nama', '$id_kelas', '$alamat', '$telp', '$id_spp')";
  $result_siswa = mysqli_query($koneksi, $sql_siswa);

  // periksa query apakah ada error
  if (!$result_siswa) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
  } else {
    // tampil alert dan akan redirect ke halaman siswa.php
    echo "<script>alert('Data berhasil ditambah.');window.location='siswa.php';</script>";
  }
}

// Tutup koneksi setelah semua query selesai
$koneksi->close();
