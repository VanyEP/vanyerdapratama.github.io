<?php
session_start();
include 'koneksi/koneksi.php';

if (empty($_SESSION['keranjang_belanja']) or !isset($_SESSION['keranjang_belanja'])) {
    echo "<script>alert('Keranjang Kosong...');</script>";
    echo "<script>location='barang.php';</script>";
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

    <section class="page-keranjang">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li>Keranjang Belanja</li>
            </ul>

            <div class="card box">
                <div class="card-body">
                    <h2>Keranjang Belanja</h2>
                    <?php if (empty($_SESSION['keranjang_belanja'])) : ?>
                        <p>Anda mempunyai (0) item didalam keranjang belanja</p>
                    <?php else : ?>
                        <?php
                        $items = 0;
                        foreach ($_SESSION['keranjang_belanja'] as $id_barang => $jumlah) {
                            $items++;
                        }
                        ?>
                        <p>Anda mempunyai <strong>(<?php echo $items; ?>)</strong> item didalam keranjang belanja</p>
                    <?php endif; ?>

                </div>
            </div>

            <div class="card">
                <div class="card-body" style="color: black;">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($_SESSION['keranjang_belanja'] as $id_barang => $jumlah) :
                                    $ambil = $koneksi->query("SELECT * FROM barang
                                WHERE id_barang='$id_barang'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subtotal = $pecah['harga_barang'] * $jumlah;
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <img src="./assets/foto_barang/<?php echo $pecah['foto_barang']; ?>" width="50">
                                        </td>
                                        <td><?php echo $pecah['nama_barang']; ?></td>
                                        <td><?php echo $jumlah; ?></td>
                                        <td>Rp <?php echo number_format($pecah['harga_barang']); ?></td>
                                        <td>Rp <?php echo number_format($subtotal); ?></td>
                                        <td>
                                            <a href="hapus_keranjang.php?idbarang=<?php echo $pecah['id_barang']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <a href="barang.php" class="btn btn-info">Kembali Belanja</a>
                        </div>
                        <div class="col-md-2 text-right">
                            <a href="checkout.php" class="btn btn-success">Checkout</a>
                        </div>
                    </div>
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