<?php echo $this->session->flashdata('message'); ?>
<a href="<?php echo site_url('cicilan/nama_cek') ?>"> | Cek Nama</a>
<table border="1" cellpadding="3" cellspacing="3" >
	<tbody>
		<tr>
			<th>No</th>
			<th>Kode Kredit</th>
			<th>Tanggal</th>
			<th>Nama Pelanggan</th>
			<th>Motor</th>
			<th>Warna</th>
			<th>Uang Muka</th>
			<th>Lama Cicilan</th>
			<th>Cicilan Kurang</th>
			<th>Per-Bulan</th>			
			<th>Sisa Bayar</th>			
			<th>Aksi</th>
		</tr>
		<?php
			if(!empty($list))
				{
					foreach($list as $key => $row)
					{
						echo '<tr>';
						echo '<td>'.++$key.'</td>';
						echo '<td>'.$row['kode_kredit'].'</td>';
						echo '<td>'.$row['tanggal_kredit'].'</td>';						
						echo '<td>'.$row['nama'].'</td>';
						echo '<td>'.$row['merek'].'</td>';
						echo '<td>'.$row['warna'].'</td>';
						echo '<td>'.$row['uang_muka'].'</td>';
						echo '<td>'.$row['lama_cicilan'].'x</td>';
                                                $kredit		= $this->general_model->select('v_kredit','kode_kredit = '.$row['kode_kredit']);
                                                if($kredit != FALSE)
                                                    {
                                                        $list	= $kredit->result_array();
                                                        $harga_deal		= $list[0]['harga_deal'];
                                                        $lama_cicilan	= $list[0]['lama_cicilan'];
                                                    }
                                                        $a = $row['sisa']/($harga_deal/$lama_cicilan);
						echo '<td style=color:blue>'.$a.'x</td>';
						echo '<td style=color:red>'.$harga_deal/$lama_cicilan.'</td>';
						echo '<td>'.$row['sisa'].'</td>';
                                                
						echo '<td>';
						if($row['sisa'] == 0)
						{
							echo 'Lunas';
						}
						else
						{
							echo '<a class="edit" href="'.site_url('cicilan/bayar_cicilan/'.$row['kode_kredit']).'">Cicilan </a>';
							echo '<a class="edit" href="'.site_url('cicilan/lunas_cicilan/'.$row['kode_kredit']).'">Lunas</a>';
						}
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