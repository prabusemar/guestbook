<?php
// Mengecek apakah form telah di-submit
if (isset($_POST['submit'])) {
    // Menyimpan data dari form ke dalam variabel
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $no_hp = $_POST['no_hp'];
    $keperluan = $_POST['keperluan'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];
    $waktu_kunjungan = $_POST['waktu_kunjungan'];
    $foto = $_POST['foto'];

    // Menentukan nama file dan lokasi untuk menyimpan foto
    $nama_file = uniqid() . '.png';
    $lokasi_file = 'uploads/' . $nama_file;

    // Mengkonversi base64-encoded string ke gambar dan menyimpannya ke lokasi file
    $gambar = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $foto));
    file_put_contents($lokasi_file, $gambar);

    // Membuka file tamu.txt
    $file = fopen('tamu.txt', 'a');

    // Menulis data tamu ke file tamu.txt
    fwrite($file, "$nama | $nik | $no_hp | $keperluan | $tanggal_kunjungan | $waktu_kunjungan | $nama_file\n");

    // Menutup file tamu.txt
    fclose($file);

    // Mengalihkan pengguna ke halaman sukses
    header('Location: sukses.html');
}
