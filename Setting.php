<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\Setting.css">
    <link rel="shortcut icon" href="img/logo-SapaUBP.svg">
    <title>SapaUBP - Setting</title>
</head>

<body>
    <div class="navbar">
        <div class="nav">
            <a href="About.php" title="About">About</a>
            <a href="Home.php" title="Home">Home</a>
            <a href="Setting.php" title="Setting">Setting</a>
        </div>
    </div>

    <div class="logo">
        <img src="img/logo-ubp.svg">
    </div>

    <div class="setting">
        <div class="profil">
            <h1>Username</h1>
            <h3>contohemail@email.com</h3>
        </div>
        <div class="list">
            <div class="change_pw">
                <a href="ChangePw.php">Change Password</a>
            </div>
            <div class="logout">
                <a href="Login.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    // Mulai session
    session_start();

    // Memeriksa apakah pengguna sudah login atau belum
    if (!isset($_SESSION["username"])) {
        // Jika pengguna belum login, redirect ke halaman login atau halaman lainnya
        header("Location: Login.php");
        exit();
    }

    // Ambil data koneksi database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sapaubp";

    // Membuat koneksi ke database
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Cek koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Mendapatkan informasi akun pengguna
    $username = $_SESSION["username"];

    // Query untuk mengambil informasi akun dari tabel akun
    $sql = "SELECT email FROM akun WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Menutup koneksi database
    mysqli_close($conn);
?>