<?php echo $this->session->flashdata('message'); ?>
<form method="post" action="<?php echo site_url('cicilan/do_nama_cek') ?>" class="form_utama">
	<p>Nama : <input type="text" size="40" name="nama"></p>
	<input type="submit" value="submit" class="button">
</form>