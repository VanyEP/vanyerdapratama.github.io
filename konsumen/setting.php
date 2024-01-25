<style>
    .sr {
        color: black;
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
    <h5>Edit Profil</h5>
</div>

<div class="p-3 mb-3 shadow rounded sr">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama :</label>
            <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_konsumen']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email :</label>
            <div class="col-sm-9">
                <input type="email" name="email" class="form-control" value="<?php echo $pecah['email_konsumen']; ?>" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password :</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" value="<?php echo $pecah['password_konsumen']; ?>" readonly>
                <a href="index.php?page=ubah_password" class="btn btn-sm btn-primary mt-2">Update Password</a>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Telepon :</label>
            <div class="col-sm-9">
                <input type="text" name="telepon" class="form-control" value="<?php echo $pecah['tlpn_konsumen']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Alamat :</label>
            <div class="col-sm-9">
                <textarea type="text" name="alamat" class="form-control"><?php echo $pecah['alamat_konsumen']; ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Foto :</label>
            <div class="col-sm-9">
                <img src="../assets/foto_konsumen/<?php echo $pecah['foto_konsumen']; ?>" width="100">
                <input type="file" name="foto" class="form-control mt-3">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
                <button name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>

<?php

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $pass = sha1($_POST['password']);
    $tlpn = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];

    move_uploaded_file($lokasi_foto, "../assets/foto_konsumen/" . $nama_foto);

    if (!empty($lokasi_foto)) {
        $koneksi->query("UPDATE konsumen SET
        nama_konsumen = '$nama',
        password_konsumen ='$pass',
        tlpn_konsumen ='$tlpn',
        alamat_konsumen ='$alamat',
        foto_konsumen = '$nama_foto'
        WHERE id_konsumen = '$id_konsumen'
        ");
    } else {
        $koneksi->query("UPDATE konsumen SET
        nama_konsumen = '$nama',
        tlpn_konsumen ='$tlpn',
        alamat_konsumen ='$alamat'
        WHERE id_konsumen = '$id_konsumen'
        ");
    }

    echo "<script>alert('Data berhasih diubah');</script>";
    echo "<script>location='index.php';</script>";
}

?>