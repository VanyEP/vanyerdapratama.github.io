<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Admin</h5>
    </div>

    <?php

    $id_admin = $_SESSION['admin']['id_admin'];
    $ambil = $koneksi->query("SELECT * FROM admin WHERE id_admin='$id_admin'");
    $admin = $ambil->fetch_assoc();

    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama admin : </label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" value="<?php echo $admin['nama_lengkap']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Username : </label>
                            <div class="col-sm-9">
                                <input type="text" name="user" class="form-control" value="<?php echo $admin['username']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password : </label>
                            <div class="col-sm-9">
                                <input type="text" name="password" class="form-control" placeholder="Kosongkan password jika tidak diubah...">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button name="update" class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="../assets/foto_admin/<?php echo $admin['foto_admin']; ?>" width="250" class="img-thumbnail img-responsive">
                        <input type="file" name="foto" class="form-control mt-3">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php

    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $user = $_POST['user'];
        $password = sha1($_POST['password']);

        $nama_foto = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES['foto']['tmp_name'];

        // jika foto admin diubah
        if (!empty($lokasi_foto)) {
            move_uploaded_file($lokasi_foto, "../assets/foto_admin/" . $nama_foto);

            // jika password admin diubah
            if (!empty($_POST['password'])) {
                $koneksi->query("UPDATE admin SET
                username='$user',
                password='$password',
                nama_lengkap='$nama',
                foto_admin='$nama_foto'
                WHERE id_admin='$id_admin'");
            }
            // jika password tidak diubah
            else {
                $koneksi->query("UPDATE admin SET
                username='$user',
                nama_lengkap='$nama',
                foto_admin='$nama_foto'
                WHERE id_admin='$id_admin'");
            }
        }
        // jika foto admin tidak diubah
        else {
            if (!empty($_POST['password'])) {
                $koneksi->query("UPDATE admin SET
                username='$user',
                password='$password',
                nama_lengkap='$nama'
                WHERE id_admin='$id_admin'");
            }
            // jika foto dan password admin tidak diubah
            else {
                $koneksi->query("UPDATE admin SET
                username='$user',
                nama_lengkap='$nama'
                WHERE id_admin='$id_admin'");
            }
        }

        echo "<script>alert('Data admin berhasil diubah..');</script>";
        echo "<script>location='index2.php?halaman=admin';</script>";
    }

    ?>
</body>

</html>