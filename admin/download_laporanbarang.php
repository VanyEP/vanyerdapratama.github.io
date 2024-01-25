<?php
// Require composer autoload
require_once '../koneksi/koneksi.php';
require_once '../vendor/autoload.php';

// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

$caristok = $_GET['caristok'];

$semuastok = array();
$ambil = $koneksi->query("SELECT * FROM barang
    JOIN kategori ON barang.id_kategori=kategori.id_kategori
    WHERE stok_barang='$caristok'");
while ($pecah = $ambil->fetch_assoc()) {
    $semuastok[] = $pecah;
}


$html = '
<style>
    h1 {
        text-align: center;
        font-weight: 400;
        margin-bottom: 0;
    }

    .garis {
        border: 2px solid black;
        margin: 0 450px 0;
    }

    .table {
        color: black;
        width: 100%;
        margin-top: 1rem;
        text-align: center;
    }

    .tr1 {
        background: greenyellow;

    }
</style>

<h1>Data Laporan Barang</h1>
<div class="garis"></div>
<table border="1" class="table">
    <tr class="tr1">
        <th>No</th>
        <th>Kategori</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Berat</th>
    </tr>';

foreach ($semuastok as $key => $value) :
    $no = $key + 1;
    $namakategori = $value['nama_kategori'];
    $namabarang = $value['nama_barang'];
    $hargabarang = number_format($value['harga_barang']);
    $beratbarang = number_format($value['berat_barang']);

    $html .= '
    <tr>
        <th>' . $no . '</th>
        <th>' . $namakategori . '</th>
        <th>' . $namabarang . '</th>
        <th>' . $hargabarang . '</th>
        <th>' . $beratbarang . '</th>
    </tr>';
endforeach;

$html .= '
</table>

';


// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();
