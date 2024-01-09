
<a href="index.php">Kembali</a>
<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']){
    header('location: login.php');
    exit();
}

//gabungkan tabel peminjaman dan pengembalian
$sql = "SELECT pengembalian.*, peminjaman.tanggal_kembali
        FROM pengembalian
        INNER JOIN peminjaman ON pengembalian.peminjaman_id = peminjaman.peminjaman_id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
    <th>Pengembalian ID</th>
    <th>Peminjaman ID</th>
    <th>Tanggal Pengembalian</th>    
    <th>Status Pengembalian</th> 
    <th>Action</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["pengembalian_id"]."</td>";
        echo "<td>".$row["peminjaman_id"]."</td>";
        echo "<td>".$row["tanggal_pengembalian"]."</td>";
        echo "<td>".$row["status_pengembalian"]."</td>";

        // Tampilkan Action
        echo "<td><a href='update_pengembalian.php?id=".$row["pengembalian_id"]."'>Edit</a> </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data pengembalian.";
}

$mysqli->close();
?><br>

<a href="tambah_pengembalian.php">tambah</a> <br>

