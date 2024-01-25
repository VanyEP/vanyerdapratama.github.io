<style>
    h5 {
        color: black;
        text-align: center;
    }
</style>

<div class="p-3 mb-3 shadow rounded">
    <h5>Pesanan Saya</h5>
</div>

<?php

$id_konsumen = $_SESSION['konsumen']['id_konsumen'];

$penjualan = array();
$ambil = $koneksi->query("SELECT * FROM penjualan JOIN konsumen
ON penjualan.id_konsumen=konsumen.id_konsumen
WHERE penjualan.id_konsumen='$id_konsumen'");
while ($pecah = $ambil->fetch_assoc()) {
    $penjualan[] = $pecah;
}

?>

<div class="card shadow" style="color: black;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualan as $key => $value) : ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo date("d F Y", strtotime($value['tanggal_penjualan'])); ?></td>
                            <td>Rp <?php echo number_format($value['total_penjualan']); ?></td>
                            <?php if ($value['status'] == 'pending') : ?>
                                <td class="text-center text-danger">
                                    <?php echo $value['status']; ?><br>

                                    <!-- jika resi pengiriman tidak kosong -->
                                    <?php if (!empty($value['resi_pengiriman'])) : ?>
                                        <?php echo $value['resi_pengiriman']; ?>
                                    <?php endif ?>
                                </td>
                            <?php else : ?>
                                <td class="text-center text-success">
                                    <?php echo $value['status']; ?><br>

                                    <!-- jika resi pengiriman tidak kosong -->
                                    <?php if (!empty($value['resi_pengiriman'])) : ?>
                                        <?php echo $value['resi_pengiriman']; ?>
                                    <?php endif ?>
                                </td>
                            <?php endif ?>

                            <td class="text-center" width="250">
                                <a href="index.php?page=detail_transaksi&id=<?php echo $value['id_penjualan']; ?>" class="btn btn-primary">Nota</a>
                                <!-- jika status pending -->
                                <?php if ($value['status'] == 'pending') : ?>
                                    <a href="index.php?page=pembayaran&id=<?php echo $value['id_penjualan']; ?>" class="btn btn-success">Pembayaran</a>
                                <?php else : ?>
                                    <a href="index.php?page=detail_pembayaran&id=<?php echo $value['id_penjualan']; ?>" class="btn btn-info">Lihat Pembayaran</a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>