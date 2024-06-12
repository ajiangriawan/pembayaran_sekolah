<?php
// memanggil file koneksi.php untuk melakukan koneksi database
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

$id_bendahara = $_POST['id_bendahara'];
$username_bendahara = $_POST['username'];
$password           = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
$nama_bendahara     = $_POST['nama'];
$alamat_bendahara   = $_POST['alamat'];
$no_telp_bendahara  = $_POST['no_telp'];

// Check if the username already exists
$sql_check = "SELECT * FROM users WHERE username = '$username_bendahara'";
$result_check = mysqli_query($koneksi, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    header("location:edit_bendahara.php?pesan=sudahada");
    exit();
} else {
    // Update query for users table
    $query_users = "UPDATE users SET username = '$username_bendahara'";
    if ($password) {
        $query_users .= ", password = '$password'";
    }
    $query_users .= "WHERE id = '$id_bendahara'";
    $result_users = mysqli_query($koneksi, $query_users);

    // Update query for bendahara table
    $query_bendahara = "UPDATE bendahara SET 
                        id_bendahara = '$id_bendahara', 
                        username_bendahara = '$username_bendahara',
                        nama_bendahara = '$nama_bendahara', 
                        alamat_bendahara = '$alamat_bendahara', 
                        no_telp_bendahara = '$no_telp_bendahara' 
                        WHERE id_bendahara = '$id_bendahara'";
    $result_bendahara = mysqli_query($koneksi, $query_bendahara);
}

// Check if the queries were successful
if (!$result_users || !$result_bendahara) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    echo "<script>alert('Data berhasil diubah.');window.location='bendahara.php';</script>";
}
