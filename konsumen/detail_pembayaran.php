<style>
    body {
        color: black;
    }
</style>

<div class="p-3 mb-3 shadow rounded">
    <h5>Detail Pembayaran</h5>
</div>

<?php

$id_penjualan = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran JOIN penjualan
ON pembayaran.id_penjualan=penjualan.id_penjualan
WHERE pembayaran.id_penjualan='$id_penjualan'");
$pecah = $ambil->fetch_assoc();

// jika konsumen belum melakukan pembayaran
if (empty($pecah)) {
    echo "<script>alert('Belum ada data pembayaran');</script>";
    echo "<script>location='index.php?page=pesanan';</script>";
}

// jika data pembayaran tidak sesuai dengan yang bayar/ yang login
if ($_SESSION['konsumen']['id_konsumen'] !== $pecah['id_konsumen']) {
    echo "<script>alert('Session tidak ditemukan');</script>";
    echo "<script>location='index.php?page=pesanan';</script>";
}



?>

<div class="alert alert-primary shadow text-dark">
    Total tagihan : <b>Rp <?php echo number_format($pecah['total_penjualan']); ?></b>
</div>

<div class="shadow bg-white p-3 mb-3 rounded">
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?php echo $pecah['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?php echo $pecah['bank']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp <?php echo number_format($pecah['jumlah']); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?php echo date("d F Y", strtotime($pecah['tanggal'])); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <img src="../assets/foto_bukti/<?php echo $pecah['bukti']; ?>" width="250" class="img-thumbnail img-responsive">
        </div>
    </div>
</div>