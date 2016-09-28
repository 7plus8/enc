<?php include 'header.php' ?>
<section id="user_profile">
	<div class="wrapper cf">
		<?php include ADMIN_DIR . 'admin_toolbar.php'; ?>
		<?php 
			if(Session::exists('alert'))
			{
				echo '<p>' . Session::flash('alert') . '</p>';
			}

			if(Session::exists('profile'))
			{
				echo '<p>' . Session::flash('profile') . '</p>';
			}
		?>
		<div class="info_bar left">
		<div class="details">
			<div class="user_inf cf">
				<div class="avatar_wrapper left">
					<img src="<?php echo base_url() . "/" . $_avatar; ?>" alt="" class="avatar">
				</div>
				<div class="inf_wrapper left">
					<p class="name"><?php echo $_user->name ?></p>
					<p class="username"><i class="fa fa-user"></i><?php echo $_user->username; ?></p>
				</div>
			</div>
			<table>
			<tr><td class="inf"><i class="fa fa-envelope"></i></td><td><a href="mailto:<?php echo $_user->email ?>"><?php echo $_user->email ?></a></td></tr>
			<tr><td class="inf"><i class="fa fa-phone"></i></td><td class="mono"><?php echo $_user->phone ?></td></tr>
			</table>
		</div>
			<div class="bio_wrap">
				<h2 class="title">Bio</h2>
				<p class="inf bio"><?php echo $_user->bio ?></p>
			</div>
		</div>
		<div class="activity right">
			<div class="header">
				<h2 class="title"><i class="fa fa-globe"></i>Activity</h2>
			</div>
			<div class="content">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A suscipit nam, ut quidem beatae consequuntur expedita maiores dolorem! Exercitationem explicabo officiis natus nisi voluptas deleniti rerum iusto cumque voluptatibus cum!</p>
				<p>Non dolore voluptatem recusandae maxime, a saepe. Voluptatem repudiandae totam in porro optio fugit aut culpa, reprehenderit expedita at esse, eos, odio similique officiis molestias facilis a quam, mollitia vero!</p>
			</div>
		</div>
	</div>
</section>


<?php include 'footer.php'; ?>