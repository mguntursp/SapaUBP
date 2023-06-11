<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\SignUp.css">
    <link rel="shortcut icon" href="img/logo-SapaUBP.svg?v=1.0">
    <title>SapaUBP - Sign Up</title>
</head>

<body>
    <div class="konten">
        <h1>SapaUBP</h1>
        <div class="teks">
            <p>Yuk gabung dan menfess di UBP Karawang! Wadah anonim untuk berbagi pikiran dan
                pengalaman. Bergabung sekarang dan nikmati komunitas menfess yang seru di
                UBP Karawang!</p>
        </div>
        <img src="img\gambar.svg">
    </div>

    <div class="shape">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V7.23C0,65.52,268.63,112.77,600,112.77S1200,65.52,1200,7.23V0Z" class="shape-fill"></path>
        </svg>
    </div>

    <div class="form">
        <img src="img\avatar.svg">
        <form class="form_input" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="password2" placeholder="Confirm Password">

            <input type="submit" value="Sign Up">
        </form>
        <form method="post" action="login.php" class="form_tombol_login">
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

<?php
    // Kode untuk menghubungkan ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sapaubp";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Fungsi untuk membersihkan dan melindungi data masukan
    function sanitizeInput($data) {
        global $conn;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }

    // Memproses form pendaftaran ketika tombol Sign Up ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = sanitizeInput($_POST["username"]);
        $email = sanitizeInput($_POST["email"]);
        $password = sanitizeInput($_POST["password"]);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Memasukkan data akun ke dalam tabel pengguna
        $sql = "INSERT INTO akun (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
        if (mysqli_query($conn, $sql)) {
            // Pendaftaran berhasil, redirect ke halaman login
            header("Location: Login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Menutup koneksi database
    mysqli_close($conn);
?>
