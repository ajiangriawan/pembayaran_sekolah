<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'bendahara')";
    if ($koneksi->query($sql) === TRUE) {
        echo "Registrasi berhasil. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    $koneksi->close();
}
?>
<form action="register.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Register</button>
</form>
