<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
<span style="background-color: #00CC00;"><a href="<?php echo site_url('bunga') ?>"> | Lihat Bunga</a>
<a href="<?php echo site_url('bunga/to_pdf') ?>"> | Cetak Bunga</a></span>
<form action="<?php echo site_url('bunga/do_add') ?>" method='post'>
	<table>
		<tr>
			<td>Lama Cicilan</td>
			<td>:</td>
			<td><input type='text' name='lama_cicilan' size='20' value="<?php echo set_value('lama_cicilan') ?>"></td>
		</tr>
		<tr>
			<td>Bunga</td>
			<td>:</td>
			<td><input type='text' name='bunga' size='20' value="<?php echo set_value('bunga') ?>"></td>
		</tr>
		<tr>
			<td colspan='3'><input name='submit' type='submit' value='submit'></td>
		</tr>
	</table>			
</form>