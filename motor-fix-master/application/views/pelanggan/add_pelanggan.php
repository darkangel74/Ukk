<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
</span>
<form action="<?php echo site_url('pelanggan/do_add') ?>" method="post">
	<table border="0" cellpadding="5" cellspacing="5">
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><input type='text' name='nama' size='30' value="<?php echo set_value('nama') ?>"></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><textarea name="alamat"><?php echo set_value('alamat') ?></textarea></td>
		</tr>
		<tr>
			<td>Nomor Telepon</td>
			<td>:</td>
			<td><input type='text' name='telepon' size='30' value="<?php echo set_value('telepon') ?>"></td>
		</tr>
		<tr>
			<td>Nomor Hp</td>
			<td>:</td>
			<td><input type='text' name='hp' size='20' value="<?php echo set_value('hp') ?>"></td>
		</tr>
		<tr>
			<td>Nomor KTP</td>
			<td>:</td>
			<td><input type='text' name='ktp' size='20' value="<?php echo set_value('no_ktp') ?>"></td>
		</tr>
		<tr>
			<td>Kartu Keluarga</td>
			<td>:</td>
			<td><input type='text' name='kk' size='20' value="<?php echo set_value('kk') ?>"></td>
		</tr>
		<tr>
			<td>Gaji</td>
			<td>:</td>
			<td><input type='text' name='gaji' size='20' value="<?php echo set_value('slip_gaji') ?>"></td>
		</tr>		
		<tr>
			<td>Keterangan</td>
			<td>:</td>
			<td><textarea name="keterangan"><?php echo set_value('keterangan') ?></textarea></td>
		</tr>
		<tr>
			<td colspan='3'><input name='submit' type='submit' value='submit'></td>
		</tr>
	</table>
</form>
