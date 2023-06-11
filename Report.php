<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\Report.css">
    <link rel="shortcut icon" href="img/logo-SapaUBP.svg">
    <title>SapaUBP - Report</title>
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

    <div class="report">
        <div class="judul">
            <h1>Report</h1>
        </div>
        <div class="alasan">
        <form method="post">
            <label for="kasar">
                <input type="checkbox" id="kasar" name="kasar">
                Berkata Kasar
            </label>
            <label for="porno">
                <input type="checkbox" id="porno" name="porno">
                Berbau Pornografi
            </label>
            <label for="promosi">
                <input type="checkbox" id="promosi" name="promosi">
                Promosi
            </label>
            <label for="sara">
                <input type="checkbox" id="sara" name="sara">
                Mengandung SARA
            </label>
            <label for="bullying">
                <input type="checkbox" id="bullying" name="bullying">
                Bullying
            </label>
            <input type="text" id="lainnya" name="lainnya" placeholder="Lainnya">
            

            <input value="Report" type="submit"/>
        </form>
        </div>
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

    // Periksa koneksi database
    if (!$conn) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }

    // Cek apakah form laporan telah dikirimkan
    if (isset($_POST['submit'])) {
        // Ambil nilai checkbox dan input laporan lainnya
        $kasar = isset($_POST['kasar']) ? $_POST['kasar'] : '';
        $porno = isset($_POST['porno']) ? $_POST['porno'] : '';
        $promosi = isset($_POST['promosi']) ? $_POST['promosi'] : '';
        $sara = isset($_POST['sara']) ? $_POST['sara'] : '';
        $bullying = isset($_POST['bullying']) ? $_POST['bullying'] : '';
        $lainnya = isset($_POST['lainnya']) ? $_POST['lainnya'] : '';

        // Ambil id menfess yang direport (misalnya diambil dari parameter URL)
        $idMenfess = isset($_GET['id']) ? $_GET['id'] : '';

        // Siapkan pernyataan SQL untuk menyimpan laporan ke dalam tabel "report"
        $sql = "INSERT INTO report (id_menfess, kasar, porno, promosi, sara, bullying, lainnya) VALUES ('$idMenfess', '$kasar', '$porno', '$promosi', '$sara', '$bullying', '$lainnya')";

        // Eksekusi pernyataan SQL
        if (mysqli_query($conn, $sql)) {
            // Redirect ke halaman Home setelah laporan dikirimkan
            header("Location: Home.php");
            exit();
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
?>