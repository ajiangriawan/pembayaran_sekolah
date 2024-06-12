<?php
session_start();

// Check if user is logged in and has the 'bendahara' role
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'bendahara') {
    header("Location:login.php"); // or you could redirect to an unauthorized access page
    exit();
}
include('koneksi.php');
include('includes/header.php');
?>
<div class="awal">
    <div class="main-content bg-body-tertiary border border-primary-subtle shadow-sm rounded">
        <div class="d-flex flex-row flex-wrap align-item-center gap-1 card-dashboard mt-2 p-2">
            <h2>Pembayaran SPP</h2>
            <a href="laporan.php" class="btn btn-success align-items-center">Laporan</a>
        </div>
        <section class="section p-2">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-body-tertiary">
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <h4>Formulir Pembayaran SPP</h4>
                    </div>
                    <form class="row g-3" method="post" action="proses_pembayaran.php" enctype="multipart/form-data">
                        <input name="id_bendahara" value="<?php echo $_SESSION['id']; ?>" hidden />
                        <div class="col-md-4">
                            <label for="nisn" class="form-label">NISN</label>
                            <input id="nisn" name="nisn" class="form-control" type="search" placeholder="Masukan NISN" aria-label="Search" oninput="fetchSPPData()">
                        </div>
                        <div class="col-md-4">
                            <label for="id_spp" class="form-label">Tahun Masuk</label>
                            <input type="text" class="form-control" id="id_spp" name="id_spp" value="" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="nominal" class="form-label">Jumlah yang harus dibayar</label>
                            <input type="text" class="form-control" id="nominal" name="nominal" value="" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="tahun_dibayar" class="form-label">Tahun yang akan dibayar</label>
                            <input type="text" class="form-control" id="tahun_dibayar" name="tahun_dibayar" placeholder="Masukan tahun yang akan dibayar" required>
                        </div>
                        <div class="col-md-4">
                            <label for="bulan_dibayar" class="form-label">Bulan</label>
                            <select id="bulan_dibayar" name="bulan_dibayar" class="form-select" required>
                                <option value="">Silahkan pilih bulan yang akan dibayar</option>
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
                                <option value="Setahun">Setahun</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="jumlah_bayar" class="form-label">Jumlah Pembayaran</label>
                            <input type="int" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Masukan jumlah bayar" required>
                        </div>
                        <div class="col-12">
                            <label for="tgl_bayar" class="form-label">Tanggal Pembayaran</label>
                            <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" placeholder="Masukan jumlah bayar" required>
                        </div>
                        <div class="col-12">
                            <label for="bukti">Upload Bukti Transfer</label>
                            <input type="file" class="form-control" id="bukti" name="bukti" required>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Tambah SPP</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    function fetchSPPData() {
        var nisn = document.getElementById('nisn').value;
        if (nisn.length > 0) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_spp_data.php?nisn=' + nisn, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById('id_spp').value = response.id_spp || '';
                    document.getElementById('nominal').value = response.nominal || '';
                }
            };
            xhr.send();
        } else {
            document.getElementById('id_spp').value = '';
            document.getElementById('nominal').value = '';
        }
    }
</script>

<?php
include('includes/footer.php');
?>