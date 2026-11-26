<?php
// Nama  : Nunky Zulaikha Widodo
// NIM   : 250102025
// Kelas : TI-2A
// data.php - Menampilkan data peminjaman perpustakaan
require_once "koneksi.php";

// Ambil data peminjaman beserta nama anggota dan judul buku
$sql = "SELECT *
        FROM anggota 
        ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman Perpustakaan</title>
   <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background: #1f3864; color: #fff; }
        .gagal { background: #fdecea; border-left: 5px solid #c0392b;
                 padding: 10px; }
    </style>
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
                <th>no</th></th>
                <th>id</th>
                <th>No Anggota</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Jenis Anggota</th>
                <th>Alamat</th>
                <th>Aksi</th>
                
            </tr>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($hasil)) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row["id"]); ?></td>
                <td><?php echo htmlspecialchars($row["no_anggota"]); ?></td>
                <td><?php echo htmlspecialchars($row["nama_lengkap"]); ?></td>
                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                <td><?php echo htmlspecialchars($row["no_hp"]); ?></td>
                <td><?php echo htmlspecialchars($row["jenis_anggota"]); ?></td>
                <td><?php echo htmlspecialchars($row["alamat"]); ?></td>
                
                <td>
                    <a href="edit_anggota.php?id=<?php echo (int) $row['id']; ?>">Edit</a>
                    <form action="hapus_anggota.php" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        <input type="hidden" name="id" value="<?= $row["id"]; ?>">
                        <button type="submit">Hapus</button>
                    </form>
                 </td>
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