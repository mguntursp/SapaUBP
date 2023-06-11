<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\Login.css">
    <link rel="shortcut icon" href="img/logo-SapaUBP.svg">
    <title>SapaUBP - Login</title>
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
            <input type="password" name="password" placeholder="Password">

            <input type="submit" value="Login">
        </form>
        <div class="opsi">
            <a href="SignUp.php">Sign Up</a>
            <a href="ForgotPw.php">Forgot Password</a>
        </div>
    </div>
</body>
</html>

<?php
    session_start();

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

    // Memproses form login ketika tombol Login ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = sanitizeInput($_POST["username"]);
        $password = sanitizeInput($_POST["password"]);

        // Mengambil data pengguna berdasarkan username
        $sql = "SELECT * FROM akun WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            // Memverifikasi kata sandi yang dimasukkan dengan hash yang tersimpan di database
            if (password_verify($password, $hashedPassword)) {
                // Login berhasil, simpan informasi pengguna ke dalam sesi
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];

                // Redirect ke halaman Home
                header("Location: Home.php");
                exit();
            } else {
                $loginError = "Username atau password salah";
            }
        } else {
            $loginError = "Username atau password salah";
        }
    }

    // Menutup koneksi database
    mysqli_close($conn);
?>
