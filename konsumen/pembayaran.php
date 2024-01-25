<style>
    body {
        color: black;
    }

    h5 {
        color: black;
    }
</style>
<div class="p-3 mb-3 shadow rounded">
    <h5>Pembayaran</h5>
</div>

<body>
    <?php

    $id_penjualan = $_GET['id'];

    $ambil = $koneksi->query("SELECT * fROM penjualan
    WHERE id_penjualan='$id_penjualan'");
    $pecah = $ambil->fetch_assoc();

    ?>

    <div class="p-3 mb-3 shadow rounded">
        Total Tagihan : <b>Rp <?php echo number_format($pecah['total_penjualan']); ?></b>
    </div>

    <div class="p-3 mb-3 shadow rounded">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama : </label>
                <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Bank : </label>
                <div class="col-sm-9">
                    <select name="bank" class="form-control">
                        <option selected disabled>Pilih Metode Pembayaran</option>
                        <option value="bni">BNI</option>
                        <option value="bri">BRI</option>
                        <option value="bca">BCA</option>
                        <option value="mandiri">MANDIRI</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jumlah : </label>
                <div class="col-sm-9">
                    <input type="text" name="jumlah" class="form-control" value="<?php echo $pecah['total_penjualan']; ?>" readonly>
                </div>
            </div>
            <div class=" form-group row">
                <label class="col-sm-3 col-form-label">Bukti : </label>
                <div class="col-sm-9">
                    <input type="file" name="bukti" class="form-control" required>
                    <small class="text-danger">Foto harus jelas dan max ukuran 2 mb</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button name="kirim" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['kirim'])) {
        $nama = $_POST['nama'];
        $bank = $_POST['bank'];
        $jumlah = $_POST['jumlah'];
        $tanggal = date('Y-m-d');

        $nama_bukti = $_FILES['bukti']['name'];
        $lokasi_bukti = $_FILES['bukti']['tmp_name'];
        $tgl_bukti = date('YmdHis') . $nama_bukti;

        move_uploaded_file($lokasi_bukti, "../assets/foto_bukti/" . $tgl_bukti);

        // menyimpan ke table pembayaran
        $koneksi->query("INSERT INTO pembayaran 
        (id_penjualan,nama,bank,jumlah,tanggal,bukti)
        VALUES ('$id_penjualan','$nama','$bank','$jumlah','$tanggal','$tgl_bukti')");


        // update table penjualan
        $koneksi->query("UPDATE penjualan SET status='sedang diproses'
        WHERE id_penjualan='$id_penjualan'");

        echo "<script>alert('Pembayaran Terkirim');</script>";
        echo "<script>location='index.php?page=pesanan';</script>";
    }


    ?>
</body>