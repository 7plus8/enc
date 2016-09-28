<?php include ADMIN_DIR . 'admin_toolbar.php'; ?>

<section id="dashboard">
	<div class="wrapper cf">
		<div class="dashbox">
			<div class="widget">
			<div class="header">
				<h3 class="title"><i class="fa fa-eye"></i>At a glance</h3>
			</div>
			<div class="body">
				<ul class="cf">
					<li><i class="dashicons dashicons-admin-post"></i> <a href="#"><?php echo count( $post_count ); ?> Articles</a></li>
					<li><i class="dashicons dashicons-admin-comments"></i> <a href="#"><?php echo count( $comment_count ); ?> Comments</a></li>
					<li><i class="fa fa-file"></i> <a href="#"><?php echo count( $comment_count ); ?> Draft</a></li>
					<li><i class="fa fa-comment"></i> <a href="#"><?php echo count( $comment_count ); ?> Testimonials</a></li>
					<li><i class="dashicons dashicons-admin-page"></i> <a href="#"><?php echo count( $comment_count ); ?> Pages</a></li>
					<li><i class="fa fa-comments"></i> <a href="#"><?php echo count( $comment_count ); ?> Feedback</a></li>
				</ul>
			</div>
		</div>
		
		<div class="widget">
			<div class="header">
				<h3 class="title"><i class="fa fa-globe"></i>Activity</h3>
			</div>
			<div class="body">
				<p>Recently Published</p>
				<ul>
				<?php foreach($post_count as $post): ?>
					<li class="activity-posts"><span><?php echo $post->posted ?></span><a href="#"><?php echo $post->title; ?></a></li>
				<?php endforeach; ?>
				</ul>
			</div>
			
			<div class="header all">
				<p>Comments</p>

			</div>
			<div class="body">
				<?php foreach($comment_count as $comment): ?>
					<div class="admin-comments cf">
						<div class="left"></div>
						<div class="left">
							From <?php echo $comment->name ?> on <a href="#"><?php echo $comment->post_id; ?></a>
							<p><?php echo substr($comment->comment, 0, 100); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	
		</div>
		
		<div class="dashbox">
			<div class="widget">
			<div class="header">
				<h3 class="title"><i class="fa fa-edit"></i>Quick draft</h3>
			</div>
			<div class="body">
				<form action="">
					<input type="text" class="form_field" placeholder="Title" autocomplete="off">
					<textarea name="" id="" cols="30" rows="3" class="form_field" placeholder="What's on your mind"></textarea>
					<input type="submit" class="button button_primary button-small" value="Save draft">
				</form>
			</div>
			</div>
		</div>
		
	</div>
</section>

