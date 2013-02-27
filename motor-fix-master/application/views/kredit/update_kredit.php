<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
<a href="<?php echo site_url('kredit') ?>"> | Lihat Pembelian Kredit</a>
<form class="form_utama" action="<?php echo site_url('kredit/do_update') ?>" method='post'>
	<table>
		<tr>
			<td>Kode Kredit</td>
			<td>:</td>
			<td>
				<input type='text' name="kode" disabled="disabled" size='20' value="<?php echo $list[0]['kode_kredit'] ?>">
				<input type='hidden' name="kode" size='20' value="<?php echo $list[0]['kode_kredit'] ?>">
			</td>
		</tr>
		<tr>
			<td>Kode Konsumen</td>
			<td>:</td>
			<td><input type='text' name='kode_customer' size='20' value="<?php echo $list[0]['kode_customer'] ?>"></td>
		</tr>
		<tr>
			<td>Kode Motor</td>
			<td>:</td>
			<td><input type='text' name='kode_motor' size='20' value="<?php echo $list[0]['kode_motor'] ?>"></td>
		</tr>
		<tr>
			<td>Warna</td>
			<td>:</td>
			<td><input type='text' name='warna' size='20' value="<?php echo $list[0]['warna'] ?>"></td>
		</tr>
		<tr>
			<td>Uang Muka</td>
			<td>:</td>
			<td><input type='text' name='uang_muka' size='20' value="<?php echo $list[0]['uang_muka'] ?>"></td>
		</tr>
		<tr>
			<td>Lama Cicilan</td>
			<td>:</td>
			<td><input type='text' name='lama_cicilan' size='20' value="<?php echo $list[0]['lama_cicilan'] ?>"></td>
		</tr>
		<tr>
			<td colspan='3'><input name='submit' id="submit" class="button" type='submit' value='submit'></td>
		</tr>
	</table>			
</form>