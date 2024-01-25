<div class="shadow p-3 mb-3 bg-white">
    <h5>Halaman Laporan Konsumen</h5>
</div>

<?php

if (isset($_POST['cari'])) {
    $carialamat = $_POST['carialamat'];

    $semuaalamat = array();
    $ambil = $koneksi->query("SELECT * FROM konsumen
    WHERE alamat_konsumen='$carialamat'");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuaalamat[] = $pecah;
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
                            <input type="text" name="carialamat" class="form-control">
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
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($semuaalamat)) : ?>
                        <?php foreach ($semuaalamat as $key => $value) : ?>
                            <tr>
                                <td width="50"><?php echo $key + 1; ?></td>
                                <td>
                                    <img src="../assets/foto_konsumen/<?php echo $value['foto_konsumen']; ?>" width="150" class="img-thumbnail">
                                </td>
                                <td><?php echo $value['nama_konsumen']; ?></td>
                                <td><?php echo $value['tlpn_konsumen']; ?></td>
                                <td><?php echo $value['email_konsumen']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="alert alert-danger text-center">Data Kosong</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (!empty($semuaalamat)) : ?>
    <div class="alert alert-primary mt-3">
        <a href="download_laporankonsumen.php?carialamat=<?php echo $carialamat; ?>" class="btn btn-success" target="_blank">Download Laporan Konsumen</a>
    </div>
<?php endif ?>