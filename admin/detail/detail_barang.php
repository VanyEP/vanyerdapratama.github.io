<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Detail Barang</h5>
    </div>

    <?php
    $id_barang = $_GET['id'];

    $ambil = $koneksi->query("SELECT * FROM barang JOIN kategori
    ON barang.id_kategori=kategori.id_kategori WHERE id_barang='$id_barang'");
    $detailbarang = $ambil->fetch_assoc();

    $ambil = $koneksi->query("SELECT * FROM barang_foto WHERE id_barang='$id_barang'");
    $barangfoto = $ambil->fetch_assoc();

    $barang_foto = array();
    $ambil = $koneksi->query("SELECT * FROM barang_foto WHERE id_barang='$id_barang'");
    while ($tiap = $ambil->fetch_assoc()) {
        $barang_foto[] = $tiap;
    }

    ?>

    <div class="card shadow bg-white">
        <div class="card-header">
            <strong>Data Barang</strong>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Kategori :</label>
                <div class="col-sm-9">
                    <input readonly class="form-control" value="<?php echo $detailbarang['nama_kategori']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Barang :</label>
                <div class="col-sm-9">
                    <input readonly class="form-control" value="<?php echo $detailbarang['nama_barang']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Harga :</label>
                <div class="col-sm-9">
                    <input readonly class="form-control" value="<?php echo $detailbarang['harga_barang']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Berat Barang :</label>
                <div class="col-sm-9">
                    <input readonly class="form-control" value="<?php echo $detailbarang['berat_barang']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Deskripsi :</label>
                <div class="col-sm-9">
                    <textarea readonly class="form-control"><?php echo $detailbarang['deskripsi_barang']; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Stok :</label>
                <div class="col-sm-9">
                    <input readonly class="form-control" value="<?php echo $detailbarang['stok_barang']; ?>">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <a href="index2.php?halaman=edit_barang&idbarang=
                    <?php echo $detailbarang['id_barang']; ?>&idfoto=<?php echo $barangfoto['id_barang_foto']; ?>" class="btn btn-sm btn-primary">Edit Barang</a>
                </div>
                <div class="col-md-1" text-right>
                    <a href="index2.php?halaman=barang" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($barang_foto as $key => $value) : ?>
            <div class="col-4">
                <div class="card mt-3" style="width: 20rem;">
                    <img src="../assets/foto_barang/<?php echo $value['nama_barang_foto']; ?>" class="img-thumbnail">
                </div>
                <div class="card-footer text-center">
                    <a href="index2.php?halaman=hapus_foto&idfoto=<?php echo $value['id_barang_foto']; ?>&idbarang=<?php echo $value['id_barang']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <form method="post" enctype="multipart/form-data">
        <div class="card shadow bg-white mt-3">
            <div class="card-header">
                <strong>Tambah Foto</strong>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3" col-form-label>File Foto :</label>
                    <div class="col-sm-9">
                        <input type="file" name="barang_foto" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-11">
                        <button name="simpan" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                    <div class="col-md-1" text-right>
                        <a href="index2.php?halaman=barang" class="btn btn-sm btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $namafoto = $_FILES['barang_foto']['name'];
        $lokasifoto = $_FILES['barang_foto']['tmp_name'];

        $tgl_foto = date('YmdHis') . $namafoto;

        move_uploaded_file($lokasifoto, "../assets/foto_barang/" . $tgl_foto);

        $koneksi->query("INSERT INTO barang_foto (id_barang,nama_barang_foto)VALUES ('$id_barang','$tgl_foto')");

        echo "<script>alert('Foto Berhasil Disimpan');</script>";
        echo "<script>location='index2.php?halaman=detail_barang&id=$id_barang';</script>";
    }

    ?>

</body>

</html>