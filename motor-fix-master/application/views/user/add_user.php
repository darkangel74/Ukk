<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
<form method="post" action="<?php echo site_url('user/do_add') ?>">
	<table>
		<tr>
			<td width="100">Email</td>
			<td width="50">:</td>
			<td width="150"><input type="text" name="email" value="<?php echo set_value('email_user') ?>"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="password" name="password" value="<?php echo set_value('password_user') ?>"></td>
		</tr>
                <input type="hidden" name="permission" value="1"/>
		<tr>
			<td colspan="3"><input type="submit" name="submit"></td>
		</tr>
	</table>
</form>