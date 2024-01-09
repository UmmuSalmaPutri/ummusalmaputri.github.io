<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $kategori_id = $_POST['kategori_id'];
    $sinopsis = $_POST['sinopsis'];


    $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, kategori_id) VALUES ('$judul', 
    '$pengarang', '$penerbit', '$tahun_terbit' ,'$kategori_id')";

    if ($mysqli->query($sql) === TRUE) {
 header("Location: buku.php"); // lokasi ke tampilan Read setelah berhasil tambah data
    exit;
    } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
}
?>
<a href="buku.php">Kembali</a>
<form action="tambahbuku.php" method="POST">
    Judul: <input type="text" name="judul"required><br>
    Pengarang: <input type="text" name="pengarang"required><br>
    Penerbit: <input type="text" name="penerbit"required><br>
    Tahun Terbit: <input type="text" name="tahun_terbit"required><br>
    Kategori Id : <input type="text" name="kategori_id"required><br>
    Sinopsis: <input type="text" name="sinopsis"><br>




    <input type="submit" value="Tambah">
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Document</title>

</head>
<body>
    
</body>
</html>