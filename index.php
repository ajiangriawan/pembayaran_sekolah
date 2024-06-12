<?php
session_start();
include 'includes/auth.php';

if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'bendahara':
            header("Location:dashboard_bendahara.php");
            break;
        case 'kepsek':
            header("Location:dashboard_kepala.php");
            break;
        default:
            header("Location:login.php");
            break;
    }
    exit();
} else {
    header("Location:login.php");
    exit();
}
?>
