			<?php
			if ($this->session->userdata('usertype')=='') {
			?>
			<span>
				<?php $message = $this->session->flashdata('message'); 
				echo $message == ''?'':$message; 
				?>
			</span>
				<form class="form-3" method="post" action="<?php echo site_url('user/do_login') ?>">
				    
					<p class="clearfix">
				        <label for="login">Username</label>
				        <input type="text" name="email" id="login" placeholder="Username">
				    </p>
				    <p class="clearfix">
				        <label for="password">Password</label>
				        <input type="password" name="password" id="password" placeholder="Password"> 
				    </p>
				    <p class="clearfix">
				        <input type="checkbox" name="remember" id="remember">
				        <label for="remember">Remember me</label>
				    </p>
				    <p class="clearfix">
				        <input type="submit" name="submit" value="Sign in">
				    </p>       
				</form>

			<?php
			}else {
			?>
			<?php
				echo "anda telah login";
			}
			?>