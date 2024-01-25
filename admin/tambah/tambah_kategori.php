<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white rounded">
        <h5>Halaman Tambah Kategori Barang</h5>
    </div>

    <form method="post">
        <div class="card shadow bg-white">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Kategori</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Kategori" required>
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

        $koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$nama')");

        echo "<script>alert('Data Berhasil Disimpan');</script>";
        echo "<script>location='index2.php?halaman=kategori';</script>";
    }

    ?>
</body>

</html>