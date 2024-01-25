<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Barang</h5>
    </div>

    <?php
    $barang = array();
    $ambil = $koneksi->query("SELECT * FROM barang JOIN kategori
    ON barang.id_kategori=kategori.id_kategori");
    while ($pecah = $ambil->fetch_assoc()) {
        $barang[] = $pecah;
    }
    ?>

    <a href="index2.php?halaman=tambah_barang" class="btn btn-sm btn-success">Tambah</a>

    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Foto</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($barang as $key => $value) : ?>
                        <tr>
                            <td width="50"><?php echo $key + 1; ?></td>
                            <td><?php echo $value['nama_kategori']; ?></td>
                            <td><?php echo $value['nama_barang']; ?></td>
                            <td><?php echo number_format($value['harga_barang']); ?></td>
                            <td><?php echo number_format($value['berat_barang']); ?></td>
                            <td class="text-center">
                                <img width="100" src="../assets/foto_barang/<?php echo $value['foto_barang']; ?>">
                            </td>
                            <td class="text-center">
                                <a href="index2.php?halaman=hapus_barang&id=<?php echo $value['id_barang']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                                <a href="index2.php?halaman=detail_barang&id=<?php echo $value['id_barang']; ?>" class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>