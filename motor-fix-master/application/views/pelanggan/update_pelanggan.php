<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
<a href="<?php echo site_url('pelanggan') ?>"> | Lihat Pelanggan</a>
<form action="<?php echo site_url('pelanggan/do_update') ?>" method="post">
	<table border="0" cellpadding="5" cellspacing="5">
		<tr>
			<td>Kode Pelanggan</td>
			<td>:</td>
			<td>
				<input type='text' name='kode' size='30' disabled="disabled" value="<?php echo $list[0]['kode_customer'] ?>">
				<input type='hidden' name='kode' size='30' value="<?php echo $list[0]['kode_customer'] ?>">
			</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><input type='text' name='nama' size='30' value="<?php echo $list[0]['nama'] ?>"></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><textarea name="alamat"><?php echo $list[0]['alamat'] ?></textarea></td>
		</tr>
		<tr>
			<td>Nomor Telepon</td>
			<td>:</td>
			<td><input type='text' name='telepon' size='30' value="<?php echo $list[0]['telepon'] ?>"></td>
		</tr>
		<tr>
			<td>Nomor Hp</td>
			<td>:</td>
			<td><input type='text' name='hp' size='20' value="<?php echo $list[0]['hp'] ?>"></td>
		</tr>
		<tr>
			<td>Nomor KTP</td>
			<td>:</td>
			<td><input type='text' name='ktp' size='20' value="<?php echo $list[0]['no_ktp'] ?>"></td>
		</tr>
		<tr>
			<td>Kartu Keluarga</td>
			<td>:</td>
			<td><input type='text' name='kk' size='20' value="<?php echo $list[0]['kk'] ?>"></td>
		</tr>
		<tr>
			<td>Gaji</td>
			<td>:</td>
			<td><input type='text' name='gaji' size='20' value="<?php echo $list[0]['slip_gaji'] ?>"></td>
		</tr>		
		<tr>
			<td>Keterangan</td>
			<td>:</td>
			<td><textarea name="keterangan"><?php echo $list[0]['keterangan'] ?></textarea></td>
		</tr>
		<tr>
			<td colspan='3'><input name='submit' type='submit' value='submit'></td>
		</tr>
	</table>
</form>
