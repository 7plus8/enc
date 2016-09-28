<nav class="admin_nav cf">
		<ul class="left">
			<li><a href="<?php echo $url; ?>"><?php echo $loc; ?></a></li>
			<li class="menu_popup"><a href="#" class=""><i class="fa fa-plus"></i> New</a>
			<ul class="sub_menu">
				<li><a href="<?php base_url() ?>/blog/article/new" class="">Article</a></li>
				<li><a href="#" class="">Page</a></li>
				<li><a href="#" class="">Media</a></li>
			</ul>
			</li>
		</ul>


		<ul class="right">
			<li class="menu_popup"><a href="#"><img src="<?php echo base_url() . "/" . $avatar; ?>" alt=""> <?php echo $user->username; ?></a>
			<ul class="sub_menu">
				<li><a href="<?php base_url() ?>/user/<?php echo $user->username; ?>" class=""><i class="fa fa-user"></i>My profile</a></li>
				<li><a href="<?php base_url() ?>/user/<?php echo $user->username; ?>/update" class=""><i class="fa fa-wrench"></i>User settings</a></li>
				<li><a href="<?php base_url() ?>/user/logout"><i class="fa fa-lock"></i>Logout</a></li>
			</ul>
			</li>
		</ul>
</nav>