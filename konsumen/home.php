<style>
    .sr {
        color: var(--bg);
    }

    .sr h5 {
        color: var(--bg);
        text-align: center;
    }
</style>

<?php

$id_konsumen = $_SESSION['konsumen']['id_konsumen'];

$ambil = $koneksi->query("SELECT * FROM konsumen
WHERE id_konsumen='$id_konsumen'");
$pecah = $ambil->fetch_assoc();

?>

<div class="p-3 mb-3 shadow rounded sr">
    <h5>Selamat Datang <strong><?php echo $pecah['nama_konsumen']; ?></strong></h5>
</div>

<div class="p-3 mb-3 shadow rounded sr">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama :</label>
            <div class="col-sm-9">
                <input type="text" name="judul" class="form-control" value="<?php echo $pecah['nama_konsumen']; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email :</label>
            <div class="col-sm-9">
                <input type="text" name="judul" class="form-control" value="<?php echo $pecah['email_konsumen']; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Telepon :</label>
            <div class="col-sm-9">
                <input type="text" name="judul" class="form-control" value="<?php echo $pecah['tlpn_konsumen']; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Alamat :</label>
            <div class="col-sm-9">
                <textarea type="text" name="judul" class="form-control" readonly><?php echo $pecah['alamat_konsumen']; ?></textarea>
            </div>
        </div>
    </form>
</div>