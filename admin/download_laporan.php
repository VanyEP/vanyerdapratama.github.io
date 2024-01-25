<?php
// Require composer autoload
require_once '../koneksi/koneksi.php';
require_once '../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

$tgl_awal = $_GET['tglawal'];
$tgl_akhir = $_GET['tglakhir'];
$status = $_GET['status'];

$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM penjualan
    JOIN konsumen ON penjualan.id_konsumen=konsumen.id_konsumen
    WHERE status='$status' AND tanggal_penjualan BETWEEN '$tgl_awal'
    AND '$tgl_akhir'");
while ($pecah = $ambil->fetch_assoc()) {
    $semuadata[] = $pecah;
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
        margin: 0 500px 0;
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

<h1>Data Laporan Penjualan</h1>
<div class="garis"></div>
<table border="1" class="table">
    <tr class="tr1">
        <th>No</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Jumlah</th>
    </tr>';

$total = 0;
foreach ($semuadata as $key => $value) :
    $total_belanja = $total += $value['total_penjualan'];
    $no = $key + 1;
    $nama = $value['nama_konsumen'];
    $tanggal = date("d F Y", strtotime($value['tanggal_penjualan']));
    $status = $value['status'];
    $jumlah = number_format($value['total_penjualan']);
    $total_belanja = number_format($total_belanja);

    $html .= '
    <tr>
        <th>' . $no . '</th>
        <th>' . $nama . '</th>
        <th>' . $tanggal . '</th>
        <th>' . $status . '</th>
        <th>Rp ' . $jumlah . '</th>
    </tr>';

endforeach;

$html .= '
    <tr>
        <th colspan="4">Total</th>
        <th>Rp ' . $total_belanja . '</th>
    </tr>
</table>
';



// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();
