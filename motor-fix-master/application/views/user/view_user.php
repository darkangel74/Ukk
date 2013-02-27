<?php echo $this->session->flashdata('message'); ?>
<?php echo $pagination; ?>
<table border="1">
	<tbody>
		<tr>
			<th>No</th>
			<th>Email</th>
			<th>password</th>
			<th>Hak Akses</th>
			<th>Aksi</th>
		</tr>
		<?php
			if(!empty($list))
					{
						foreach($list as $key=>$row)
						{
							echo '<tr>';
							echo '<td>'.++$key.'</td>';
							echo '<td>'.$row['email_user'].'</td>';
							echo '<td>'.$row['password_user'].'</td>';
							echo '<td>'.$row['permission'].'</td>';
							echo '<td><a class="edit" href="'.site_url('user/update/'.$row['id_user']).'">Edit</a> ';
							echo '<a class="hapus" onclick="return confirm(&#39;Are you sure to delete this data ?&#39;)" href="'.site_url('user/do_delete/'.$row['id_user']).'">Delete</a> ';
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