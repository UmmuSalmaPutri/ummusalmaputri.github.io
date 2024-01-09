<a href="index.php">Kembali</a><br>

<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

// Asumsikan $sql adalah query untuk mendapatkan data peminjaman buku
$sql = "SELECT * FROM peminjaman"; // Ganti peminjaman dengan nama tabel yang sesuai

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
    <th>Peminjaman ID</th>
    <th>Buku ID</th>
    <th>Anggota ID</th>
    <th>Tanggal Peminjaman</th>
    <th>Tanggal Kembali</th>
    <th>status</th>
    <th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        // Tampilkan data peminjaman buku
        echo "<tr>";
        echo "<td>".$row["peminjaman_id"]."</td>";
        echo "<td>".$row["buku_id"]."</td>";
        echo "<td>".$row["anggota_id"]."</td>";
        echo "<td>".$row["tanggal_peminjaman"]."</td>";
        echo "<td>".$row["tanggal_kembali"]."</td>";
        echo "<td>".$row["status"]."</td>";
        
        // Tampilkan link Edit dan Hapus untuk setiap data
        echo "<td><a href='update_peminjaman.php?id=".$row["peminjaman_id"]."'>Edit</a> |
            <a href='delete_peminjaman.php?id=".$row["peminjaman_id"]."'>Hapus</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data peminjaman buku.";
}

$mysqli->close();
?><br>
<a href="tambah_peminjaman.php">Tambah Peminjaman</a> <br>
<a href="detail.php">Details</a><br>

