<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\Create.css?v=1.1">
    <link rel="shortcut icon" href="img/logo-SapaUBP.svg">
    <title>SapaUBP - Create</title>
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

    <div class="menfess">
        <div class="judul">
            Create a Secret Message
        </div>

        <div class="create">
            <form class="pesan" method="post">
                <input type="text" name="from" placeholder="From">
                <input type="text" name="for" placeholder="For">
                <textarea type="text" name="message" placeholder="Message"></textarea>

                <input type="submit" value="Send">
            </form>
        </div>
    </div>

    <div class="rules">
        <div class="forbidden">
            <img src="img/forbidden.svg">
        </div>
        <ul>
            <li>Berkata Kasar</li>
            <li>Berbau Pornografi</li>
            <li>Promosi</li>
            <li>Mengandung SARA</li>
            <li>Bullying</li>
        </ul>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari formulir
    $from = $_POST['from'];
    $for = $_POST['for'];
    $message = $_POST['message'];

    // Menyimpan pesan ke dalam database
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

    // Menyimpan pesan ke dalam tabel "menfess"
    $sql = "INSERT INTO menfess (from_name, for_name, message) VALUES ('$from', '$for', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Pesan berhasil disimpan, Redirect ke halaman HOME
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>