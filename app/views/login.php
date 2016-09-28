<?php include 'header.php'; ?>

<section id="login">
<div class="wrapper">

<?php
	if(Session::exists('logout'))
		echo '<p>' . Session::flash('logout') . '</p>';
	if(Session::exists('user_reg_success'))
		echo '<p>' . Session::flash('user_reg_success') . '</p>';
?>

<div class="frm_wrapper">
	<div class="header">
		<h2 class="title">Login</h2>
	</div>
<form action="login_attempt" method="post">

		<label for="username">Username</label>
		<input type="text" name="username" id="username" class="form_field" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">

		<label for="password">Password</label>
		<input type="password" name="password" id="password" class="form_field" autocomplete="off">

		<p>
		<label for="remember">
			<input type="checkbox" name="remember" id="remember" > Remember me
		</label>
		</p>


	<input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>" />
	<input type="submit" value="Log In" class="button button_primary" />
</form>
</div>
<p style="text-align: center;">
	<a href="<?php echo base_url()?>" class="link">Home</a>
</p>

</div>
</section>

<?php include 'footer.php'; ?>
