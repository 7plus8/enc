<?php

include APP_DIR . 'views/header.php';

if(Session::exists('blog')){
	echo '<p>' . Session::flash('blog') . '</p>';
}

?>
<body>
<section id="articles_wrap">
	<div class="wrapper cf">
		<?php include 'side_nav.php'; ?>
		<div class="_wrap">
		<div class="articles_wrapper">
		<?php foreach ($articles as $article) : ?>
			<div class="_article">
				<?php $lastspace = strrpos($article->text, ' ') ?>
				<?php $slug = str_replace(" ","-", strtolower($article->slug))?>
				<h2 class="title"><?php echo "<a href=\"blog/article/{$slug}\">" . $article->title. "</a>" ?></h2>
				<div class="metadata"><a href="#"><?php echo $article->posted ?></a><span>&bull;</span><?php echo "<a href=\"blog/article/{$slug}#comments_wrapper\"><i class='dashicons dashicons-admin-comments'></i> " . Post_model::comment_count($article->id) . '</a>'; ?></div>
				<div class="text_content"><?php echo substr($article->text, 0, $lastspace) ?>...</div>
				<div class="category"><p><a href="#">Uncategorised</a></p></div>
			</div>
		<?php endforeach ?>
		</div>
			<div class="load_more">
				<a href="#" class="button button_primary">Load more</a>
			</div>	
		</div>
		<?php include 'sidebar.php'; ?>
	</div>
</section>
</body>
<?php
include APP_DIR . 'views/footer.php';