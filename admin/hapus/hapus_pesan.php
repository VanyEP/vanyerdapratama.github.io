<?php
$id_pesan = $_GET['id'];

$koneksi->query("DELETE FROM pesan WHERE id_pesan='$id_pesan'");

echo "<script>alert('Data Berhasil Dihapus');</script>";
echo "<script>location='index2.php?halaman=pesan';</script>";
