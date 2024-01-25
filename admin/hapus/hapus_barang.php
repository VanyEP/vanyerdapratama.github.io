<?php
$id_barang = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
$pecah = $ambil->fetch_assoc();

$hapus_foto = $pecah['foto_barang'];
if (file_exists("../assets/foto_barang/" . $hapus_foto)); {
    unlink("../assets/foto_barang/" . $hapus_foto);
}

$koneksi->query("DELETE FROM barang WHERE id_barang='$id_barang'");

$hapusbarangfoto = array();
$ambil = $koneksi->query("SELECT * FROM barang_foto WHERE id_barang='$id_barang'");
while ($hapus = $ambil->fetch_assoc()) {
    $hapusbarangfoto[] = $hapus;
}

foreach ($hapusbarangfoto as $key => $value) {
    $hapusfoto = $value['nama_barang_foto'];
    if (file_exists("../assets/foto_barang/" . $hapusfoto)) {
        unlink("../assets/foto_barang/" . $hapusfoto);
    }

    $koneksi->query("DELETE FROM barang_foto WHERE id_barang='$id_barang'");
}

echo "<script>alert('Data Berhasil Dihapus');</script>";
echo "<script>location='index2.php?halaman=barang';</script>";

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
