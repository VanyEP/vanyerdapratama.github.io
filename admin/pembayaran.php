<div class="shadow p-3 mb-3 bg-white">
    <h5>Halaman Pembayaran</h5>
</div>

<?php

$id_penjualan = $_GET['id'];

$pembayaran = array();
$ambil = $koneksi->query("SELECT * FROM pembayaran
WHERE id_penjualan='$id_penjualan'");
$pecah = $ambil->fetch_assoc();


?>

<div class="card shadow bg-white">
    <div class="card-body row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table">
                    <?php foreach ($pembayaran as $key => $value) : ?>
                        <tr>
                            <th>Nama</th>
                            <td><?php echo $pembayaran['nama']; ?></td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td><?php echo $pecah['bank']; ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td><?php echo $pecah['jumlah']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?php echo $pecah['tanggal']; ?></td>
                        </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <img src="../assets/foto_bukti/<?php echo $pecah['bukti']; ?>" width="200" class="img-thumbnail img-responsive">
        </div>
    <?php endforeach ?>
    </div>
    <div class="card-footer">
        <form method="post">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">No. Resi Pengiriman : </label>
                <div class="col-sm-9">
                    <input type="text" name="resi" class="form-control" placeholder="No Resi Pengiriman">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status : </label>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option selected disabled>Pilih Status</option>
                        <option value="pembayaran dikonfirmasi">Pembayaran Dikonfirmasi</option>
                        <option value="barang dikirim">Barang Dikirim</option>
                        <option value="pengiriman dibatalkan">Pengiriman Dibatalkan</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button name="proses" class="btn btn-primary">Proses</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

if (isset($_POST['proses'])) {
    $nama = $_POST['nama'];
    $bank = $_POST['bank'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $resi = $_POST['resi'];
    $status = $_POST['status'];

    $koneksi->query("UPDATE penjualan SET resi_pengiriman='$resi',
    status='$status'
    WHERE id_penjualan='$id_penjualan'");

    echo "<script>alert('Data penjualan berhasil diupdate');</script>";
    echo "<script>location='index2.php?halaman=transaksi';</script>";
}

?>