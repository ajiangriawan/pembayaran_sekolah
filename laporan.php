<?php
session_start();

// Check if user is logged in and has the 'bendahara' or 'kepsek' role
if (!(isset($_SESSION['id']) && ($_SESSION['role'] === 'bendahara' || $_SESSION['role'] === 'kepsek'))) {
    header("Location:login.php"); // or you could redirect to an unauthorized access page
    exit();
}

include('koneksi.php');
include('includes/header.php');

// Handle filter form submission
$filter_tahun = $_GET['filter_tahun'] ?? '';
$filter_bulan = $_GET['filter_bulan'] ?? '';

// Constructing the SQL query based on the filters
$sql = "SELECT siswa.nisn, siswa.nama, spp.tahun, pembayaran.tahun_dibayar, pembayaran.bulan_dibayar, pembayaran.jumlah_bayar, pembayaran.tgl_bayar, pembayaran.bukti 
        FROM siswa
        INNER JOIN pembayaran ON siswa.nisn = pembayaran.nisn
        INNER JOIN spp ON siswa.id_spp = spp.id_spp";

if (!empty($filter_tahun)) {
    $sql .= " WHERE pembayaran.tahun_dibayar = '$filter_tahun'";
    if (!empty($filter_bulan)) {
        $sql .= " AND pembayaran.bulan_dibayar = '$filter_bulan'";
    }
}

$result = $koneksi->query($sql);

?>

<div class="awal">
    <div class="main-content bg-body-tertiary border border-primary-subtle shadow-sm rounded">
        <div class="d-flex flex-row flex-wrap align-item-center gap-1 card-dashboard mt-2 p-2">
            <h2>Laporan Pembayaran SPP</h2>
        </div>
        <section class="section p-2">
            <div class="row">
                <div class="col-12">
                    <form class="row g-3" method="get" action="">
                        <div class="col-md-4">
                            <label for="filter_tahun" class="form-label">Filter Tahun Pembayaran</label>
                            <input type="text" class="form-control" id="filter_tahun" name="filter_tahun" value="<?php echo $filter_tahun; ?>" placeholder="Masukan tahun pembayaran">
                        </div>
                        <div class="col-md-4">
                            <label for="filter_bulan" class="form-label">Filter Bulan Pembayaran</label>
                            <select id="filter_bulan" name="filter_bulan" class="form-select">
                                <option value="">Pilih Bulan</option>
                                <option value="Januari" <?php echo ($filter_bulan == 'Januari') ? 'selected' : ''; ?>>Januari</option>
                                <option value="Februari" <?php echo ($filter_bulan == 'Februari') ? 'selected' : ''; ?>>Februari</option>
                                <option value="Maret" <?php echo ($filter_bulan == 'Maret') ? 'selected' : ''; ?>>Maret</option>
                                <option value="April" <?php echo ($filter_bulan == 'April') ? 'selected' : ''; ?>>April</option>
                                <option value="Mei" <?php echo ($filter_bulan == 'Mei') ? 'selected' : ''; ?>>Mei</option>
                                <option value="Juni" <?php echo ($filter_bulan == 'Juni') ? 'selected' : ''; ?>>Juni</option>
                                <option value="Juli" <?php echo ($filter_bulan == 'Juli') ? 'selected' : ''; ?>>Juli</option>
                                <option value="Agustus" <?php echo ($filter_bulan == 'Agustus') ? 'selected' : ''; ?>>Agustus</option>
                                <option value="September" <?php echo ($filter_bulan == 'September') ? 'selected' : ''; ?>>September</option>
                                <option value="Oktober" <?php echo ($filter_bulan == 'Oktober') ? 'selected' : ''; ?>>Oktober</option>
                                <option value="November" <?php echo ($filter_bulan == 'November') ? 'selected' : ''; ?>>November</option>
                                <option value="Desember" <?php echo ($filter_bulan == 'Desember') ? 'selected' : ''; ?>>Desember</option>
                            </select>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="section p-2">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-body-tertiary">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Tahun Masuk</th>
                                        <th>Tahun Dibayar</th>
                                        <th>Bulan Dibayar</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Bukti Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Check if there are rows returned from the query
                                    if ($result->num_rows > 0) {
                                        // Loop through each row of the result set
                                        while ($row = $result->fetch_assoc()) {
                                            // Output data for each row
                                            echo "<tr>";
                                            echo "<td>" . $row["nisn"] . "</td>";
                                            echo "<td>" . $row["nama"] . "</td>";
                                            echo "<td>" . $row["tahun"] . "</td>";
                                            echo "<td>" . $row["tahun_dibayar"] . "</td>";
                                            echo "<td>" . $row["bulan_dibayar"] . "</td>";
                                            echo "<td>" . $row["jumlah_bayar"] . "</td>";
                                            echo "<td>" . $row["tgl_bayar"] . "</td>";
                                            echo "<td><a href='img/uploads/" . $row["bukti"] . "'>View</a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>Tidak ada data pembayaran.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
include('includes/footer.php');
?>