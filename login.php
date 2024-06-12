<?php
session_start();
if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran SPP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-body-tertiary">
    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                    <strong>Perhatian!</strong> Mohon Cek Kembali Username dan Password Anda.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }
        if ($_GET['pesan'] == "belummasuk") {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Perhatian!</strong> Username dan Password Anda Belum Terdaftar.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }
        if ($_GET['pesan'] == "sukses") {
            echo "<div class='alert alert-succes alert-dismissible fade show' role='alert'>
                    <strong>Perhatian!</strong> Anda sudah masuk.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }
    }
    ?>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="col-10 col-xl-8 py-3">
                                <img class="img-fluid rounded mb-4" loading="lazy" src="img/logo.png" width="245" height="80" alt="BootstrapBrain Logo">
                                <hr class="border-primary-subtle mb-4">
                                <h2 class="h1 mb-4">Selamat Datang</h2>
                                <p class="lead m-0">Silahkan Masuk Akun Terlebih Dahulu</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 text-bg-primary">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h3>Log in</h3>
                                    </div>
                                </div>
                            </div>
                            <form action="cek_login.php" method="post">
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="masukan username yang telah diberikan" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password" value="" required>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn bsb-btn-xl btn-light" type="submit">Masuk</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-5 mb-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                        <a href="#!" class="text-light text-decoration-none">Lupa Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>