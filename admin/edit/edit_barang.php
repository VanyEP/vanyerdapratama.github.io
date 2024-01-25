<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Edit Barang</h5>
    </div>

    <?php
    $id_barang = $_GET['idbarang'];
    $id_foto = $_GET['idfoto'];

    $kategori = array();
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while ($pecah = $ambil->fetch_assoc()) {
        $kategori[] = $pecah;
    }


    $ambil = $koneksi->query("SELECT * FROM barang_foto JOIN barang 
    ON barang_foto.id_barang=barang.id_barang
    WHERE id_barang_foto='$id_barang'");
    $editfoto = $ambil->fetch_assoc();


    $ambil = $koneksi->query("SELECT * FROM barang JOIN kategori 
    ON barang.id_kategori=kategori.id_kategori
    WHERE id_barang='$id_barang'");
    $edit = $ambil->fetch_assoc();
    ?>


    <form method="post">
        <div class="card shadow bg-white">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Kategori :</label>
                    <div class="col-sm-9">
                        <select name="id_kategori" class="form-control">
                            <option value="<?php echo $edit['id_kategori']; ?>">
                                <?php echo $edit['nama_kategori']; ?>
                            </option>

                            <?php foreach ($kategori as $key => $value) : ?>
                                <option value="<?php echo $value['id_kategori']; ?>">
                                    <?php echo $value['nama_kategori']; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Barang :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" value="<?php echo $edit['nama_barang']; ?>">
                        </input>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Harga Barang :</label>
                    <div class="col-sm-9">
                        <input type="text" name="harga" class="form-control" value="<?php echo $edit['harga_barang']; ?>">
                        </input>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Berat Barang :</label>
                    <div class="col-sm-9">
                        <input type="text" name="berat" class="form-control" value="<?php echo $edit['berat_barang']; ?>">
                        </input>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Foto Barang :</label>
                    <div class="col-sm-9">
                        <img src="../assets/foto_barang/<?php echo $edit['foto_barang']; ?>" width="150">
                        <input type="file" name="foto" class="form-control">
                        </input>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Deskripsi Barang :</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="deskripsi" class="form-control">
                            <?php echo $edit['deskripsi_barang']; ?>
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Stok Barang :</label>
                    <div class="col-sm-9">
                        <input type="text" name="stok" class="form-control" value="<?php echo $edit['stok_barang']; ?>">
                        </input>
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
        $id_kategori = $_POST['id_kategori'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $berat = $_POST['berat'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];

        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];

        // jika foto barang diubah
        if (!empty($lokasifoto)) {
            move_uploaded_file($lokasifoto, "../assets/foto_barang/" . $lokasifoto);

            $koneksi->query("UPDATE barang SET
            id_kategori = '$id_kategori',
            nama_barang = '$nama',
            harga_barang = '$harga',
            berat_barang = '$berat',
            foto_barang = '$namafoto',
            deskripsi_barang = '$deskripsi',
            stok_barang = '$stok'
            WHERE id_barang = '$id_barang'");
        }

        // jika foto barang tidak diubah
        else {
            $koneksi->query("UPDATE barang SET
            id_kategori = '$id_kategori',
            nama_barang = '$nama',
            harga_barang = '$harga',
            berat_barang = '$berat',
            deskripsi_barang = '$deskripsi',
            stok_barang = '$stok'
            WHERE id_barang = '$id_barang'");
        }

        $namabarangfoto = $_FILES['foto']['name'];
        $lokasibarangfoto = $_FILES['foto']['tmp_name'];

        if (!empty($lokasibarangfoto)) {
            move_uploaded_file($lokasibarangfoto, "../assets/foto_barang/" . $namabarangfoto);

            $koneksi->query("UPDATE barang_foto SET
            id_barang = '$id_barang',
            nama_barang_foto = '$namabarangfoto'
            WHERE id_barang_foto = '$id_foto'");
        } else {
            $koneksi->query("UPDATE barang_foto SET
            id_barang = '$id_barang',
            WHERE id_barang_foto = '$id_foto'");
        }

        echo "<script>alert('Data Berhasil Diedit');</script>";
        echo "<script>location='index2.php?halaman=barang';</script>";
    }

    ?>
</body>

</html>