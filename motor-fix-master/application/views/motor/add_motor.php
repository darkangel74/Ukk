<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
<span style="background-color: yellowgreen"><a href="<?php echo site_url('motor') ?>"> | Lihat Motor</a>
<a href="<?php echo site_url('motor/to_pdf') ?>"> | Cetak Motor</a></span>
<form enctype="multipart/form-data" action="<?php echo site_url('motor/do_add') ?>" method='post'>
	<table>
		<tr>
			<td>Merek</td>
			<td>:</td>
                        <td><input type='text' name='merek' size='20' value="<?php echo set_value('merek') ?>" placeholder="yamaha"></td>
		</tr>
		<tr>
			<td>Warna</td>
			<td>:</td>
                        <td><input type='text' name='warna' size='20' value="<?php echo set_value('warna') ?>"placeholder="hitam,kuning,biru,merah"></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>:</td>
                        <td><input type='text' name='harga' size='20' value="<?php echo set_value('harga') ?>"placeholder="15000000"></td>
		</tr>
		<tr>
			<td>Stok</td>
			<td>:</td>
                        <td><input type='text' name='jumlah' size='20' value="<?php echo set_value('harga') ?>"placeholder="15"></td>
		</tr>
		<tr>
			<td>Image</td>
			<td>:</td>
                        <td><input type='file' name='foto' size='20' placeholder="15"></td>
                        <td><img src="<?php echo base_url();?>assets/motor/default.png" width="100px" height="100px"></td>
		</tr>
		<tr>
			<td colspan='3'><input name='submit' type='submit' value='submit'></td>
		</tr>
	</table>			
</form>