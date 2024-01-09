<?php
include 'koneksi.php';

$id = $_GET['id'];

// cek apakah form telah disubmit untuk melakukan pembaruan data
if (isset($_POST['update'])) {
    $nama_kategori = $_POST['nama_kategori'];

    // pembaruan data menggunakan prepared statement
    $stmt = $mysqli->prepare("UPDATE kategori SET nama_kategori=? WHERE kategori_id=?");
    $stmt->bind_param("si", $nama_kategori, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: kategori.php");
    exit();
}

// ambil data kategori berdasarkan ID
$stmt = $mysqli->prepare("SELECT * FROM kategori WHERE kategori_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// tampilkan form untuk mengedit data kategori
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Edit Data kategori</title>
    </head>
    <body>

        <form action="update_kategori.php?id=<?php echo $id; ?>" method="POST">
            kategori: <input type="text" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>"><br>
            <input type="hidden" name="id" value="<?php echo $row['kategori_id']; ?>">
            <input type="submit" name="update" value="Update">
        </form>

    </body>
    </html>

<?php
} else {
    echo "Data tidak ditemukan.";
}

// tutup koneksi database
$stmt->close();
$mysqli->close();
?>
