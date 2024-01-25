<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Kategori Barang</h5>
    </div>

    <?php
    $kategori = array();
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while ($pecah = $ambil->fetch_assoc()) {
        $kategori[] = $pecah;
    }

    ?>

    <a href="index2.php?halaman=tambah_kategori" class="btn btn-sm btn-success">Tambah</a>

    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kategori as $key => $value) : ?>
                        <tr>
                            <th width="50"><?php echo $key + 1; ?></th>
                            <th><?php echo $value['nama_kategori']; ?></th>
                            <th width="200">
                                <a href="index2.php?halaman=edit_kategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="index2.php?halaman=hapus_kategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </th>
                        </tr>
                    <?php endforeach ?>
                </tBody>
            </table>
        </div>
    </div>
</body>

</html>