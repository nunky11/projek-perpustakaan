<?php
// Nama  : Nunky Zulaikha Widodo
// NIM   : 250102025
// Kelas : TI-2A
// koneksi.php - Koneksi ke database db_perpustakaan (MySQLi procedural)

// Matikan exception bawaan PHP 8.1+ agar kesalahan diperiksa dengan if
mysqli_report(MYSQLI_REPORT_OFF);

// Parameter koneksi
$host = "localhost";
$username = "root";
$password = "";
$database = "db_perpustakaan";

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . htmlspecialchars(mysqli_connect_error()));
}

// Mengatur karakter
mysqli_set_charset($koneksi, "utf8mb4");
