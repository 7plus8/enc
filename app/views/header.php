<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <title><?php echo $title?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/app/views/assets/img/logo.png" type="image/png" />
	<link rel="stylesheet" href="/app/views/assets/styles/normalize.css">
    <link rel="stylesheet" href="/app/views/assets/styles/dashicons.css">
    <link rel="stylesheet" href="/app/views/assets/styles/font-awesome.css">
    <link rel="stylesheet" href="/app/views/assets/styles/style.css">
</head>
<body <?php echo body_tag_class() ?>>
<?php @include $admin_bar; ?>
<section id="banner">
	<div class="wrapper">
		<header>
			<p id="logo"><a href="<?php echo base_url(); ?>">Excel<span>Nutritional</span>Cures</a></p>

			<nav>
				<a href="<?php echo base_url(); ?>">Home</a>
				<a href="#">Services</a>
				<a href="<?php echo base_url() . "/blog"; ?>">Blog</a>
				<a href="#" class="button button_secondary button_small">Get in touch</a>
			</nav>

			<div class="content">
				<h1 class="title">Nature's answer to your health</h1>
				<h2 class="sub_title">We are glad to introduce to you Excel Nutritional Cures as a solution in health.</h2>
				<div class="button_wrapper">
					<a href="#" class="button button_outline button_small">Learn more</a>
				</div>

				<img src="/app/views/assets/img/arrows_down.png" alt="See more" class="see_more">
			</div>
		</header>
	</div>
</section>
