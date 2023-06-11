<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\ChangePw.css">
    <link rel="shortcut icon" href="img/logo-SapaUBP.svg">
    <title>SapaUBP - Change Password</title>
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

    <div class="change">
        <h1>Change Password</h1>
        <form method="post" action="Setting.php">
            <input type="password" placeholder="Old Password" nama="old">
            <input type="password" placeholder="New Password" nama="new">
            <input type="password" placeholder="Confirm Password" nama="confirm_new">

            <input value="Change" type="submit"/>
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

    // Membuat koneksi ke database
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Cek koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Proses penggantian password
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $oldPassword = $_POST["old"];
        $newPassword = $_POST["new"];
        $confirmPassword = $_POST["confirm_new"];

        // Query untuk mengambil password lama dari tabel akun
        $username = $_SESSION["username"];
        $sql = "SELECT password FROM akun WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // Memeriksa kesesuaian password lama dengan yang ada dalam database
        if (password_verify($oldPassword, $row["password"])) {
            // Memeriksa kesesuaian password baru dengan konfirmasi password baru
            if ($newPassword == $confirmPassword) {
                // Mengenkripsi password baru
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Query untuk mengupdate password baru ke dalam tabel users
                $sql = "UPDATE users SET password = '$hashedPassword' WHERE username = '$username'";
                
                if (mysqli_query($conn, $sql)) {
                    echo "Password berhasil diubah.";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Konfirmasi password baru tidak sesuai.";
            }
        } else {
            echo "Password lama tidak benar.";
        }
    }

    // Menutup koneksi database
    mysqli_close($conn);
?>
