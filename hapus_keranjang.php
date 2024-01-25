<?php
session_start();

$id_barang = $_GET['idbarang'];

unset($_SESSION['keranjang_belanja'][$id_barang]);

echo "<script>alert('Barang berhasil dihapus');</script>";
echo "<script>location='keranjang.php';</script>";
