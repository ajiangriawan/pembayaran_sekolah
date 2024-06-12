<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    if (password_verify($password, $data['password'])) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $data['role'];

        switch ($data['role']) {
            case "bendahara":
                header("location:dashboard_bendahara.php");
                break;
            case "kepsek":
                header("location:dashboard_kepala.php");
                break;
            default:
                header("location:login.php?pesan=gagal");
                break;
        }
        exit();
    } else {
        header("location:login.php?pesan=gagal");
    }
} else {
    header("location:login.php?pesan=belummasuk");
}
?>
