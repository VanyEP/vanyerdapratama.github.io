    <!-- navbar start -->
    <nav class="navbar sticky-top">
        <a href="index.php" class="navbar-logo">tokosetalang<span>Tani.</span></a>
        <div class="navbar-menu">
            <a href="index.php">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="barang.php">Barang</a>
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
            <?php if (isset($_SESSION['konsumen'])) : ?>
                <a href="konsumen/index.php" class="lg">Profil</a>
                <a href="logout.php" class="lgt">Logout</a>
            <?php else : ?>
                <a href="login.php" class="lg">Login</a>
                <a href="daftar.php" class="lgt">Daftar</a>
            <?php endif; ?>

            <form action="barang.php" method="get">
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