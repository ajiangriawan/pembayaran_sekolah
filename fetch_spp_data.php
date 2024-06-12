<?php
include 'koneksi.php';

if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];

    // Fetch student data from the database based on the NISN
    $query_siswa = "SELECT id_spp FROM siswa WHERE nisn='$nisn'";
    $result_siswa = mysqli_query($koneksi, $query_siswa);

    if ($result_siswa) {
        $data_siswa = mysqli_fetch_assoc($result_siswa);
        if ($data_siswa) {
            $id_spp = $data_siswa['id_spp'];

            // Fetch SPP data based on the id_spp
            $query_spp = "SELECT id_spp, nominal FROM spp WHERE id_spp='$id_spp'";
            $result_spp = mysqli_query($koneksi, $query_spp);

            if ($result_spp) {
                $data_spp = mysqli_fetch_assoc($result_spp);
                if ($data_spp) {
                    echo json_encode($data_spp);
                } else {
                    echo json_encode(['id_spp' => '', 'nominal' => '']);
                }
            } else {
                echo json_encode(['id_spp' => '', 'nominal' => '']);
            }
        } else {
            echo json_encode(['id_spp' => '', 'nominal' => '']);
        }
    } else {
        echo json_encode(['id_spp' => '', 'nominal' => '']);
    }
} else {
    echo json_encode(['id_spp' => '', 'nominal' => '']);
}
