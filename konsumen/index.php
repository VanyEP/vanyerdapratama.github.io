<?php
session_start();
include '../koneksi/koneksi.php';

if (!isset($_SESSION['konsumen']['id_konsumen'])) {
    echo "<script>alert('Silahkan Login!!');</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}

$id_konsumen = $_SESSION['konsumen']['id_konsumen'];

$ambil = $koneksi->query("SELECT * FROM konsumen
WHERE id_konsumen='$id_konsumen'");
$pecah = $ambil->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&
display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
</head>

<body>
    <!-- navbar start -->
    <nav class="navbar sticky-top">
        <a href="../index.php" class="navbar-logo">tokosetalang<span>Tani.</span></a>
        <div class="navbar-menu">
            <a href="../index.php">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="../barang.php">Barang</a>
            <a href="#kontak">Kontak</a>
        </div>

        <div class="navbar-icon">
            <a href="#" id="btn-search"><i class="fas fa-search"></i></a>
            <?php if (empty($_SESSION['keranjang_belanja'])) : ?>
                <a href="keranjang.php"><i class="fas fa-shopping-cart">(0)</i></a>
            <?php else : ?>
                <?php
                $items = 0;
                foreach ($_SESSION['keranjang_belanja'] as $id_barang => $jumlah) {
                    $items++;
                }
                ?>
                <a href="keranjang.php"><i class="fas fa-shopping-cart">(<?php echo $items; ?>)</i></a>
            <?php endif; ?>
            <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>

            <a href="index.php" class="lg">Profil</a>
            <a href="../logout.php" class="lgt">Logout</a>

            <form action="../barang.php" method="get">
                <div class="search-form">
                    <input type="search" name="keyword" id="search-box" class="form-control" placeholder="Seacrh">
                    <button for="search-box" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </nav>
    <!-- navbar end -->

    <section class="page-profil">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="../index.php">Home</a></li>
                <li>Profil</li>
            </ul>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="img">
                                <img src="../assets/foto_konsumen/<?php echo $pecah['foto_konsumen']; ?>" class="rounded-circle rounded mx-auto d-block" width="150">
                            </div>
                            <div class="card-title">
                                <h2><?php echo $pecah['nama_konsumen']; ?></h2>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="index.php?page=home" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=pesanan" class="nav-link">Pesanan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=setting" class="nav-link">Setting</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if (isset($_GET['page'])) {
                                if ($_GET['page'] == "home") {
                                    include 'home.php';
                                }
                                if ($_GET['page'] == "pesanan") {
                                    include 'pesanan.php';
                                } elseif ($_GET['page'] == "detail_transaksi") {
                                    include 'detail_transaksi.php';
                                } elseif ($_GET['page'] == "setting") {
                                    include 'setting.php';
                                } elseif ($_GET['page'] == "ubah_password") {
                                    include 'ubah_password.php';
                                } elseif ($_GET['page'] == "pembayaran") {
                                    include 'pembayaran.php';
                                } elseif ($_GET['page'] == "detail_pembayaran") {
                                    include 'detail_pembayaran.php';
                                }
                            } else {
                                include 'home.php';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h3>Quick <span>Link</span></h3>
                    <ul class="footer-menu">
                        <a href="../index.php">Home</a>
                        <a href="#about">Tentang Kami</a>
                        <a href="../barang.php">Barang</a>
                        <a href="#kontak">Kontak</a>
                    </ul>
                </div>
                <div class="col-4">
                    <h3>Info <span>Kontak</span></h3>
                    <ul class="footer-kontak">
                        <a href="#">0832-1234-5678</a>
                        <a href="#">tokosetalangtani@gmail.com</a>
                        <a href="#">Temanggung</a>
                    </ul>
                </div>
                <div class="col-4">
                    <h3>Follow <span>Us</span></h3>
                    <ul class="footer-sosmed">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="created">
            <p>Created By <span>VanyEP</span> | &copy; 2024.</p>
        </div>
    </footer>
    <!-- footer end -->

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <!-- js buat tombol btn menu -->
    <script src="../assets/js/main.js"></script>
</body>

</html>