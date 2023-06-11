<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\Home.css?v=1.1">
    <link rel="shortcut icon" href="img/logo-SapaUBP.svg">
    <title>SapaUBP - Home</title>
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
    </div>

    <div class="create">
        <a href="Create.php">+</a>
    </div>
</body>
</html>

<?php
    // Mengambil pesan dari database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sapaubp";

    // Membuat koneksi ke database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    // Mengambil semua pesan dari tabel "menfess"
    $sql = "SELECT * FROM menfess";
    $result = $conn->query($sql);

    // Menampilkan pesan yang tersimpan di tabel "menfess"
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="menfess">';
            echo '<div class="nama_menfess">';
            echo '<div class="from">';
            echo '<p>From: ' . $row['from_name'] . '</p>';
            echo '</div>';
            echo '<div class="for">';
            echo '<p>For: ' . $row['for_name'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<div class="teks_menfess">' . $row['message'] . '</div>';
            echo '<div class="aksi_menfess">';
            echo '<form method="post">';
            echo '<input type="submit" value="" name="like" class="like" title="Like">';
            echo '<input type="submit" value="" name="comment" class="comment" title="Comment">';
            echo '<input type="submit" value="" name="report" class="report" title="Report">';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
    }

    // Redirect ke halaman Report saat tombol report ditekan
    if (isset($_POST['report'])) {
        header("Location: report.php");
        exit();
    }
?>