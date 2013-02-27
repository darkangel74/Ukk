<?php echo $this->session->flashdata('message'); ?>
<?php echo $pagination; ?>
<table border="1">
	<tbody>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Alamat</th>
			<th>No Telepon</th>
			<th>No HP</th>
			<th>No KTP</th>
			<th>Kartu Keluarga</th>
			<th>Gaji</th>
			<th>Keterangan</th>
			<th>Aksi</th>
		</tr>
		<?php
			if(!empty($list))
					{
						foreach($list as $key=>$row)
						{
							echo '<tr>';
							echo '<td>'.++$key.'</td>';
							echo '<td>'.$row['nama'].'</td>';
							echo '<td>'.$row['alamat'].'</td>';
							echo '<td>'.$row['telepon'].'</td>';
							echo '<td>'.$row['hp'].'</td>';
							echo '<td>'.$row['no_ktp'].'</td>';
							echo '<td>'.$row['kk'].'</td>';
							echo '<td>'.$row['slip_gaji'].'</td>';
							echo '<td>'.$row['keterangan'].'</td>';
							echo '<td><a class="edit" href="'.site_url('pelanggan/update/'.$row['kode_customer']).'">Edit</a> ';
							echo '</td>';
							echo '</tr>';					
						}
					}
					else
					{
						echo '<tr><td>Tidak ada data yang ditampilkan</td></tr>';
					}
		?>
	<tbody>
</table>