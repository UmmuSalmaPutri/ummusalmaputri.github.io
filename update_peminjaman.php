<?php
include 'koneksi.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $buku_id = $_POST['buku_id'];
    $anggota_id = $_POST['anggota_id'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Prepared statement untuk update data
    $stmt = $mysqli->prepare("UPDATE peminjaman SET buku_id=?, anggota_id=?, tanggal_peminjaman=?, tanggal_kembali=? WHERE peminjaman_id=?");
    $stmt->bind_param("iisss", $buku_id, $anggota_id, $tanggal_peminjaman, $tanggal_kembali, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: peminjaman.php");
    exit();
}

$sql = "SELECT * FROM peminjaman WHERE peminjaman_id=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Peminjaman</title>
</head>
<body>
    <a href="peminjaman.php">Kembali</a>
    <form action="update_peminjaman.php?id=<?php echo $id; ?>" method="POST">
        buku_id: <input type="text" name="buku_id" value="<?php echo $row['buku_id']; ?>"><br>
        anggota_id: <input type="text" name="anggota_id" value="<?php echo $row['anggota_id']; ?>"><br>
        Tanggal Peminjaman: <input type="date" name="tanggal_peminjaman" value="<?php echo $row['tanggal_peminjaman']; ?>"><br>
        tanggal_kembali: <input type="date" name="tanggal_kembali" value="<?php echo $row['tanggal_kembali']; ?>"><br>

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<?php
} else {
    echo "Data tidak ditemukan.";
}

$stmt->close();
$mysqli->close();
?>
