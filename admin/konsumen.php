<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Konsumen</h5>
    </div>

    <?php
    $konsumen = array();
    $ambil = $koneksi->query("SELECT * FROM konsumen");
    while ($pecah = $ambil->fetch_assoc()) {
        $konsumen[] = $pecah;
    }
    ?>

    <div class="card shadow bg-white">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($konsumen as $key => $value) : ?>
                        <tr>
                            <td width="50"><?php echo $key + 1; ?></td>
                            <td>
                                <img src="../assets/foto_konsumen/<?php echo $value['foto_konsumen']; ?>" width="100" class="img-thumbnail">
                            </td>
                            <td><?php echo $value['nama_konsumen']; ?></td>
                            <td><?php echo $value['tlpn_konsumen']; ?></td>
                            <td><?php echo $value['email_konsumen']; ?></td>
                            <td class="text-center">
                                <a href="index2.php?halaman=hapus_konsumen&id=<?php echo $value['id_konsumen']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>