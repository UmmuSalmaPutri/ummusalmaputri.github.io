<?php
include 'koneksi.php';
$id = $_GET['id']; // ID dari peminjaman yang akan dihapus
$sql = "DELETE FROM peminjaman WHERE peminjaman_id=$id";
if ($mysqli->query($sql) === TRUE) {
 header("Location: peminjaman.php"); // Redirect ke tampilan peminjaman setelah berhasil hapus data
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
?>