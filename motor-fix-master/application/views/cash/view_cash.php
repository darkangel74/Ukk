<?php echo $this->session->flashdata('message'); ?>
<?php echo $pagination;?>
<table border="1" cellpadding="3" cellspacing="3">
	<tbody>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Merek</th>
			<th>Harga</th>
			<th>Warna</th>
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
						echo '<td>'.$row['merek'].'</td>';						
						echo '<td>'.$row['harga_deal'].'</td>';
						echo '<td>'.$row['warna'].'</td>';
						echo '<td>';
						echo '<a class="hapus" onclick="return confirm(&#39;Are you sure to delete this data ?&#39;)" href="'.site_url('cash/do_delete/'.$row['kode_cash']).'">Delete</a> ';
						echo '</td>';
						echo '</tr>';					
					}
				}
				else
				{
					echo '<tr><td>Tidak ada data yang ditampilkan</td></tr>';
				}
		?>
	</tbody>
</table>