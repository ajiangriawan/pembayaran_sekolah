<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location:login.php");
    exit();
}

// Your protected page content here
?>
