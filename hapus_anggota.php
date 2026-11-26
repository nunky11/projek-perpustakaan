<?php
require_once "koneksi.php";
// Mengambil ID anggota
$id = $_POST['id'];

// Memeriksa ID
// if (!isset($id) || !ctype_digit((string) $id)) {
//     die("ID anggota tidak valid.");
// }

// Membuat query DELETE
$query = "DELETE FROM anggota WHERE id = ?";
// Menyiapkan prepared statement
$stmt = mysqli_prepare($koneksi, $query);
// Mengikat parameter
mysqli_stmt_bind_param($stmt, "i", $id);

// Menjalankan query DELETE
if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: data.php");
    exit;
} else {
    die("Gagal menghapus data: " . mysqli_stmt_error($stmt));
}

?>