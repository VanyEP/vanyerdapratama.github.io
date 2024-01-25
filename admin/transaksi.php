<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Transaksi</h5>
    </div>
    <?php
    $penjualan = array();
    $ambil = $koneksi->query("SELECT * FROM penjualan JOIN konsumen
    ON penjualan.id_konsumen=konsumen.id_konsumen");
    while ($pecah = $ambil->fetch_assoc()) {
        $penjualan[] = $pecah;
    }

    ?>

    <div class="card shadow bg-white">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualan as $key => $value) : ?>
                        <tr>
                            <td width="50"><?php echo $key + 1; ?></td>
                            <td><?php echo $value['nama_konsumen']; ?></td>
                            <td><?php echo date("d F Y", strtotime($value['tanggal_penjualan'])); ?></td>
                            <td>Rp <?php echo number_format($value['total_penjualan']); ?></td>
                            <td><?php echo $value['status']; ?></td>
                            <td class="text-center">
                                <a href="index2.php?halaman=detail_transaksi&id=<?php echo $value['id_penjualan']; ?>" class="btn btn-sm btn-info">Detail</a>
                                <!-- jika status tidak pending -->
                                <?php if ($value['status'] !== 'pending') : ?>
                                    <a href="index2.php?halaman=pembayaran&id=<?php echo $value['id_penjualan']; ?>" class="btn btn-sm btn-success">Lihat Pembayaran</a>
                                <?php endif ?>


                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>