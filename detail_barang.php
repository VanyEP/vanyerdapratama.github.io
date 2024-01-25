<?php
session_start();
include 'koneksi/koneksi.php';

$id_barang =  $_GET['idbarang'];

$ambil = $koneksi->query("SELECT * FROM barang 
WHERE id_barang='$id_barang'");
$barang = $ambil->fetch_assoc();

$barangfoto = array();
$ambil = $koneksi->query("SELECT * FROM barang_foto 
WHERE id_barang='$id_barang'");
while ($pecah = $ambil->fetch_assoc()) {
    $barangfoto[] = $pecah;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Barang</title>
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

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'include/navbar.php'; ?>

    <section class="page-produk">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li>Detail Barang</li>
            </ul>
            <div class="row">
                <div class="col-md-3">
                    <?php include 'include/sidebar.php'; ?>
                </div>
                <div class="col-md-9 detail-barang">
                    <div class="row">
                        <div class="col-6">
                            <?php foreach ($barangfoto as $key => $value) : ?>
                                <div class="item">
                                    <img src="assets/foto_barang/<?php echo $value['nama_barang_foto']; ?>">
                                </div>
                            <?php endforeach ?>
                        </div>

                        <div class="col-6 detail-form">
                            <form method="post">
                                <div class="card">
                                    <div class="card-body">
                                        <h3><?php echo $barang['nama_barang']; ?></h3>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jumlah :</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="jumlah" class="form-control" value="1" min="1" max="<?php echo $barang['stok_barang']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Stok :</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control" value="<?php echo $barang['stok_barang']; ?>">
                                            </div>
                                        </div>
                                        <h5>Rp <?php echo number_format($barang['harga_barang']); ?></h5>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button name="beli" class="btn btn-success"><i class="fas fa-shopping-cart"> Keranjang</i></button>
                                    </div>
                                </div>
                                <div class="card detail crd-detail">
                                    <div class="card-body">
                                        <h3>Detail Barang</h3>
                                        <p><?php echo $barang['deskripsi_barang']; ?></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_POST['beli'])) {
        $jumlah = $_POST['jumlah'];
        $_SESSION['keranjang_belanja'][$id_barang] = $jumlah;

        echo "<script>alert('Barang berhasil masuk keranjang');</script>";
        echo "<script>location='keranjang.php';</script>";
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