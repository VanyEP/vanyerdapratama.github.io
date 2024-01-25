<?php
$id_konsumen = $_GET['id'];

$koneksi->query("DELETE FROM konsumen WHERE id_konsumen='$id_konsumen'");

echo "<script>alert('Data Berhasil Dihapus');</script>";
echo "<script>location='index2.php?halaman=konsumen';</script>";
