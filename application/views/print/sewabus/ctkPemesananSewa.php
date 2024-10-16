<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Penyewaan Bus</title>
</head>
<body>
 
<div id="container">
    <h3>Laporan Penyewaan Bus</h3>
    <p>Periode : <?= $period_start." Sampai ".$period_end; ?></p>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
        <thead>
            <tr>
                <th class="short">No. </th>
                <th class="normal"> ID Penyewaan </th>
                <th class="normal"> ID Ketersediaan Bus </th>
                <th class="normal"> Tujuan </th>
                <th class="normal"> Tgl Keberangkatan </th>
                <th class="normal"> Tgl Pengembalian </th>
                <th class="normal"> Pelanggan </th>
                <th class="normal"> Tgl Pembelian </th>
                <th class="normal"> Jenis Pembelian </th>
                <th class="normal"> Harga Sewa / Hari </th>
                <th class="normal"> Jumlah Bus</th>
                <th class="normal"> Total </th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1;$total=0; ?>
            <?php foreach($data as $row): ?>
            <tr>
                <td style="text-align: center;"><?= $no++; ?></td>
                <td style="text-align: center;"><?= $row['id_sewa_bus']; ?></td>
                <td style="text-align: center;"><?= $row['id_ketersediaan_bus']; ?></td>
                <td style="text-align: center;"><?= $row['tujuan']; ?></td>
                <td style="text-align: center;"><?= $row['tgl_keberangkatan']; ?></td>
                <td style="text-align: center;"><?= $row['tgl_pengembalian']; ?></td>
                <td style="text-align: center;"><?= $row['nm_pelanggan']; ?></td>
                <td style="text-align: center;"><?= $row['tgl_pembelian']; ?></td>
                <td style="text-align: center;"><?= $row['jenis_penyewaan']; ?></td>
                <td style="text-align: center;"><?= number_format($row['harga'],0,',','.'); ?></td>
                <td style="text-align: center;"><?= $row['jumlah_pembelian']; ?></td>
                <td style="text-align: center;"><?= number_format($row['nominal'],0,',','.'); ?></td>
            </tr>
            <?php 
                $no++;
                $total = $total+$row['nominal'];
            ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="11" style="text-align:center;"><b>Total Bayar</b></td>
                <td style="text-align:center;"><?= number_format($total,0,',','.'); ?></td>
            </tr>
        </tfoot>
    </table>

    <div style="width:100%">
        <table border=0 style="margin-top:30px;margin-left:19cm;">
            <tr>
                <td style="text-align:center">Bendahara</td>
                <td></td>
                <td style="text-align:center">Direktur</td>
            </tr>
            <tr>
                <td style="height:70px;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:center">(....................................)</td>
                <td></td>
                <td style="text-align:center">(....................................)</td>
            </tr>
        </table>
    </div>
 
</div>
 
</body>
</html>