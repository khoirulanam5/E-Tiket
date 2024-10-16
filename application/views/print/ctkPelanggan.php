<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Data Pelanggan</title>
</head>
<body>
 
<div id="container">
	<h3>Laporan Data Pelanggan</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
		<thead>
			<tr>
				<th class="short">No.</th>
				<th class="normal">ID Pelanggan</th>
				<th class="normal">Nama Pelanggan</th>
				<th class="normal">No. Telp</th>
				<th class="normal">Alamat</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; $total=0; ?>
			<?php foreach($data as $row): ?>
			<tr>
				<td style="text-align: center;"><?= $no++; ?></td>
				<td style="text-align: center;"><?= $row['id_pelanggan']; ?></td>
				<td style="text-align: center;"><?= $row['nm_pelanggan']; ?></td>
				<td style="text-align: center;"><?= $row['no_pelanggan']; ?></td>
				<td style="text-align: center;"><?= $row['alamat_pelanggan']; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
</body>
</html>
