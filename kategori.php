<a href="index.php">Kembali</a>

<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']){
    header('location: login.php');
    exit();
}

$sql = "SELECT * FROM kategori";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Kategori ID</th><th>Nama Kategori</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["kategori_id"]."</td>";
        echo "<td>".$row["nama_kategori"]."</td>";
        echo "<td><a href='update_kategori.php?id=".$row["kategori_id"]."'>Edit</a> |
                <a href='deletekategori.php?id=".$row["kategori_id"]."'>Hapus</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data Kategori buku.";
}
$mysqli->close();
?><br>

<a href="tambahkategori.php">Tambah</a>
