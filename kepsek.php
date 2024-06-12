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
      <h2>Data Kepala Sekolah</h2>
      <a href="tambah_kepsek.php" class="btn btn-success align-items-center">Tambah Kepala Sekolah</a>
    </div>
    <section class="section p-2">
      <div class="row">
        <div class="col-12">
          <div class="card bg-body-tertiary">
          </div>
          <div class="text-center mt-4 mb-4">
            <h4>List Kepala Sekolah</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>USERNAME</th>
                    <th>NAMA</th>
                    <th>ALAMAT</th>
                    <th>NO TELP</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT * FROM kepala_sekolah";
                  $result = mysqli_query($koneksi, $query);
                  if (!$result) {
                    die("Query Error: " . mysqli_errno($koneksi) .
                      " - " . mysqli_error($koneksi));
                  }
                  $no = 1;
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $row['username_kepsek']; ?></td>
                      <td><?php echo $row['nama_kepsek']; ?></td>
                      <td><?php echo $row['alamat_kepsek']; ?></td>
                      <td><?php echo $row['no_telp_kepsek']; ?></td>
                      <td>
                        <a href="edit_kepsek.php?id=<?php echo $row['id_kepsek']; ?>" class="btn btn-primary">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="proses_hapuskepsek.php?id=<?php echo $row['id_kepsek']; ?>" class="btn btn-danger" onClick="return confirm('Anda yakin akan menghapus data ini?')">
                          <i class="bi bi-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php
                    $no++; //untuk nomor urut terus bertambah 1
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

<?php include 'includes/footer.php'?>