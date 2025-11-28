<?php
include "config/koneksi.php";

if (isset($_POST['submit'])) {

    $nama   = $_POST['nama'];
    $kategori   = $_POST['kategori'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok       = $_POST['stok'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    if ($gambar != "") {
        move_uploaded_file($tmp, "gambar/$gambar");
    }

    mysqli_query($conn, "INSERT INTO data_barang 
        (nama, kategori, harga_beli, harga_jual, stok, gambar)
        VALUES ('$nama','$kategori','$harga_beli','$harga_jual','$stok','$gambar')");

    header("Location: index.php?page=user/list");
}
?>

<h2>Tambah Barang</h2>

<form method="post" enctype="multipart/form-data">

<label>Nama</label>
<input type="text" name="nama" required>

<label>Kategori</label>
<select name="kategori">
    <option>Elektronik</option>
    <option>Komputer</option>
    <option>Hand Phone</option>
</select>

<label>Harga Beli</label>
<input type="number" name="harga_beli">

<label>Harga Jual</label>
<input type="number" name="harga_jual">

<label>Stok</label>
<input type="number" name="stok">

<label>Gambar</label>
<input type="file" name="gambar">

<button class="btn" name="submit">Simpan</button>

</form>