<?php
include 'koneksi.php';

// Mengambil ID yang ingin dihapus
$id = $_GET["id"];

// Jalankan query DELETE untuk menghapus data dari tabel kepsek
$query_kepsek = "DELETE FROM kepala_sekolah WHERE id_kepsek='$id'";
$hasil_query_kepsek = mysqli_query($koneksi, $query_kepsek);

// Jalankan query DELETE untuk menghapus data dari tabel users
$query_users = "DELETE FROM users WHERE id='$id'";
$hasil_query_users = mysqli_query($koneksi, $query_users);

// Periksa apakah terjadi kesalahan saat menjalankan query
if (!$hasil_query_kepsek || !$hasil_query_users) {
    // Jika ada kesalahan, tampilkan pesan error
    die("Gagal menghapus data: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    // Jika berhasil, tampilkan pesan berhasil dan redirect ke halaman kepsek.php
    echo "<script>alert('Data berhasil dihapus.');window.location='kepsek.php';</script>";
}
?>
