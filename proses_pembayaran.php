<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nisn = $_POST['nisn'];
    $id_bendahara = $_POST['id_bendahara'];
    $tgl_bayar = $_POST['tgl_bayar'];
    $tahun_dibayar = $_POST['tahun_dibayar'];
    $bulan_dibayar = $_POST['bulan_dibayar'];
    $id_spp = $_POST['id_spp'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    $bukti = $_FILES['bukti']['name'];
    $target_dir = "img/uploads/";
    $target_file = $target_dir . basename($bukti);
    move_uploaded_file($_FILES['bukti']['tmp_name'], $target_file);

    $sql = "INSERT INTO pembayaran (id_bendahara, nisn, tgl_bayar, bulan_dibayar, tahun_dibayar, id_spp, jumlah_bayar, bukti)
     VALUES ('$id_bendahara', '$nisn', '$tgl_bayar', '$bulan_dibayar', '$tahun_dibayar', '$id_spp', '$jumlah_bayar', '$bukti')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Pembayaran berhasil');window.location='pembayaran.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    $koneksi->close();
}
