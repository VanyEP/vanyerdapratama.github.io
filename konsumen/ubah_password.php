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

?>

<div class="p-3 mb-3 shadow rounded sr">
    <h5>Update Password</h5>
</div>

<div class="p-3 mb-3 shadow rounded sr">
    <form method="post">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password Lama :</label>
            <div class="col-sm-9">
                <input type="password" name="pass_lama" class="form-control" placeholder="Masukan passsword lama">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password Baru :</label>
            <div class="col-sm-9">
                <input type="password" name="pass_baru" class="form-control" placeholder="Masukan passsword baru">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
                <button name="update" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>

<?php

if (isset($_POST['update'])) {
    $pass_lama = sha1($_POST['pass_lama']);
    $pass_baru = sha1($_POST['pass_baru']);

    $ambil = $koneksi->query("SELECT * FROM konsumen WHERE password_konsumen='$pass_lama'");
    $pass = $ambil->num_rows;
    if ($pass == 1) {
        $koneksi->query("UPDATE konsumen SET password_konsumen='$pass_baru'
        WHERE id_konsumen='$id_konsumen'");
        echo "<script>alert('Password berhasil diubah');</script>";
        echo "<script>location='../login.php';</script>";
    } else {
        echo "<script>alert('Password salah');</script>";
        echo "<script>location='index.php?page=ubah_password';</script>";
    }
}

?>