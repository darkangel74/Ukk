<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
<a href="<?php echo site_url('motor') ?>"> | Lihat Motor</a>
<form enctype="multipart/form-data" class="form_utama" action="<?php echo site_url('motor/do_update') ?>" method='post'>
	<table>
		<tr>
			<td>Kode Motor</td>
			<td>:</td>
			<td>
				<input type='text' name="kode" disabled="disabled" size='20' value="<?php echo $list[0]['kode_motor'] ?>">
				<input type='hidden' name="kode" size='20' value="<?php echo $list[0]['kode_motor'] ?>">
			</td>
		</tr>
		<tr>
			<td>Merek</td>
			<td>:</td>
			<td><input type='text' name='merek' size='20' value="<?php echo $list[0]['merek'] ?>"></td>
		</tr>
		<tr>
			<td>Warna</td>
			<td>:</td>
			<td><input type='text' name='warna' size='20' value="<?php echo $list[0]['warna'] ?>"></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>:</td>
			<td><input type='text' name='harga' size='20' value="<?php echo $list[0]['harga'] ?>"></td>
		</tr>
		<tr>
			<td>Stok</td>
			<td>:</td>
			<td><input type='text' name='stok' size='20' value="<?php echo $list[0]['stok'] ?>"></td>
		</tr>
                <tr>
			<td>Image</td>
			<td>:</td>
                        <td><input type='file' name='foto' size='20' placeholder="15"></td>
                        <td><?php if(empty ($list[0]['image'])){?><img src="<?php echo base_url();?>assets/motor/default.png" width="100px" height="100px"><?php }else{?><img src="<?php echo base_url();?>assets/motor/<?php echo $list[0]['image']?>" width="100px" height="100px"><?php }?></td>
		</tr>
		<tr>
			<td colspan='3'><input name='submit' id="submit" class="button" type='submit' value='submit'></td>
		</tr>
	</table>			
</form>