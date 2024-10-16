<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cetak tiket</title>
</head>
<body>

<div id="container">
	<h5 style="text-align:center;">Tiket<br>
  PO. Kalingga Jaya</h5>
    <table border="0" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
	  	<tbody>

				<?php foreach($data as $row): ?>
				<tr>
					<td colspan="3" style="text-align:center;">
            <!-- <img style="width: 100px;" src="<?= base_url('assets/images/qrcode/').$row['qrcode'];?>"> -->
            <barcode code="<?= $row['id_penjualan_tiket']; ?>" type="C39" size="0.5" height="2.0" />
          </td>
				</tr>
        <tr>
          <td>Nomor Tiket</td>
          <td>:</td>
          <td><?= $row['id_penjualan_tiket']; ?></td>
        </tr>
        <tr>
          <td>Nama Pelanggan</td>
          <td>:</td>
          <td><?= $row['nm_pelanggan']; ?></td>
        </tr>
        <tr>
          <td>Tgl Keberangkatan</td>
          <td>:</td>
          <td><?= $row['tgl_keberangkatan']; ?></td>
        </tr>
        <tr>
          <td>Jumlah Pembelian</td>
          <td>:</td>
          <td><?= $row['jumlah_pembelian']; ?></td>
        </tr>
        <tr>
          <td>Tgl Bayar</td>
          <td>:</td>
          <td><?= $row['tgl_bayar']; ?></td>
        </tr>
        <tr>
          <td>Status</td>
          <td>:</td>
          <td><?= $row['status_validasi']; ?></td>
        </tr>
        <tr>
          <td>Nominal</td>
          <td>:</td>
          <td>Rp. <?= number_format($row['nominal'],0,',','.'); ?>,-</td>
        </tr>

	  		<?php endforeach; ?>
	  	</tbody>

	  </table>

    <p style="text-align:center;font-size:10px;">Terima kasih telah mempercayai Armada kami,<br>Semoga Selamat Sampai Tujuan</p>
</div>
 
</body>
</html>
