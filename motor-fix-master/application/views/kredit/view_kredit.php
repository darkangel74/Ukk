<?php echo $this->session->flashdata('message'); ?>
<?php echo $pagination;?>
<table border="1" cellpadding="3" cellspacing="3">
	<tbody>
		<tr>
			<th>No</th>
			<th>Kode Kredit</th>
			<th>Tanggal Kredit</th>
			<th>Kode Customer</th>
			<th>Kode Motor</th>
			<th>Warna</th>
			<th>uang Muka</th>
			<th>Lama Cicilan</th>
			<th>Sisa</th>
			<th>Keterangan</th>
			<th>Harga Deal</th>
			<th>Action</th>
		</tr>
		<?php
			if(!empty($list))
				{
					foreach($list as $key=>$row)
					{
						echo '<tr>';
						echo '<td>'.++$key.'</td>';
						echo '<td>'.$row['kode_kredit'].'</td>';
						echo '<td>'.$row['tanggal_kredit'].'</td>';
                                                $nama_customer = $this->db->query('select nama from tb_customer where kode_customer = "'.$row['kode_customer'].'"')->row();
						echo '<td>'.$nama_customer->nama.'</td>';
                                                $nama_motor = $this->db->query('select merek from tb_motor where kode_motor = "'.$row['kode_motor'].'"')->row();
						echo '<td>'.$nama_motor->merek.'</td>';
						echo '<td>'.$row['warna'].'</td>';
						echo '<td>'.$row['uang_muka'].'</td>';
						echo '<td>'.$row['lama_cicilan'].'</td>';
						echo '<td>'.$row['sisa'].'</td>';
						echo '<td>'.$row['keterangan'].'</td>';
						echo '<td>'.$row['harga_deal'].'</td>';
						echo '<td><a class="edit" href="'.site_url('kredit/update/'.$row['kode_kredit']).'">Edit</a> ';
						echo '<a class="hapus" onclick="return confirm(&#39;Are you sure to delete this data ?&#39;)" href="'.site_url('kredit/do_delete/'.$row['kode_kredit']).'">Delete</a> ';
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