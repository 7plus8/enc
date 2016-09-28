<?php include APP_DIR . 'views/header.php'; ?>
<?php 
	if(Session::exists('comment'))
	{
		echo '<p>' . Session::flash('comment') . '</p>';
	}
?>
<body>
<section id="articles_wrap">
	<div class="wrapper cf">
		<?php include 'side_nav.php'; ?>
		<div class="articles_wrapper cf">
		<div class="meta">
			<div id="meta" class="user_metadata">
				<div class="avatar_wrapper">
					<img src="<?php echo base_url() . "/" . $_avatar; ?>" alt="" class="avatar">
				</div>
				<p class="name"><?php echo $_user->name; ?></p>
			</div>
		</div>
			<div class="article_wrapper">
				<div class="article">
				<h2 class="title"><?php echo $_article->title;  ?></h2>
				<p><?php echo $_article->text; ?></p>
				</div>
				<div class="comments_wrapper">
					<p class="title"><i class='dashicons dashicons-admin-comments'></i> <?php echo Post_model::comment_count($_article->id) ?></p>
					<?php foreach ($comments as $comment):?>
						<?php if($comment->post_id === $_article->id) {?>
						<div class="comment_wrapper">
							<div class="comment-header cf">
								<div class="avatar_wrapper">
									<img src="/app/views/assets/uploads/73.jpg" alt="" class="avatar">
								</div>
								<div class="header-content">
									<h3 class="name"><?php echo $comment->name; ?></h3>
									<p>
									<?php echo $comment->posted; ?>
									</p>
								</div>
							</div>
							<div class="comment">
								<?php echo $comment->comment; ?>
							</div>
							<!--<div class="reply"><a href="#" id="reply" class="button_primary">Reply</a></div>
							<div class="reply-form">
								<form action="comment/reply">
									<label for="reply" class="required">Comment</label>
									<textarea name="reply" id="" cols="30" rows="3" class="form_field" required></textarea>
									<label for="name" class="required">Name</label>
									<input type="text" name class="form_field" required>
									<label for="email" class="required">Email</label>
									<input type="email" name="email" class="form_field" required>
									<input type="hidden" value="<?php //echo $comment->id ?>">
									<input type="hidden" value="<?php //echo Token::generate() ?>">
									<input type="submit" class="button button_primary" value="Send a reply">
								</form>
							</div>-->
						</div>

					<?php } endforeach?>
				</div>
				<div class="form_wrapper">
					<form action="comment/add" method="POST">
					<label for="comment" class="required">Comment</label>
						<textarea name="comment" id="comment" cols="30" rows="7" class="form_field" required="required"></textarea>
						<label for="username" class="required">Name</label>
						<input type="text" class="form_field" name="username" id="username" required="required">
						<label for="email" class="required">Email</label>
						<input type="email" class="form_field" name="email" id="email" required="required">
						<input type="hidden" name="post_id" value="<?php echo $_article->id; ?>">
						<input type="hidden" value="<?php echo Token::generate()?>" name='token'>
						<input type="submit" class="button button_primary" value="Add a comment">
					</form>
				</div>
			</div>
		</div>
		<?php include 'sidebar.php' ?>
	</div>
</section>

<?php include APP_DIR . 'views/footer.php'; ?>