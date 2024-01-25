<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Edit Kategori Barang</h5>
    </div>

    <?php
    $id_kategori = $_GET['id'];

    $ambil = $koneksi->query("SELECT * FROM kategori WHERE id_kategori='$id_kategori'");
    $edit = $ambil->fetch_assoc();

    ?>


    <form method="post">
        <div class="card shadow bg-white">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Kategori :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" value="<?php echo $edit['nama_kategori']; ?>">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-11">
                        <button name="simpan" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                    <div class="col-md-1" text-right>
                        <a href="index2.php?halaman=kategori" class="btn btn-sm btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];

        $koneksi->query("UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori='$id_kategori'");


        echo "<script>alert('Data Berhasil Diedit');</script>";
        echo "<script>location='index2.php?halaman=kategori';</script>";
    }

    ?>
</body>

</html>