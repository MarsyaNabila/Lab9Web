# Lab9Web - Pratikum PHP Modular

Nama: Marsya Nabila Putri

NIM: 312410338

Kelas: TI.24.A4

## Tujuan Pratikum

- Memahami konsep dasar Modularisasi Program pada PHP.

- Menerapkan fungsi require / include untuk membuat template halaman.

- Mengimplementasikan routing sederhana menggunakan parameter URL.

- Mengubah project praktikum sebelumnya (database) menjadi modular.

## Koneksi.php
```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan1";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "Koneksi ke server gagal.";
    die();
} else {
    echo "Koneksi berhasil!";
}
?>
```


Kode **koneksi.php** berfungsi sebagai pusat koneksi antara aplikasi PHP dan database MySQL. Di dalam file ini ditentukan terlebih dahulu informasi dasar yang dibutuhkan untuk terhubung ke database, yaitu alamat server yang menggunakan nilai *localhost*, username MySQL yang menggunakan *root*, password yang masih kosong, serta nama database yang akan digunakan, yaitu *latihan1*. Semua data tersebut dimasukkan ke dalam fungsi `mysqli_connect()` yang bertugas membuka koneksi ke MySQL. Hasil koneksi disimpan dalam variabel `$conn`, sehingga halaman PHP lain yang meng-include file ini bisa langsung memakai variabel tersebut tanpa membuat koneksi baru.

Setelah pemanggilan `mysqli_connect()`, file ini melakukan pengecekan untuk memastikan apakah koneksi berhasil atau tidak. Jika koneksi gagal, maka file menampilkan pesan bahwa koneksi ke server gagal dan langsung menghentikan seluruh proses menggunakan `die()` agar tidak terjadi error lanjutan. Sebaliknya, jika koneksi berhasil dibuat, file akan menampilkan pesan “Koneksi berhasil!” sebagai tanda bahwa aplikasi sudah berhasil terhubung ke database. Dengan cara kerja seperti ini, koneksi.php menjadi file yang sangat penting karena semua operasi database pada aplikasi bergantung pada keberhasilan koneksi yang dibuat di dalam file ini.

## Header.php

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Dasar</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    
<div class="container">

<header class="app-header">
    <h1>PHP Modular</h1>
</header>

<div class="nav-table-container">
    <table class="nav-table">
        <tr>
            <td><a href="index.php?page=home">Beranda </a></td>
            <td><a href="index.php?page=about">Tentang</a></td>
            <td><a href="index.php?page=user/list">Data Barang</a></td>
            <td><a href="index.php?page=kontak">Kontak</a></td>
        </tr>
    </table>
</div>
<div class="content">
```


Kode tersebut merupakan bagian awal dari sebuah halaman web PHP yang menggunakan konsep modular. Pada bagian `<head>`, halaman diatur menggunakan HTML standar dan memuat file CSS melalui `style.css`, dengan tambahan `?v=<?php echo time(); ?>` yang berfungsi untuk mencegah cache sehingga setiap perubahan pada CSS langsung terbaca oleh browser. Bagian `<body>` dimulai dengan sebuah container utama yang menampung seluruh komponen halaman. Di bagian atas terdapat header berisi judul “PHP Modular” yang menjadi identitas web. Setelah itu, terdapat navigasi berbentuk tabel yang berisi link menuju halaman-halaman berbeda. Setiap link sebenarnya tidak membuka file baru secara langsung, tetapi mengarahkan ke `index.php` dengan parameter `page`. Parameter ini menentukan konten mana yang akan ditampilkan, seperti halaman beranda lewat `page=home`, halaman tentang lewat `page=about`, halaman data barang lewat `page=user/list`, dan halaman kontak lewat `page=kontak`. Mekanisme seperti ini membuat halaman menjadi modular karena satu file utama bertugas memuat konten dinamis berdasarkan parameter yang diberikan, dan bagian `<div class="content">` menjadi area tempat isi halaman akan dimunculkan.

## Footer.php
```php
</div>

<footer>
    <p>&copy; 2025 - Universitas Pelita Bangsa </p>
</footer>

</div>
</body>
</html>
```

Bagian kode di atas merupakan penutup struktur halaman web. Setelah area konten selesai ditampilkan, halaman dilanjutkan dengan sebuah elemen `<footer>` yang berisi tulisan hak cipta “© 2025 - Universitas Pelita Bangsa”, berfungsi sebagai identitas sekaligus penutup halaman. Footer ini berada di dalam container utama sehingga tampil menyatu dengan desain keseluruhan. Setelah footer, tag penutup `</div>` menutup container, lalu tag penutup `</body>` dan `</html>` digunakan untuk mengakhiri seluruh dokumen HTML. Dengan bagian ini, struktur halaman menjadi lengkap dan tertutup dengan rapi sesuai format HTML standar.

## Index.php
```
<?php
include "header.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Routing Modular
$path = explode('/', $page);

if ($path[0] == "user") {
    include "user/" . $path[1] . ".php";
} else {
    include "pages/" . $path[0] . ".php";
}

include "footer.php";
?>
```

Kode di atas adalah inti dari sistem modular yang digunakan pada aplikasi. Pertama, file `header.php` dimasukkan agar bagian atas halaman seperti layout, menu, atau struktur dasar — selalu tampil sama di setiap halaman. Setelah itu, program memeriksa apakah ada parameter `page` yang dikirim melalui URL. Jika ada, nilainya digunakan; jika tidak ada, maka halaman otomatis menampilkan konten default yaitu halaman *home*. Nilai `page` kemudian dipecah menggunakan `explode('/')` sehingga aplikasi dapat mengenali apakah halaman yang diminta berada di folder khusus, seperti folder *user*, atau berada di folder umum *pages*.

Jika bagian pertama dari path bernama “user”, maka aplikasi akan membuka file yang berada di dalam folder `user/` sesuai nama file yang diminta pada bagian kedua. Ini membuat sistem bisa menangani halaman seperti `index.php?page=user/list` atau `index.php?page=user/form` tanpa perlu membuat banyak file utama. Jika bukan “user”, maka halaman akan diambil dari folder `pages/` berdasarkan nama file yang dikirim melalui parameter. Setelah konten utama dimuat, file `footer.php` disertakan untuk menampilkan bagian footer, sehingga setiap halaman tetap terasa konsisten. Dengan cara kerja ini, file ini bertindak sebagai router sederhana yang mengatur halaman mana yang muncul tanpa harus menulis struktur HTML berulang-ulang.

## Home.php
```php
<h2>Halaman Home</h2>
<p>Selamat datang di aplikasi PHP Modular. Ini adalah halaman utama modular PHP.</p>
```

<img width="1132" height="513" alt="image" src="https://github.com/user-attachments/assets/fa629629-0d17-4fd4-ba2d-7c8293d60173" />

## About.php
```php
<h2>Halaman About</h2>
<p>Aplikasi ini dibuat sebagai media pembelajaran dalam mata kuliah Pemrograman Web 1. 
    Melalui aplikasi sederhana ini, mahasiswa dapat memahami cara kerja PHP mulai dari 
    struktur dasar, modularisasi halaman, penggunaan routing sederhana, hingga pengelolaan 
    data menggunakan konsep CRUD. Tujuan akhirnya adalah membantu proses belajar menjadi 
    lebih terarah, mudah dipahami, dan memberikan pengalaman praktik yang nyata dalam 
    membangun sebuah aplikasi web.</p>
```


<img width="1133" height="532" alt="image" src="https://github.com/user-attachments/assets/6a44b5c6-9b19-436a-a123-f61fbf24565c" />

## Kontak.php
```php
<h2>Kontak</h2>

<p>Silakan hubungi kami melalui informasi berikut:</p>

<div class="contact-box">
    <p><strong>Telepon:</strong> 0851-5907-6020</p>
    <p><strong>Email:</strong> marsyanabila293@gmail.com</p>
    <p><strong>Alamat:</strong> Jl.Anggrek 2 no 22</p>
</div>
```

<img width="1132" height="579" alt="image" src="https://github.com/user-attachments/assets/1d66aedc-d07d-4bdf-8122-bd3a1fd265a6" />



## Pertanyaan dan Tugas

Implementasikan konsep modularisasi pada kode program praktikum 8 tentang database,
sehingga setiap halamannya memiliki template tampilan yang sama. Dan terapkan
penggunaan Routing agar project menjadi lebih modular.

## Data Barang

<img width="1132" height="923" alt="image" src="https://github.com/user-attachments/assets/d76d9f01-7f8b-4c09-8fc4-2aba5dd865fc" />

## Tambah Barang

<img width="1110" height="949" alt="image" src="https://github.com/user-attachments/assets/6cdf22f9-a549-4502-999c-f1265c39f85d" />


## Ubah Barang

<img width="1129" height="940" alt="image" src="https://github.com/user-attachments/assets/0e3ff2b1-a899-4cc8-8098-6489864acead" />


## Hapus Barang

<img width="1123" height="1030" alt="image" src="https://github.com/user-attachments/assets/a15faf2f-dbda-4f01-ae04-9805ef0a04b1" />
