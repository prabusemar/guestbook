<?php
// Mengecek apakah form login telah disubmit
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Membuka file admin.txt
    $file = fopen('admin.txt', 'r');

    // Membaca data admin dari file admin.txt
    $admin = fgets($file);

    // Menutup file admin.txt
    fclose($file);

    // Memisahkan data admin menjadi array
    $data_admin = explode(':', $admin);

    // Mengecek apakah username dan password yang dimasukkan benar
    if ($_POST['username'] == $data_admin[0] && $_POST['password'] == $data_admin[1]) {
        // Jika benar, redirect ke halaman data_tamu.php
        header('Location: data_tamu.php');
        exit;
    } else {
        // Jika salah, tampilkan pesan kesalahan
        echo 'Username atau password salah.';
    }
}
