<?php
include "config/koneksi.php";

$sql = "SELECT * FROM data_barang";
$result = mysqli_query($conn, $sql);
?>

<h2>Data Barang</h2>
<a href="index.php?page=user/tambah" class="btn">+ Tambah</a>

<table>
    <tr>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td>
            <img src="gambar/<?= $row['gambar']; ?>" width="70">
        </td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['kategori']; ?></td>
        <td><?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
        <td><?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
        <td><?= $row['stok']; ?></td>
        <td>
            <a href="index.php?page=user/ubah&id=<?= $row['id_barang']; ?>">Ubah</a> |
            <a href="index.php?page=user/hapus&id=<?= $row['id_barang']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>