<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Kepuasan Pelanggan</title>
</head>
<body>
 
<div id="container">
	<h3>Laporan Kepuasan Pelanggan</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
	  	<thead>
	  		<tr>
	  			<th class="short">No.</th>
				<th>NO Bus</th>
				<th>Kategori</th>
				<th>Tgl Keberangkatan</th>
				<th>Pemberangkatan</th>
				<th>Tujuan</th>
				<th>Penumpang</th>
				<th>Nilai Kepuasan (dari 100%)</th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  	<?php $no=1;$total=0; ?>
				<?php foreach($data as $row): ?>
				<tr>
					<td style="text-align: center;"><?= $no++; ?></td>
					<td style="text-align: center;"><?= $row['no_pol']; ?></td>
					<td style="text-align: center;"><?= $row['id_kategori']; ?></td>
					<td style="text-align: center;"><?= $row['tgl_keberangkatan']; ?></td>
					<td style="text-align: center;"><?= $row['kota_keberangkatan']; ?></td>
					<td style="text-align: center;"><?= $row['tujuan']; ?></td>
                    <td style="text-align: center;"><?= $row['jumlah_pelanggan']; ?></td>
					<td style="text-align: center;"><?= number_format($row['nilai_kepuasan']); ?></td>
				</tr>
				<?php 
                    $no++;
                ?>
	  		<?php endforeach; ?>
	  	</tbody>
	  </table>
 
</div>
 
</body>
</html>
