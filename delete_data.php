<?php
$index = $_POST['index'];
$photoFilename = $_POST['photo'];
$filename = 'uploads/' . $photoFilename;

// Hapus file foto
if (file_exists($filename)) {
    unlink($filename);
}

// Hapus baris data dari file tamu.txt
$file = file('tamu.txt');
unset($file[$index]);
file_put_contents('tamu.txt', implode('', $file));
