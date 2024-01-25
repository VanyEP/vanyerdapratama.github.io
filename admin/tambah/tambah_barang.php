<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white rounded">
        <h5>Halaman Tambah Barang</h5>
    </div>

    <?php
    $kategori = array();
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while ($pecah = $ambil->fetch_assoc()) {
        $kategori[] = $pecah;
    }

    ?>

    <form method="post" enctype="multipart/form-data">
        <div class="card shadow bg-white">
            <div class="card-body">
                <div class="form-grup row">
                    <label class="col-sm-3 col-form-label">Nama Kategori :</label>
                    <div class="col-sm-9">
                        <select name="id_kategori" class="form-control" required>
                            <option selected disabled>Pilih Nama Kategori</option>
                            <?php foreach ($kategori as $key => $value) : ?>
                                <option value="<?php echo $value['id_kategori']; ?>">
                                    <?php echo $value['nama_kategori']; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-grup row mt-3">
                    <label class="col-sm-3 col-form-label">Nama :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Barang" required>
                    </div>
                </div>
                <div class="form-grup row mt-3">
                    <label class="col-sm-3 col-form-label">Harga :</label>
                    <div class="col-sm-9">
                        <input type="number" name="harga" class="form-control" placeholder="Masukan Harga Barang" required>
                    </div>
                </div>
                <div class="form-grup row mt-3">
                    <label class="col-sm-3 col-form-label">Berat :</label>
                    <div class="col-sm-9">
                        <input type="number" name="berat" class="form-control" placeholder="Masukan Berat Barang" required>
                    </div>
                </div>
                <div class="form-grup row mt-3">
                    <label class="col-sm-3 col-form-label">Foto :</label>
                    <div class="col-sm-9">
                        <div class="input-foto">
                            <input type="file" name="foto[]" class="form-control" required>
                        </div>
                        <span class="btn btn-sm btn-success mt-3 btn-tambah">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                </div>
                <div class="form-grup row mt-3">
                    <label class="col-sm-3 col-form-label">Deskripsi :</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="5" name="deskripsi" placeholder="Masukan Deskripsi Barang" required></textarea>
                    </div>
                </div>
                <div class="form-grup row mt-3">
                    <label class="col-sm-3 col-form-label">Stok :</label>
                    <div class="col-sm-9">
                        <input type="number" name="stok" class="form-control" placeholder="Masukan Stok Barang" required>
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

        $id_kategori = $_POST['id_kategori'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $berat = $_POST['berat'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];

        $nama_foto = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES['foto']['tmp_name'];

        move_uploaded_file($lokasi_foto[0], "../assets/foto_barang/" . $nama_foto[0]);
        $koneksi->query("INSERT INTO barang 
        (id_kategori,
        nama_barang,
        harga_barang,
        berat_barang,
        foto_barang,
        deskripsi_barang,
        stok_barang) VALUES 
        ('$id_kategori',
        '$nama',
        '$harga',
        '$berat',
        '$nama_foto[0]',
        '$deskripsi',
        '$stok')");


        $id_baru = $koneksi->insert_id;

        foreach ($nama_foto as $key => $setiap_nama) {
            $setiap_lokasi = $lokasi_foto[$key];
            move_uploaded_file($setiap_lokasi, "../assets/foto_barang/" . $setiap_nama);

            $koneksi->query("INSERT INTO barang_foto (id_barang, nama_barang_foto)
            VALUES ('$id_baru','$setiap_nama')");
        }

        // echo "<pre>";
        // print_r($_FILES['foto']);
        // echo "</pre>";

        echo "<script>alert('Data Berhasil Disimpan');</script>";
        echo "<script>location='index2.php?halaman=barang';</script>";
    }

    ?>
</body>

</html>