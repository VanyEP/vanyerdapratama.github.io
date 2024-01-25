<div class="shadow p-3 mb-3 bg-white">
    <h5>Halaman Laporan Barang</h5>
</div>

<?php

if (isset($_POST['cari'])) {
    $caristok = $_POST['caristok'];

    $semuastok = array();
    $ambil = $koneksi->query("SELECT * FROM barang
    JOIN kategori ON barang.id_kategori=kategori.id_kategori
    WHERE stok_barang='$caristok'");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuastok[] = $pecah;
    }
}

?>

<div class="card shadow bg-white">
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Cari : </label>
                        <div class="col-sm-7">
                            <input type="text" name="caristok" class="form-control">
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
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($semuastok)) : ?>
                        <?php foreach ($semuastok as $key => $value) : ?>
                            <tr>
                                <td width="50"><?php echo $key + 1; ?></td>
                                <td><?php echo $value['nama_kategori']; ?></td>
                                <td><?php echo $value['nama_barang']; ?></td>
                                <td><?php echo number_format($value['harga_barang']); ?></td>
                                <td><?php echo number_format($value['berat_barang']); ?></td>
                                <td class="text-center">
                                    <img width="100" src="../assets/foto_barang/<?php echo $value['foto_barang']; ?>">
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="alert alert-danger text-center">Data Kosong</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (!empty($semuastok)) : ?>
    <div class="alert alert-primary mt-3">
        <a href="download_laporanbarang.php?caristok=<?php echo $caristok; ?>" class="btn btn-success" target="_blank">Download Laporan Barang</a>
    </div>
<?php endif ?>