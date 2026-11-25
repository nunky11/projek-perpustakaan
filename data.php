<?php
// Nama  : Nunky Zulaikha Widodo
// NIM   : 250102025
// Kelas : TI-2A
// data.php - Menampilkan data peminjaman perpustakaan
require_once "koneksi.php";

// Ambil data peminjaman beserta nama anggota dan judul buku
$sql = "SELECT p.id_peminjaman, a.no_anggota, a.nama_lengkap, b.judul,
               p.tanggal_pinjam, p.tanggal_kembali, p.status
        FROM peminjaman p
        JOIN anggota a ON p.no_anggota = a.no_anggota
        JOIN buku b    ON p.id_buku = b.id_buku
        ORDER BY p.tanggal_pinjam DESC";
$hasil = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman Perpustakaan</title>
</head>
<body>
    <h1>Data Peminjaman Perpustakaan</h1>

    <?php if (!$hasil) { ?>

        <p class="gagal">Query gagal:
            <?php echo htmlspecialchars(mysqli_error($koneksi)); ?></p>

    <?php } elseif (mysqli_num_rows($hasil) === 0) { ?>

        <p>Belum ada data peminjaman.</p>

    <?php } else { ?>

        <table>
            <tr>
                <th>No</th>
                <th>No. Anggota</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($hasil)) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row["no_anggota"]); ?></td>
                <td><?php echo htmlspecialchars($row["nama_lengkap"]); ?></td>
                <td><?php echo htmlspecialchars($row["judul"]); ?></td>
                <td><?php echo htmlspecialchars($row["tanggal_pinjam"]); ?></td>
                <td><?php echo htmlspecialchars($row["tanggal_kembali"] ?? "-"); ?></td>
                <td><?php echo htmlspecialchars($row["status"]); ?></td>
            </tr>
            <?php } ?>
        </table>

    <?php } ?>

    <p><a href="form_anggota.php">Kembali ke form anggota</a></p>
</body>
</html>
<?php
if ($hasil) { mysqli_free_result($hasil); }
mysqli_close($koneksi);
?>