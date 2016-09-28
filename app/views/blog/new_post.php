<?php
	include APP_DIR . 'views/admin/header.php';
?>

<body>
	<div class="wrapper">
	<?php include ADMIN_DIR . 'admin_toolbar.php'; ?>
	<div class="article_editor">
	<h2><?php echo $title; ?></h2>
		<form action="new/create" method="post">
			<input type="text" name="post_title" id="post_title" class="form_field" placeholder="Enter title here" autocomplete="off" spellcheck="true">
			<textarea name="post_body" id="post_body" class="form_field" rows="15"></textarea>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			<p><input type="submit" value="Publish" class="button button_primary"></p>
		</form>
	</div>
	</div>
<?php
	include APP_DIR . 'views/admin/footer.php';
?>