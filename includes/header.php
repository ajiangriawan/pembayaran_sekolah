<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pembayaran SPP - MI Marfuah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                MI Marfuah
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <img src="img/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MI Marfuah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <?php if (isset($_SESSION['username'])) : ?>
                            <?php if ($_SESSION['role'] == 'bendahara') : ?>
                                <li class="nav-item"><a class="nav-link" href="dashboard_bendahara.php">Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link" href="pembayaran.php">Pembayaran</a></li>
                                <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
                                <li class="nav-item"><a class="nav-link" href="kelas.php">Data Kelas</a></li>
                                <li class="nav-item"><a class="nav-link" href="siswa.php">Data Siswa</a></li>
                                <li class="nav-item"><a class="nav-link" href="bendahara.php">Data Bendahara</a></li>
                                <li class="nav-item"><a class="nav-link" href="kepsek.php">Data Kepala Sekolah</a></li>
                                <li class="nav-item"><a class="nav-link" href="spp.php">Data SPP</a></li>
                            <?php elseif ($_SESSION['role'] == 'kepsek') : ?>
                                <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
                            <?php endif; ?>
                            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php else : ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">