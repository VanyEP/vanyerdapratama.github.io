<?php
session_start();
include 'koneksi/koneksi.php';

$barang = array();

$ambil = $koneksi->query("SELECT * FROM barang JOIN kategori
ON barang.id_kategori=kategori.id_kategori LIMIT 6");

while ($pecah = $ambil->fetch_assoc()) {
    $barang[] = $pecah;
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Setalang Tani</title>
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

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- navbar start -->
    <?php include 'include/navbar.php'; ?>

    <!-- <nav class="navbar">
        <a href="index.php" class="navbar-logo">tokosetalang<span>Tani.</span></a>
        <div class="navbar-menu">
            <a href="index.php">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#barang">Barang</a>
            <a href="#kontak">Kontak</a>
        </div>

        <div class="navbar-icon">
            <a href="#"><i class="fas fa-search"></i></a>
            <a href="#"><i class="fas fa-shopping-cart"></i></a>
            <a href="#"><i class="fas fa-user"></i></a>
            <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>
        </div>

    </nav> -->
    <!-- navbar end -->

    <!-- hero section start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Mari Datang ke<span>Toko Kami</span></h1>
            <p>Situs Tepat dan Cepat Jual Alat dan Bahan Pertanian</p>
            <a href="barang.php" class="btn-primary">Beli Sekarang</a>
        </main>
    </section>
    <!-- hero section end -->

    <div class="container">
        <!-- about section start -->
        <section class="about" id="about">
            <h2 class="judul">Tentang <span>Kami</span></h2>
            <div class="row">
                <div class="col-md-6 about-img">
                    <img src="assets/foto/tentangkami.jpg">
                </div>
                <div class="col-md-6 content">
                    <h3>Tampilan Toko Kami</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        Repellendus asperiores architecto hic voluptas inventore laborum
                        reprehenderit distinctio nisi sequi, aliquam quidem praesentium ducimus nesciunt,
                        saepe quia perspiciatis aspernatur ab et Lorem ipsum dolor, sit amet consectetur
                        adipisicing elit. Aut, nam. Aspernatur corrupti accusamus similique, aliquam
                        reiciendis quaerat id maiores sequi est facilis explicabo quae obcaecati.
                        Ea repudiandae totam laudantium mollitia?</p>
                </div>
            </div>
        </section>
        <!-- about section end -->

        <!-- barang start -->
        <section class="barang" id="barang">
            <h2 class="judul">Barang <span>Toko Kami</span></h2>
            <div class="row">
                <?php foreach ($barang as $key => $value) : ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="assets/foto_barang/<?php echo $value['foto_barang']; ?>">
                            <div class="card-body content">
                                <h5><?php echo $value['nama_barang']; ?></h5>
                                <p>Rp <?php echo number_format($value['harga_barang']); ?></p>
                                <a href="beli.php?idbarang=<?php echo $value['id_barang']; ?>" class="btn btn-success"><i class="fas fa-shopping-cart"> Keranjang</i></a>
                                <a href="detail_barang.php?idbarang=<?php echo $value['id_barang']; ?>" class="btn btn-success"><i class="fas fa-eye"> Detail</i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
        <!-- barang end -->

        <!-- kontak start -->
        <section class="kontak" id="kontak">
            <h2 class="judul">Kontak <span>Kami</span></h2>
            <div class="row">
                <div class="col-md-6 kontak-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d989.4186000754461!2d110.182736231904!3d-7.277839861243044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e707856b7705a19%3A0xcd5b771d10c522ee!2sToko%20Pertanian%20%26%20Obat-obatan%20Setalang%20Tani!5e0!3m2!1sid!2sid!4v1700905573039!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="col-md-6 kontak-form">
                    <form method="post">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Nama Lengkap :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Email :</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">No telepon :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="telepon" class="form-control" placeholder="No telepon" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Pesan :</label>
                                    <div class="col-sm-8">
                                        <textarea type="text" name="pesan" class="form-control" placeholder="Masukan Pesan Anda" required></textarea>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button name="kirim" class="btn btn-success">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- kontak end -->
    </div>

    <?php

    if (isset($_POST['kirim'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        $pesan = $_POST['pesan'];

        $koneksi->query("INSERT INTO pesan
        (nama,email,telepon,isi_pesan)
        VALUES ('$nama','$email','$telepon','$pesan')");

        echo "<script>alert('Pesan terkirim');</script>";
        echo "<script>location='kontak.php';</script>";
    }

    ?>

    <!-- footer start -->
    <?php include 'include/footer.php'; ?>

    <!-- <footer>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h3>Quick <span>Link</span></h3>
                    <ul class="footer-menu">
                        <a href="#home">Home</a>
                        <a href="#about">Tentang Kami</a>
                        <a href="#barang">Barang</a>
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
            <p>Created By <span>VanyEP</span> | &copy; 2023.</p>
        </div>
    </footer> -->
    <!-- footer end -->


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