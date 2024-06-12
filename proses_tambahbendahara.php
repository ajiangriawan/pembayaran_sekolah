<?php
include 'koneksi.php';

// Mengambil nilai dari form
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['no_telp'];
$username = $_POST['username'];

// Membuat hash untuk password default 'bendahara'
$password = password_hash('bendahara', PASSWORD_DEFAULT);

// Query untuk mengecek apakah username sudah ada di database
$sql_check = "SELECT * FROM users WHERE username = '$username'";
$result_check = mysqli_query($koneksi, $sql_check);

// Memeriksa apakah ada hasil yang dikembalikan dari query
if (mysqli_num_rows($result_check) > 0) {
    // Jika username sudah ada, redirect kembali ke halaman tambah_bendahara.php dengan pesan 'sudahada'
    header("location:tambah_bendahara.php?pesan=sudahada");
} else {
    // Jika username belum ada, lanjutkan dengan menambahkan data ke dalam tabel users
    $sql_users = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'bendahara')";

    // Eksekusi query untuk menambahkan data ke dalam tabel users
    if ($koneksi->query($sql_users) === TRUE) {
        // Ambil id pengguna yang baru ditambahkan
        $id_pengguna = mysqli_insert_id($koneksi);

        // Query untuk menambahkan data ke dalam tabel bendahara
        $sql_bendahara = "INSERT INTO bendahara (id_bendahara, username_bendahara, nama_bendahara, alamat_bendahara, no_telp_bendahara) VALUES ('$id_pengguna', '$username','$nama', '$alamat', '$telp')";

        // Eksekusi query untuk menambahkan data ke dalam tabel bendahara
        $result_bendahara = mysqli_query($koneksi, $sql_bendahara);

        // Periksa apakah query berhasil dijalankan
        if (!$result_bendahara) {
            // Jika query gagal, tampilkan pesan error
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else {
            // Jika query berhasil, tampilkan alert dan redirect ke halaman bendahara.php
            echo "<script>alert('Data berhasil ditambah.');window.location='bendahara.php';</script>";
        }
    } else {
        // Jika query untuk menambahkan data ke dalam tabel users gagal, tampilkan pesan error
        echo "Error: " . $sql_users . "<br>" . $koneksi->error;
    }
}

// Tutup koneksi setelah semua query selesai
$koneksi->close();
?>
