<?php
session_start();

$id_barang = $_GET['idbarang'];

if (isset($_SESSION['keranjang_belanja'][$id_barang])) {
    $_SESSION['keranjang_belanja'][$id_barang] += 1;
} else {
    $_SESSION['keranjang_belanja'][$id_barang] = 1;
}

// echo "<pre>";
// print_r($_SESSION['keranjang_belanja']);
// echo "</pre>";

echo "<script>alert('Barang berhasil masuk keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
