<h2>Laporan Data Bunga</h2>
<table border="1" class="data-table" cellpadding="3" cellspacing="3">
	<tr>
		<th>No</th>
		<th>Kode Bunga</th>		
		<th>Lama Cicilan</th>
		<th>Bunga</th>
	</tr>
	<?php
		if(!empty($list))
				{
					foreach($list as $key=>$row)
					{
						echo '<tr>';
						echo '<td>'.++$key.'</td>';
						echo '<td>'.$row['kode_bunga'].'</td>';
						echo '<td>'.$row['lama_cicilan'].'</td>';
						echo '<td>'.$row['bunga'].'</td>';
						echo '</tr>';					
					}
				}
				else
				{
					echo '<tr><td colspan="9">Tidak ada data yang ditampilkan</td></tr>';
				}
	?>
</table>