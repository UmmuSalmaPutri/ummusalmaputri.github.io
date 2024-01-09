<?php
include 'koneksi.php';

// Validasi ID yang diterima
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['update'])) {
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $kategori_id = $_POST['kategori_id'];
        $sinopsis = $_POST['sinopsis'];

        // Update data using prepared statement
        $stmt = $mysqli->prepare("UPDATE buku SET judul=?, pengarang=?, penerbit=?, tahun_terbit=?, kategori_id=?, sinopsis=? WHERE buku_id=?");
        $stmt->bind_param("ssssisi", $judul, $pengarang, $penerbit, $tahun_terbit, $kategori_id, $sinopsis, $id);
        $stmt->execute();
        $stmt->close();

        header("Location: buku.php");
        exit();
    }

    $stmt = $mysqli->prepare("SELECT * FROM buku WHERE buku_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
?>
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Edit Data Buku</title>
        </head>
        <body>
            <a href="buku.php">Kembali</a>
            <form action="updatebuku.php?id=<?php echo $id; ?>" method="POST">
                Judul: <input type="text" name="judul" value="<?php echo ($row['judul']); ?>"><br>
                Pengarang: <input type="text" name="pengarang" value="<?php echo ($row['pengarang']); ?>"><br>
                Penerbit: <input type="text" name="penerbit" value="<?php echo ($row['penerbit']); ?>"><br>
                Tahun Terbit: <input type="text" name="tahun_terbit" value="<?php echo ($row['tahun_terbit']); ?>"><br>
                Kategori ID: <input type="text" name="kategori_id" value="<?php echo ($row['kategori_id']); ?>"><br>
                Sinopsis: <input type="text" name="sinopsis" value="<?php echo ($row['sinopsis']); ?>"><br>
        
                <input type="submit" name="update" value="Update">
            </form>
        </body>
        </html>
<?php
    } else {
        echo "Data tidak ditemukan.";
    }

    $stmt->close();
} else {
    echo "ID tidak valid atau tidak ditemukan.";
}

$mysqli->close();
?>
