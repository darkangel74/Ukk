<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
<a href="<?php echo site_url('bunga') ?>"> | Lihat Bunga</a>
<form action="<?php echo site_url('bunga/do_update') ?>" method='post'>
	<table>
		<tr>
			<td>Kode Bunga</td>
			<td>:</td>
			<td>
				<input type='text' name='kode' disabled="disabled" size='20' value="<?php echo $list[0]['kode_bunga'] ?>">
				<input type='hidden' name='kode' size='20' value="<?php echo $list[0]['kode_bunga'] ?>">
			</td>
		</tr>
		<tr>
			<td>Lama Cicilan</td>
			<td>:</td>
			<td><input type='text' name='lama_cicilan' size='20' value="<?php echo $list[0]['lama_cicilan'] ?>"></td>
		</tr>
		<tr>
			<td>Bunga</td>
			<td>:</td>
			<td><input type='text' name='bunga' size='20' value="<?php echo $list[0]['bunga'] ?>"></td>
		</tr>
		<tr>
			<td colspan='3'><input name='submit' type='submit' value='submit'></td>
		</tr>
	</table>			
</form>