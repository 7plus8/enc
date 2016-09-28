<?php include 'header.php'; ?>

<section id="profile" class="cf">
	<div class="wrapper">
	<?php include ADMIN_DIR . 'admin_toolbar.php'; ?>
	<?php 
		if(Session::exists('error'))
		{
			echo '<p>' . Session::flash('error') . '</p>';
		}
		if(Session::exists('success'))
		{
			echo '<p>' . Session::flash('success') . '</p>';
		}
	?>
		<div class="profile_editor">
			<div class="header">
				<h3 class="title"><i class="fa fa-wrench"></i>Account Settings</h3>
			</div>
			<form action="/user/update" method="post">
				<table>
					<tr>
						<td><div class="avatar_wrapper"><img src="<?php echo base_url() . "/" . $avatar; ?>" alt=""></td><td><a href="<?php echo base_url() . '/' . 'user/avatar'; ?>">Change avatar</a></td>
					</tr>
					<tr>
						<td><p>Username</p></td>
						<td><input type="text" name="username" class="form_field" value="<?php echo $user->username; ?>"></td>
					</tr>
					<tr>
						<td><p>Name</p></td>
						<td><input type="text" name="name" class="form_field" value="<?php echo $user->name; ?>"></td>
					</tr>
					<tr>
						<td><p>Email</p></td>
						<td><input type="email" name="email" class="form_field" value="<?php echo $user->email; ?>"></td>
					</tr>
					<tr>
						<td><p>Phone</p></td>
						<td><input type="tel" name="phone" class="form_field" value="<?php echo $user->phone; ?>"></td>
					</tr>
					<tr>
						<td><p>Bio</p></td>
						<td>
							<textarea name="bio" class="form_field" rows="4"><?php echo $user->bio; ?></textarea>
						</td>
					</tr>
				
				<input type="hidden" name="token1" value="<?php echo Token::generate(); ?>">
				<tr><td></td>
				<td><input type="submit" value="Save Changes" class="button_primary"></td>
				</tr>
				<tr>
					<td></td>
					<td><a href="#" id="change_pass_btn">Change your password</a></td>
				</tr>
			</table>
		</form>
	</div>

	<div class="change_password">
	<div class="header cf">
		<span class="left"><h3 class="title"><i class="fa fa-key"></i>Change password</h3></span>
		<span class="right"><a href="#" id="close"><i class="fa fa-close" title="Close"></i></a></span>
	</div>
		<form action="/user/change_pass" method="POST">
			<table>
				<tr>
					<td>Old password</td>
					<td><input type="password" name="password" class="form_field"></td>
				</tr>
				<tr>
					<td>New password</td>
					<td><input type="password" name="password_new" class="form_field"></td>
				</tr>
				<tr>
					<td>Confirm password</td>
					<td><input type="password" name="password_new_again" class="form_field"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" class="button button_primary" value="Change password">
				</td>
				</tr>
			</table>
		</form>
    </div>
	</div>
</section>
<div class="overlay" id="overlay_pass"></div>

<?php include 'footer.php'; ?>