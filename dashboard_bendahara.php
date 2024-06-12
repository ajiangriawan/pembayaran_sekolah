<?php
session_start();

// Check if user is logged in and has the 'bendahara' role
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'bendahara') {
    header("Location:login.php");
    exit();
}

include 'koneksi.php';
include 'includes/header.php';
?>
<div class="awal">
    <div class="container">
        <h2>Overview</h2>
        <div class="d-flex flex-row flex-wrap align-item-center gap-1 card-dashboard mt-2">
            <div class="card text-bg-primary mb-3" style="width: 14rem;">
                <div class="card-header">Total Kelas</div>
                <div class="card-body">
                    <h3 class="card-title">
                        <?php
                        $totalKelas = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kelas");
                        echo mysqli_fetch_assoc($totalKelas)['total'];
                        ?>
                    </h3>
                </div>
            </div>
            <div class="card text-bg-success mb-3" style="width: 14rem;">
                <div class="card-header">Total Siswa</div>
                <div class="card-body">
                    <h3 class="card-title">
                        <?php
                        $totalSiswa = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa");
                        echo mysqli_fetch_assoc($totalSiswa)['total'];
                        ?>
                    </h3>
                </div>
            </div>
            <div class="card text-bg-danger mb-3" style="width: 14rem;">
                <div class="card-header">Total Bendahara</div>
                <div class="card-body">
                    <h3 class="card-title">
                        <?php
                        $totalBendahara = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users WHERE role='bendahara'");
                        echo mysqli_fetch_assoc($totalBendahara)['total'];
                        ?>
                    </h3>
                </div>
            </div>
            <div class="card text-bg-secondary mb-3" style="width: 14rem;">
                <div class="card-header">Total Kepala Sekolah</div>
                <div class="card-body">
                    <h3 class="card-title">
                        <?php
                        $totalBendahara = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users WHERE role='kepsek'");
                        echo mysqli_fetch_assoc($totalBendahara)['total'];
                        ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row flex-wrap align-item-center gap-1 card-dashboard mt-2">
            <h2>Data Kelas</h2>
            <select class="form-select" aria-label="Default select example" id="data_kelas">
                <option selected value='all'>Pilih Data Kelas</option>
                <?php
                $query = "SELECT * FROM kelas ORDER BY nama_kelas ASC";
                $result = mysqli_query($koneksi, $query);
                if (!$result) {
                    die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id_kelas']}'>{$row['nama_kelas']}</option>";
                }
                ?>
            </select>
        </div>
        <section class="section p-2">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-body-tertiary">
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <h4>List Siswa</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="student_table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NISN</th>
                                        <th>NAMA</th>
                                        <th>KELAS</th>
                                        <th>ALAMAT</th>
                                        <th>NO TELP</th>
                                        <th>SPP</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="student_list">
                                    <!-- Data Siswa akan dimuat di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to fetch students based on the selected class
        function fetchStudents(id_kelas) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_students.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var students = JSON.parse(xhr.responseText);
                    var studentList = document.getElementById('student_list');
                    studentList.innerHTML = ''; // Clear the previous list

                    if (students.length > 0) {
                        students.forEach(function(student, index) {
                            var row = document.createElement('tr');
                            row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${student.nisn}</td>
                            <td>${student.nama}</td>
                            <td>${student.nama_kelas}</td>
                            <td>${student.alamat}</td>
                            <td>${student.no_telp}</td>
                            <td>${student.nominal}</td>
                            <td>
                                <a href="edit_siswa.php?id=${student.nisn}" class="btn btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="proses_hapussiswa.php?id=${student.nisn}" class="btn btn-danger" onClick="return confirm('Anda yakin akan menghapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        `;
                            studentList.appendChild(row);
                        });
                    } else {
                        studentList.innerHTML = '<tr><td colspan="8" class="text-center">Tidak ada siswa dalam kelas ini</td></tr>';
                    }
                }
            };
            xhr.send('id_kelas=' + id_kelas);
        }

        // Initial fetch to load all students
        fetchStudents('all');

        // Fetch students based on selected class
        document.getElementById('data_kelas').addEventListener('change', function() {
            var id_kelas = this.value;
            fetchStudents(id_kelas);
        });
    });
</script>

<?php
include 'includes/footer.php';
?>