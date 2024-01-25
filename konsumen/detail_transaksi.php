<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            color: black;
        }
    </style>
</head>

<body>
    <div class="shadow p-3 mb-3 bg-white">
        <h5>Halaman Detail Transaksi</h5>
    </div>

    <?php
    $id_penjualan = $_GET['id'];

    $ambil = $koneksi->query("SELECT * FROM penjualan JOIN konsumen
    ON penjualan.id_konsumen=konsumen.id_konsumen
    WHERE penjualan.id_penjualan='$id_penjualan'");
    $detail = $ambil->fetch_assoc();

    $idpenjualan = $detail['id_konsumen'];
    $idkonsumen = $_SESSION['konsumen']['id_konsumen'];

    if ($idpenjualan !== $idkonsumen) {
        echo "<script>alert('session tidak ditemukan');</script>";
        echo "<script>location='index.php?page=pesanan';</script>";
    }


    ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow bg-white">
                <div class="card-header">
                    <strong>Data Konsumen</strong>
                </div>
                <div class="card-body">
                    <label class="col-md-5 col-form-label">Nama :</label>
                    <label class="col-md-10 col-form-label"><?php echo $detail['nama_konsumen']; ?></label>
                    <label class="col-md-5 col-form-label">Telepon :</label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['tlpn_konsumen']; ?></label>
                    <label class="col-md-5 col-form-label">Email :</label>
                    <label class="col-md-10 col-form-label"><?php echo $detail['email_konsumen']; ?></label>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow bg-white">
                <div class="card-header">
                    <strong>Data Pembelian</strong>
                </div>
                <div class="card-body">
                    <label class="col-md-8 col-form-label">No. Penjualan :</label>
                    <label class="col-md-8 col-form-label">
                        <?php echo $detail['id_penjualan']; ?>
                    </label>
                    <label class="col-md-6 col-form-label">Tanggal :</label>
                    <label class="col-md-8 col-form-label">
                        <?php echo date("d F Y", strtotime($detail['tanggal_penjualan'])); ?>
                    </label>
                    <label class="col-md-5 col-form-label">Total :</label>
                    <label class="col-md-8 col-form-label">Rp <?php echo number_format($detail['total_penjualan']); ?></label>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow bg-white">
                <div class="card-header">
                    <strong>Data Pengiriman</strong>
                </div>
                <div class="card-body">
                    <label class="col-md-5 col-form-label">Alamat :</label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['alamat']; ?></label>
                    <label class="col-md-7 col-form-label">Estimasi :</label>
                    <label class="col-md-8 col-form-label"><?php echo $detail['estimasi']; ?></label>
                    <label class="col-md-5 col-form-label">Ongkir :</label>
                    <label class="col-md-10 col-form-label">Rp <?php echo number_format($detail['ongkir']); ?></label>
                </div>
            </div>
        </div>

        <?php
        $penjualanbarang = array();
        $ambil = $koneksi->query("SELECT * FROM penjualan_detail
        WHERE penjualan_detail.id_penjualan='$id_penjualan'");
        while ($pecah = $ambil->fetch_assoc()) {
            $penjualanbarang[] = $pecah;
        }

        ?>
    </div>
    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subberat</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualanbarang as $key => $value) : ?>
                        <tr>
                            <td width="50"><?php echo $key + 1; ?></td>
                            <td><?php echo $value['nama']; ?></td>
                            <td>Rp <?php echo number_format($value['harga']); ?></td>
                            <td><?php echo $value['total']; ?></td>
                            <td><?php echo $value['subberat']; ?> gr</td>
                            <td>Rp <?php echo number_format($value['subharga']); ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="alert alert-primary shadow mt-3">
        <p>
            Silahkan melakukan pembayaran : Rp <?php echo number_format($detail['total_penjualan']); ?><br>
            <strong>BANK BNI: 12345678 AN. Vany Erda Pratama</strong>
        </p>
    </div>
</body>

</html>