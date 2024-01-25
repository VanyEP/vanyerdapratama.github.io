<?php
$id_kategori = $_GET['id'];

$koneksi->query("DELETE FROM kategori WHERE id_kategori='$id_kategori'");

echo "<script>alert('Data Berhasil Dihapus');</script>";
echo "<script>location='index2.php?halaman=kategori';</script>";
