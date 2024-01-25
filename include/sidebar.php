<?php

include 'koneksi/koneksi.php';

$kategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($pecah = $ambil->fetch_assoc()) {
    $kategori[] = $pecah;
}

?>



<div class="card">
    <div class="card-header">Kategori Barang</div>
    <div class="card-body">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="barang.php" class="nav-link">Semua Produk</a>
            </li>
            <?php foreach ($kategori as $key => $value) : ?>
                <li class="nav-item">
                    <a href="barang.php?idkategori=<?php echo $value['id_kategori']; ?>" class="nav-link">
                        <?php echo $value['nama_kategori']; ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>