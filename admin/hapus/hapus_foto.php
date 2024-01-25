<?php
$id_foto = $_GET['idfoto'];
$id_barang = $_GET['idbarang'];

$ambil = $koneksi->query("SELECT * FROM barang_foto WHERE id_barang_foto='$id_foto'");
$detailfoto = $ambil->fetch_assoc();
$nama_foto = $detailfoto['nama_barang_foto'];

unlink("../assets/foto_barang/" . $nama_foto);

$koneksi->query("DELETE FROM barang_foto WHERE id_barang_foto='$id_foto'");

echo "<script>alert('Foto Berhasil Dihapus');</script>";
echo "<script>location='index2.php?halaman=detail_barang&id=$id_barang';</script>";
