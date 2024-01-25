<?php

include 'koneksi/koneksi.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&
display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>

<body>
    <?php include 'include/navbar.php'; ?>

    <div class="container">

        <!-- Outer Row -->
        <br><br><br>
        <div class="row justify-content-center" id="login">
            <div class="col-md-6">
                <div class="card o-hidden border border-primary rounded-10 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Daftar</h1>
                                    </div>
                                    <form method="post" enctype="multipart/form-data" class="user">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Nama Lengkap :</label>
                                            <div class="col-sm-12">
                                                <input type="text" name="nama" class="form-control" placeholder="Masukan nama" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password :</label>
                                            <div class="col-sm-12">
                                                <input type="password" name="password" class="form-control" placeholder="Masukan password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Telepon :</label>
                                            <div class="col-sm-12">
                                                <input type="number" name="telepon" class="form-control" placeholder="Masukan telepon" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Alamat :</label>
                                            <div class="col-sm-12">
                                                <textarea type="text" name="alamat" class="form-control" placeholder="Masukan alamat" required></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Email :</label>
                                            <div class="col-sm-12">
                                                <input type="email" name="email" class="form-control" placeholder="Masukan email" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Foto :</label>
                                            <div class="col-sm-12">
                                                <input type="file" name="foto" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <button name="daftar" class="btn btn-primary">
                                                Daftar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
    if (isset($_POST['daftar'])) {
        $nama = $_POST['nama'];
        $password = sha1($_POST['password']);
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];

        $nama_foto = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES['foto']['tmp_name'];

        move_uploaded_file($lokasi_foto, "./assets/foto_konsumen/" . $nama_foto);

        $ambil = $koneksi->query("SELECT * FROM konsumen WHERE email_konsumen='$email'");

        $ada_email = $ambil->num_rows;
        if ($ada_email == 1) {
            echo "<script>alert('Pendaftaran gagal, email sudah digunakan!!');</script>";
            echo "<script>location='daftar.php';</script>";
        } else {
            $koneksi->query("INSERT INTO konsumen(nama_konsumen,
            password_konsumen,tlpn_konsumen,alamat_konsumen,email_konsumen,foto_konsumen)
            VALUES('$nama','$password','$telepon','$alamat','$email','$nama_foto')");

            echo "<script>alert('Pendaftaran sukses, silahkan login!!');</script>";
            echo "<script>location='login.php';</script>";
        }
    }

    ?>

    <?php include 'include/footer.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <!-- js buat tombol btn menu -->
    <script src="assets/js/main.js"></script>
</body>

</html>