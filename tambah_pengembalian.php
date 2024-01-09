<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $peminjaman_id = $_POST['peminjaman_id'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

    // Mendapatkan peminjaman berdasarkan peminjaman_id
    $query_peminjaman = "SELECT * FROM peminjaman WHERE peminjaman_id = '$peminjaman_id'";
    $result_peminjaman = $mysqli->query($query_peminjaman);

    if ($result_peminjaman->num_rows > 0) {
        // Peminjaman ditemukan, tambahkan data ke tabel pengembalian
        $sql = "INSERT INTO pengembalian (peminjaman_id, tanggal_pengembalian) 
                VALUES ('$peminjaman_id', '$tanggal_pengembalian')";

        if ($mysqli->query($sql) === TRUE) {
            header("Location: pengembalian.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    } else {
        echo "Peminjaman tidak ditemukan.";
    }

    $mysqli->close();
}
?>

<a href="pengembalian.php">Kembali</a>
<form action="tambah_pengembalian.php" method="POST">
    Peminjaman ID:
    <select name="peminjaman_id" required>
        <?php
        // Ambil daftar peminjaman yang belum dikembalikan
        $query_peminjaman_belum_dikembalikan = "SELECT peminjaman_id FROM peminjaman WHERE status != 'dikembalikan'";
        $result_peminjaman_belum_dikembalikan = $mysqli->query($query_peminjaman_belum_dikembalikan);

        if ($result_peminjaman_belum_dikembalikan->num_rows > 0) {
            while ($row_peminjaman_belum_dikembalikan = $result_peminjaman_belum_dikembalikan->fetch_assoc()) {
                echo "<option value='" . $row_peminjaman_belum_dikembalikan['peminjaman_id'] . "'>" . $row_peminjaman_belum_dikembalikan['peminjaman_id'] . "</option>";
            }
        }
        ?>
    </select><br>
    Tanggal pengembalian: <input type="date" name="tanggal_pengembalian" required><br>
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
