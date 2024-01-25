<?php
session_start();
include '../koneksi/koneksi.php';

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// data admin
$id_admin = $_SESSION['admin']['id_admin'];
$ambil = $koneksi->query("SELECT * FROM admin WHERE id_admin='$id_admin'");
$admin = $ambil->fetch_assoc();


// data pembayaran
$data_pem = array();
$item_pem = 0;
$ambil = $koneksi->query("SELECT * FROM pembayaran");
while ($pem = $ambil->fetch_assoc()) {
    $data_pem[] = $pem;
    $item_pem++;
}

// data pesan
$data_pesan = array();
$item_pesan = 0;
$ambil = $koneksi->query("SELECT * FROM pesan");
while ($pesan = $ambil->fetch_assoc()) {
    $data_pesan[] = $pesan;
    $item_pesan++;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Toko Setalang Tani</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sb" id="accordionSidebar">

            <!-- Sidebar Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index2.php">
                <div class="sidebar-brand-icon">
                    <i class="material-icons">storefront</i>
                </div>
                <div class="sidebar-brand-text mx-2">Toko Setalang Tani</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index2.php">
                    <i class="fas fa-home fa-sm"></i>
                    <span>Home</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index2.php?halaman=barang">
                    <i class="material-icons">inventory</i>
                    <span>Barang</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index2.php?halaman=kategori">
                    <i class="material-icons">category</i>
                    <span>Kategori Barang</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index2.php?halaman=konsumen">
                    <i class="material-icons">groups</i>
                    <span>Konsumen</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index2.php?halaman=pesan">
                    <i class="material-icons">message</i>
                    <span>Pesan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index2.php?halaman=transaksi">
                    <i class="material-icons">paid</i>
                    <span>Transaksi</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index2.php?halaman=laporan_penjualan">
                    <i class="material-icons">book</i>
                    <span>Laporan Penjualan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index2.php?halaman=laporan_konsumen">
                    <i class="material-icons">people</i>
                    <span>Laporan Konsumen</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index2.php?halaman=laporan_barang">
                    <i class="material-icons">inventory</i>
                    <span>Laporan Barang</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index2.php?halaman=logout">
                    <i class="material-icons">logout</i>
                    <span>Logout</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"><?php echo $item_pem; ?></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Data Pembayaran
                                </h6>

                                <?php foreach ($data_pem as $key => $value) : ?>
                                    <a class="dropdown-item d-flex align-items-center" href="index2.php?halaman=pembayaran&id=<?php echo $value['id_penjualan']; ?>">
                                        <div>
                                            <div class="small text-gray-500"><?php echo date("d F Y", strtotime($value['tanggal'])); ?></div>
                                            Rp <?php echo number_format($value['jumlah']); ?>
                                            <br>
                                            <?php echo $value['nama']; ?>
                                        </div>
                                    </a>
                                <?php endforeach ?>
                                <a class="dropdown-item text-center small text-gray-500" href="index2.php?halaman=transaksi">Lihat Semua</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"><?php echo $item_pesan; ?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Pesan Konsumen
                                </h6>

                                <?php foreach ($data_pesan as $key => $value) : ?>
                                    <a class="dropdown-item d-flex align-items-center" href="index2.php?halaman=detail_pesan&id=<?php echo $value['id_pesan']; ?>">
                                        <div class="font-weight-bold">
                                            <div class="text-truncate"><?php echo $value['nama']; ?></div>
                                            <div class="small text-gray-500"><?php echo $value['email']; ?></div>
                                        </div>
                                    </a>
                                <?php endforeach ?>
                                <a class="dropdown-item text-center small text-gray-500" href="index2.php?halaman=pesan">Lihat Pesan Semua</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $admin['nama_lengkap']; ?></span>
                                <img class="img-profile rounded-circle" src="../assets/foto_admin/<?php echo $admin['foto_admin']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="index2.php?halaman=admin">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php
                    if (isset($_GET['halaman'])) {
                        // halaman admin
                        if ($_GET['halaman'] == "admin") {
                            include 'admin.php';
                        }

                        // data pesan
                        elseif ($_GET['halaman'] == "pesan") {
                            include 'pesan.php';
                        } elseif ($_GET['halaman'] == "detail_pesan") {
                            include 'detail/detail_pesan.php';
                        } elseif ($_GET['halaman'] == "hapus_pesan") {
                            include 'hapus/hapus_pesan.php';
                        }

                        // halaman barang
                        elseif ($_GET['halaman'] == "barang") {
                            include 'barang.php';
                        } elseif ($_GET['halaman'] == "tambah_barang") {
                            include 'tambah/tambah_barang.php';
                        } elseif ($_GET['halaman'] == "detail_barang") {
                            include 'detail/detail_barang.php';
                        } elseif ($_GET['halaman'] == "hapus_foto") {
                            include 'hapus/hapus_foto.php';
                        } elseif ($_GET['halaman'] == "edit_barang") {
                            include 'edit/edit_barang.php';
                        } elseif ($_GET['halaman'] == "hapus_barang") {
                            include 'hapus/hapus_barang.php';
                        }

                        // halaman kategori
                        elseif ($_GET['halaman'] == "kategori") {
                            include 'kategoribarang.php';
                        } elseif ($_GET['halaman'] == "tambah_kategori") {
                            include 'tambah/tambah_kategori.php';
                        } elseif ($_GET['halaman'] == "edit_kategori") {
                            include 'edit/edit_kategori.php';
                        } elseif ($_GET['halaman'] == "hapus_kategori") {
                            include 'hapus/hapus_kategori.php';
                        }

                        // halaman konsumen
                        elseif ($_GET['halaman'] == "konsumen") {
                            include 'konsumen.php';
                        } elseif ($_GET['halaman'] == "hapus_konsumen") {
                            include 'hapus/hapus_konsumen.php';
                        }

                        // halaman logout 
                        elseif ($_GET['halaman'] == "logout") {
                            include 'logout.php';
                        }

                        // halaman transaksi
                        elseif ($_GET['halaman'] == "transaksi") {
                            include 'transaksi.php';
                        } elseif ($_GET['halaman'] == "detail_transaksi") {
                            include "detail/detail_transaksi.php";
                        } elseif ($_GET['halaman'] == "pembayaran") {
                            include "pembayaran.php";
                        } elseif ($_GET['halaman'] == "laporan_penjualan") {
                            include "laporan_penjualan.php";
                        } elseif ($_GET['halaman'] == "laporan_konsumen") {
                            include "laporan_konsumen.php";
                        } elseif ($_GET['halaman'] == "laporan_barang") {
                            include "laporan_barang.php";
                        }

                        // halaman home
                    } else {
                        include 'home.php';
                    }

                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar...</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin ingin keluar?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index2.php?halaman=logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        $(document).ready(function() {
            $(".btn-tambah").on("click", function() {
                $(".input-foto").append("<input type='file' name='foto[]' class='form-control'>");
            })
        })
    </script>

</body>

</html>