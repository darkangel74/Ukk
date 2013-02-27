<a href="<?php echo site_url('bunga/add'); ?>"> | Tambah Bunga</a>
<?php echo $this->session->flashdata('message'); ?>
<?php echo $pagination; ?>
<table border="1">
	<tr>
		<th>No</th>
		<th>Lama Cicilan</th>
		<th>Bunga</th>
		<th>Aksi</th>
	</tr>
	<?php
		if(!empty($list))
				{
					foreach($list as $key=>$row)
					{
						echo '<tr>';
						echo '<td>'.++$key.'</td>';
						echo '<td>'.$row['lama_cicilan'].'</td>';
						echo '<td>'.$row['bunga'].'</td>';
						echo '<td><a class="edit" href="'.site_url('bunga/update/'.$row['kode_bunga']).'">Edit</a> ';
						echo '<a class="hapus" onclick="return confirm(&#39;Are you sure to delete this data ?&#39;)" href="'.site_url('bunga/do_delete/'.$row['kode_bunga']).'">Delete</a> ';
						echo '</td>';
						echo '</tr>';					
					}
				}
				else
				{
					echo '<tr><td>Tidak ada data yang ditampilkan</td></tr>';
				}
	?>
</table>