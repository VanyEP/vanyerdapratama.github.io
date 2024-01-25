<?php
session_start();
include 'koneksi/koneksi.php';

if (isset($_GET['idkategori'])) {
    $id_kategori = $_GET['idkategori'];

    $kategori_barang = array();
    $ambil = $koneksi->query("SELECT * FROM barang JOIN kategori
    ON barang.id_kategori=kategori.id_kategori
    WHERE barang.id_kategori='$id_kategori'");

    while ($pecah = $ambil->fetch_assoc()) {
        $kategori_barang[] = $pecah;
    }
} elseif (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    $caribarang = array();
    $ambil = $koneksi->query("SELECT * FROM barang
    WHERE nama_barang LIKE '%$keyword%' OR deskripsi_barang LIKE '%$keyword%'");
    while ($pecah = $ambil->fetch_assoc()) {
        $caribarang[] = $pecah;
    }
} else {
    $barang = array();
    $ambil = $koneksi->query("SELECT * FROM barang JOIN kategori
    ON barang.id_kategori=kategori.id_kategori");

    while ($pecah = $ambil->fetch_assoc()) {
        $barang[] = $pecah;
    }
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

    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>

<body>
    <?php include 'include/navbar.php'; ?>

    <section class="page-produk">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li>Barang</li>
                <?php if (isset($keyword)) : ?>
                    <li><?php echo $keyword; ?></li>
                <?php endif ?>

            </ul>
            <div class="row">
                <div class="col-md-3">
                    <?php include 'include/sidebar.php'; ?>
                </div>
                <div class="col-md-9">
                    <div class="card box">
                        <div class="card-body">
                            <h2>Barang <span>Toko Kami</span></h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Est sunt rem voluptatum libero, nobis vitae dolorum? Eum deleniti
                                officia mollitia officiis voluptatibus id tempora nulla, in tenetur ut! Eum,
                                voluptatem veritatis architecto laboriosam, similique sequi repellat neque
                                quam cumque rerum nam nihil eveniet ipsam expedita earum excepturi dolore soluta sapiente.
                            </p>
                        </div>
                    </div>
                    <div class="row">

                        <?php if (isset($_GET['idkategori'])) : ?>
                            <?php foreach ($kategori_barang as $key => $value) : ?>
                                <div class="col-md-4 card-produk">
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

                        <?php elseif (isset($keyword)) : ?>
                            <?php foreach ($caribarang as $key => $value) : ?>
                                <div class="col-md-4 card-produk">
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

                            <?php if (empty($caribarang)) : ?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger shadow text-center pt-4">
                                        <p>Pencarian anda tidak ditemukan</p>
                                    </div>
                                </div>
                            <?php endif ?>

                        <?php else : ?>
                            <?php foreach ($barang as $key => $value) : ?>
                                <div class="col-md-4 card-produk">
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

                        <?php endif; ?>
                    </div>

                    <!-- jika barang tidak kosong -->
                    <?php if (!empty($barang)) : ?>
                        <div class="pagination justify-content-center">
                            <li class="page-item prev disabled">
                                <a href="#" class="page-link">Prev</a>
                            </li>
                            <li class="page-item halaman">
                                <a href="#" class="page-link active">1</a>
                            </li>
                            <li class="page-item dots">
                                <a href="#" class="page-link">...</a>
                            </li>
                            <li class="page-item halaman">
                                <a href="#" class="page-link">5</a>
                            </li>
                            <li class="page-item halaman">
                                <a href="#" class="page-link">6</a>
                            </li>
                            <li class="page-item dots">
                                <a href="#" class="page-link">...</a>
                            </li>
                            <li class="page-item halaman">
                                <a href="#" class="page-link">10</a>
                            </li>
                            <li class="page-item next">
                                <a href="#" class="page-link">Next</a>
                            </li>
                        </div>

                        <!-- jika cari barang dan id kategori tidak kosong -->
                    <?php elseif (!empty($caribarang) or !empty($id_kategori)) : ?>
                        <div class="pagination justify-content-center">
                            <li class="page-item prev disabled">
                                <a href="#" class="page-link">Prev</a>
                            </li>
                            <li class="page-item halaman">
                                <a href="#" class="page-link active">1</a>
                            </li>
                            <li class="page-item dots">
                                <a href="#" class="page-link">...</a>
                            </li>
                            <li class="page-item halaman">
                                <a href="#" class="page-link">5</a>
                            </li>
                            <li class="page-item halaman">
                                <a href="#" class="page-link">6</a>
                            </li>
                            <li class="page-item dots">
                                <a href="#" class="page-link">...</a>
                            </li>
                            <li class="page-item halaman">
                                <a href="#" class="page-link">10</a>
                            </li>
                            <li class="page-item next">
                                <a href="#" class="page-link">Next</a>
                            </li>
                        </div>
                    <?php elseif (empty($caribarang)) : ?>
                        <div></div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>

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