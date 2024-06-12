<?php
// memanggil file koneksi.php untuk melakukan koneksi database
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

$id_kepsek= $_POST['id_kepsek'];
$username_kepsek= $_POST['username'];
$password           = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
$nama_kepsek    = $_POST['nama'];
$alamat_kepsek  = $_POST['alamat'];
$no_telp_kepsek = $_POST['no_telp'];

// Check if the username already exists
$sql_check = "SELECT * FROM users WHERE username = '$username_kepsek'";
$result_check = mysqli_query($koneksi, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    header("location:edit_kepsek.php?pesan=sudahada");
    exit();
} else {
    // Update query for users table
    $query_users = "UPDATE users SET username = '$username_kepsek'";
    if ($password) {
        $query_users .= ", password = '$password'";
    }
    $query_users .= "WHERE id = '$id_kepsek'";
    $result_users = mysqli_query($koneksi, $query_users);

    // Update query for kepsektable
    $query_kepsek= "UPDATE kepala_sekolah SET 
                        id_kepsek= '$id_kepsek', 
                        username_kepsek= '$username_kepsek',
                        nama_kepsek= '$nama_kepsek', 
                        alamat_kepsek= '$alamat_kepsek', 
                        no_telp_kepsek= '$no_telp_kepsek' 
                        WHERE id_kepsek= '$id_kepsek'";
    $result_kepsek= mysqli_query($koneksi, $query_kepsek);
}

// Check if the queries were successful
if (!$result_users || !$result_kepsek) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    echo "<script>alert('Data berhasil diubah.');window.location='kepsek.php';</script>";
}
