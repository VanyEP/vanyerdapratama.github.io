<?php
// Require composer autoload
require_once '../koneksi/koneksi.php';
require_once '../vendor/autoload.php';

// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

$carialamat = $_GET['carialamat'];

$semuaalamat = array();
$ambil = $koneksi->query("SELECT * FROM konsumen
    WHERE alamat_konsumen='$carialamat'");
while ($pecah = $ambil->fetch_assoc()) {
    $semuaalamat[] = $pecah;
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

<h1>Data Laporan Konsumen</h1>
<div class="garis"></div>
<table border="1" class="table">
    <tr class="tr1">
        <th>No</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Email</th>
    </tr>';

foreach ($semuaalamat as $key => $value) :
    $no = $key + 1;
    $nama = $value['nama_konsumen'];
    $telepon = $value['tlpn_konsumen'];
    $email = $value['email_konsumen'];

    $html .= '
    <tr>
        <th>' . $no . '</th>
        <th>' . $nama . '</th>
        <th>' . $telepon . '</th>
        <th>' . $email . '</th>
    </tr>';
endforeach;

$html .= '
</table>

';


// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();
