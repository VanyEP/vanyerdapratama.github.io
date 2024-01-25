<div class="shadow p-3 mb-3 bg-white">
    <h5>Halaman Laporan Penjualan</h5>
</div>

<?php

if (isset($_POST['cari'])) {
    $tgl_awal = $_POST['tglawal'];
    $tgl_akhir = $_POST['tglakhir'];
    $status = $_POST['status'];

    $semuadata = array();
    $ambil = $koneksi->query("SELECT * FROM penjualan
    JOIN konsumen ON penjualan.id_konsumen=konsumen.id_konsumen
    WHERE status='$status' AND tanggal_penjualan BETWEEN '$tgl_awal'
    AND '$tgl_akhir'");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuadata[] = $pecah;
    }

    // echo "<pre>";
    // print_r($semuadata);
    // echo "</pre>";
}
?>

<?php if (!empty($semuadata)) : ?>
    <div class="alert alert-info shadow">
        <p>
            Laporan penjualan dari <strong><?php echo date("d F Y", strtotime($tgl_awal)); ?></strong> sampai
            <strong><?php echo date("d F Y", strtotime($tgl_akhir)); ?></strong>
        </p>
    </div>
<?php endif ?>



<div class="card shadow bg-white">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Tanggal Awal : </label>
                        <div class="col-sm-7">
                            <input type="date" name="tglawal" class="form-control" value="<?php echo $tgl_awal; ?>">
                        </div>
                        <label class="col-sm-5 col-form-label mt-3">Tanggal Akhir : </label>
                        <div class="col-sm-7 mt-3">
                            <input type="date" name="tglakhir" class="form-control" value="<?php echo $tgl_akhir; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="status" class="form-control">
                                <option selected disabled>Pilih Status</option>
                                <option value="pending">Pending</option>
                                <option value="pembayaran dikonfirmasi">Pembayaran Dikonfirmasi</option>
                                <option value="barang dikirim">Barang Dikirim</option>
                                <option value="pengiriman dibatalkan">Pengiriman Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <button name="cari" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($semuadata)) : ?>
                        <?php $total = 0; ?>
                        <?php foreach ($semuadata as $key => $value) : ?>
                            <?php $total += $value['total_penjualan']; ?>
                            <tr>
                                <td width="50"><?php echo $key + 1; ?></td>
                                <td><?php echo $value['nama_konsumen']; ?></td>
                                <td><?php echo date("d F Y", strtotime($value['tanggal_penjualan'])); ?></td>
                                <td><?php echo $value['status'] ?></td>
                                <td>Rp <?php echo number_format($value['total_penjualan']); ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="alert alert-danger text-center">
                                <p>Data Kosong</p>
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <?php if (!empty($semuadata)) : ?>
                        <tr>
                            <th colspan="4">Total</th>
                            <th>Rp <?php echo number_format($total); ?></th>
                        </tr>
                    <?php endif ?>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php if (!empty($semuadata)) : ?>
    <div class="alert alert-primary bg-white shadow mt-2">
        <a href="download_laporan.php?tglawal=<?php echo $tgl_awal; ?>&tglakhir=<?php echo $tgl_akhir; ?>
        &status=<?php echo $status; ?>" class="btn btn-success" target="_blank">Download Laporan Penjualan</a>
    </div>
<?php endif ?>