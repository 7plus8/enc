<?php include('header.php'); ?>

<section id="register">
	<div class="wrapper">
		<div class="frm_wrapper">
		<div class="header">
			<h2 class="title">Register</h2>
		</div>
			<form action="register/create" method="post">

				<label for="name" class="required">Name</label>
				<input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name" class="form_field" autocomplete="off">

				<label for="username" class="required">Username</label>
				<input type="text" name="username" id="username" class="form_field" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">

				<label for="email" class="required">Email</label>
				<input type="email" name="email" id="email" class="form_field" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off">

				<label for="password" class="required">Password</label>
				<input type="password" name="password" id="password" class="form_field">

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
				<input type="submit" value="Create account" class="button button_primary" />
			</form>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>