<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buku_id = $_POST['buku_id'];
    $anggota_id = $_POST['anggota_id'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $sql = "INSERT INTO peminjaman (buku_id, anggota_id, tanggal_peminjaman, tanggal_kembali ) 
            VALUES ('$buku_id', '$anggota_id', '$tanggal_peminjaman', '$tanggal_kembali')";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: peminjaman.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
<a href="peminjaman.php">Kembali</a>
<form action="tambah_peminjaman.php" method="POST">
    buku ID: 
    <select name="buku_id" required>
        <?php
        $querybuku = "SELECT buku_id, judul FROM buku";
        $resultbuku = $mysqli->query($querybuku);

        if ($resultbuku->num_rows > 0) {
            while ($rowbuku = $resultbuku->fetch_assoc()) {
                echo "<option value='" . $rowbuku['buku_id'] . "'>" . $rowbuku['judul'] . "</option>";
            }
        }
        ?>
    </select><br>
    Anggota ID: <input type="text" name="anggota_id" required><br>
    Tanggal Peminjaman: <input type="date" name="tanggal_peminjaman" required><br>
    Tanggal Kembali: <input type="date" name="tanggal_kembali" required><br>

    <input type="submit" value="Tambah">
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
</head>
<body>
    
</body>
</html>