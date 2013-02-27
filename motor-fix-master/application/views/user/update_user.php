<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
<a href="<?php echo site_url('user') ?>"> | Lihat User</a>
<form method="post" action="<?php echo site_url('user/do_update') ?>">
	<table>
		<tr>
			<td width="100">Kode User</td>
			<td width="50">:</td>
			<td width="150">
				<input type="text" name="kode" disabled="disabled" value="<?php echo $list[0]['kode_user'] ?>">
				<input type="hidden" name="kode" value="<?php echo $list[0]['kode_user'] ?>">
			</td>
		</tr>
		<tr>
			<td width="100">Email</td>
			<td width="50">:</td>
			<td width="150"><input type="text" name="email" value="<?php echo $list[0]['email_user'] ?>"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="password" name="password" value="<?php echo $list[0]['password_user'] ?>"></td>
		</tr>
		<tr>
			<td>Hak Akses</td>
			<td>:</td>
			<td><?php echo form_dropdown('permission',$permission,$list[0]['permission'],''); ?></td>
		</tr>
		<tr>
			<td colspan="3"><input type="submit" name="submit"></td>
		</tr>
	</table>
</form>