<?php
include 'koneksi.php';

$id_kelas = $_POST['id_kelas'];

if ($id_kelas === 'all' || $id_kelas === '') {
    $query = "SELECT siswa.*, kelas.nama_kelas, spp.nominal FROM siswa 
              JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
              JOIN spp ON siswa.id_spp = spp.id_spp 
              ORDER BY siswa.nisn ASC";
} else {
    $query = "SELECT siswa.*, kelas.nama_kelas, spp.nominal FROM siswa 
              JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
              JOIN spp ON siswa.id_spp = spp.id_spp 
              WHERE siswa.id_kelas = '$id_kelas' 
              ORDER BY siswa.nisn ASC";
}

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
