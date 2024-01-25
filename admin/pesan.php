<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Pesan</h5>
    </div>

    <?php
    $pesan = array();
    $ambil = $koneksi->query("SELECT * FROM pesan");
    while ($pecah = $ambil->fetch_assoc()) {
        $pesan[] = $pecah;
    }

    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesan as $key => $value) : ?>
                        <tr>
                            <th width="50"><?php echo $key + 1; ?></th>
                            <th><?php echo $value['nama']; ?></th>
                            <th><?php echo $value['email']; ?></th>
                            <th><?php echo $value['telepon']; ?></th>
                            <th width="200">
                                <a href="index2.php?halaman=detail_pesan&id=<?php echo $value['id_pesan']; ?>" class="btn btn-sm btn-primary">Detail</a>
                                <a href="index2.php?halaman=hapus_pesan&id=<?php echo $value['id_pesan']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </th>
                        </tr>
                    <?php endforeach ?>
                </tBody>
            </table>
        </div>
    </div>
</body>

</html>