<?php
session_start();
include 'koneksi/koneksi.php';

// jika konsumen belum login
if (!isset($_SESSION['konsumen'])) {
    echo "<script>alert('Silahkan Login!!');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// jika keranjang kosong
if (empty($_SESSION['keranjang_belanja']) or !isset($_SESSION['keranjang_belanja'])) {
    echo "<script>alert('Keranjang Kosong...');</script>";
    echo "<script>location='barang.php';</script>";
    exit();
}

$id_konsumen = $_SESSION['konsumen']['id_konsumen'];
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
                                    <th>Subharga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $subtotal = 0;
                                foreach ($_SESSION['keranjang_belanja'] as $id_barang => $jumlah) :
                                    $ambil = $koneksi->query("SELECT * FROM barang
                                WHERE id_barang='$id_barang'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subharga = $pecah['harga_barang'] * $jumlah;
                                    $subberat = $pecah['berat_barang'] * $jumlah;
                                    $totalbelanja = $subtotal += $subharga;
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <img src="./assets/foto_barang/<?php echo $pecah['foto_barang']; ?>" width="50">
                                        </td>
                                        <td><?php echo $pecah['nama_barang']; ?></td>
                                        <td><?php echo $jumlah; ?></td>
                                        <td>Rp <?php echo number_format($pecah['harga_barang']); ?></td>
                                        <td>Rp <?php echo number_format($subharga); ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-right">Total Belanja</th>
                                    <th>Rp <?php echo number_format($totalbelanja); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="form-control text-center" value="<?php echo $_SESSION['konsumen']['nama_konsumen']; ?>" readonly>
                            <input type="text" class="form-control text-center mt-3" value="<?php echo $_SESSION['konsumen']['email_konsumen']; ?>" readonly>
                            <input type="text" class="form-control text-center mt-3" value="<?php echo $_SESSION['konsumen']['tlpn_konsumen']; ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group row">
                                    <label class="col-sm-3 col form-label" style="color: black;">Alamat :</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Anda..">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col form-label" style="color: black;">Provinsi :</label>
                                    <div class="col-sm-9">
                                        <select name="provinsi" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col form-label" style="color: black;">Kota/Kabupaten :</label>
                                    <div class="col-sm-9">
                                        <select name="distrik" class="form-control">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col form-label" style="color: black;">Paket :</label>
                                    <div class="col-sm-9">
                                        <select name="paket" class="form-control">
                                        </select>
                                    </div>
                                </div>

                                <input type="text" name="total_berat" class="form-control" value="<?php echo $subberat; ?>" hidden>
                                <input type="text" name="nama_provinsi" class="form-control mt-3" hidden>
                                <input type="text" name="nama_distrik" class="form-control mt-3" hidden>
                                <input type="text" name="type_distrik" class="form-control mt-3" hidden>
                                <input type="text" name="kode_pos" class="form-control mt-3" hidden>
                                <input type="text" name="paket" class="form-control mt-3" hidden>
                                <input type="text" name="ongkir" class="form-control mt-3" hidden>
                                <input type="text" name="estimasi" class="form-control mt-3" hidden>

                                <div class="text-right">
                                    <button name="checkout" class="btn btn-success">Checkout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

    if (isset($_POST['checkout'])) {
        $id_konsumen = $_SESSION['konsumen']['id_konsumen'];
        $tanggal_penjualan = date('y-m-d');
        $alamat = $_POST['alamat'];
        $berat = $_POST['total_berat'];
        $provinsi = $_POST['nama_provinsi'];
        $distrik = $_POST['nama_distrik'];
        $type = $_POST['type_distrik'];
        $pos = $_POST['kode_pos'];
        $paket = $_POST['paket'];
        $ongkir = $_POST['ongkir'];
        $estimasi = $_POST['estimasi'];
        $total_penjualan = $totalbelanja + $ongkir;

        $koneksi->query("INSERT INTO penjualan
        (id_konsumen,tanggal_penjualan,total_penjualan,
        alamat,total_berat,provinsi,distrik,type,
        kode_pos,paket,ongkir,estimasi) 
        VALUES('$id_konsumen',
        '$tanggal_penjualan',
        '$total_penjualan',
        '$alamat',
        '$berat',
        '$provinsi',
        '$distrik',
        '$type',
        '$pos',
        '$paket',
        '$ongkir',
        '$estimasi')");

        $id_penjualan_baru = $koneksi->insert_id;

        foreach ($_SESSION['keranjang_belanja'] as $id_barang => $jumlah) {
            $ambil = $koneksi->query("SELECT * FROM barang 
            WHERE id_barang='$id_barang'");
            $pecah = $ambil->fetch_assoc();
            $nama = $pecah['nama_barang'];
            $harga = $pecah['harga_barang'];
            $berat = $pecah['berat_barang'];
            $subberat = $pecah['berat_barang'] * $jumlah;
            $subharga = $pecah['harga_barang'] * $jumlah;

            $koneksi->query("INSERT INTO penjualan_detail
            (id_penjualan,id_barang,nama,harga,berat,subberat,subharga,total)
            VALUES('$id_penjualan_baru','$id_barang','$nama','$harga',
            '$berat','$subberat','$subharga','$total')");

            $koneksi->query("UPDATE barang SET stok_barang=stok_barang -$jumlah
            WHERE id_barang='$id_barang'");
        }

        unset($_SESSION['keranjang_belanja']);
        echo "<script>alert('Pembelian Berhasil');</script>";
        echo "<script>location='konsumen/index.php?page=pesanan';</script>";
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