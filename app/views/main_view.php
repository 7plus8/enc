<?php include('header.php'); ?>

<section id="services" class="cf">
	<div class="wrapper">
		<div class="service">
			<h3>Conditions handled</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus aspernatur dolor esse rerum.</p>
			<a href="" class="button button_outline button_small">Learn more</a>
		</div>
		<div class="service middle">
			<h3>Nutrition advice</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur delectus adipisicing elit.</p>
			<a href="" class="button button_outline button_small">Learn more</a>
		</div>
		<div class="service">
				<h3>Mobile clinic</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, culpa accusamus dolor sit amet.</p>
				<a href="" class="button button_outline button_small">Learn more</a>
			</div>
		</div>
</section>

<section id="products" data-stellar-background-ratio="0.3">
	<div class="bg_overlay" data-stellar-bacground-ratio="1">
		<div class="wrapper">
			<h2 class="title">Our Products</h2>
			<p class="sub_title">Our medication and remedies (herbal) are tested and satisfied by the University of Nairobi pharmacology and pharmacognosy Department and ministry of Culture and Social Services</p>
		</div>
	</div>
</section>

<section id="testimonials">
	<div class="wrapper">
		<div class="testimonials">
			<h2>Testimonials</h2>
				<div class="cf tes">
					<div class="avatar_wrap">
						<img src="/app/views/assets/uploads/73.jpg" alt="" class="avatar">
					</div>
					<div class="text_wrap">
						<div class="text">
							<p>Traffaut DIY keffiyeh, twee messenger bag venno organic master clense marfa gochunjang selve</p>
						</div>
					</div>
				</div>

				<div class="cf tes">
					<div class="avatar_wrap">
						<img src="/app/views/assets/uploads/73_5.jpg" alt="" class="avatar">
					</div>
					<div class="text_wrap">
						<div class="text">
							<p>Traffaut DIY keffiyeh, twee messenger bag venno organic master clense marfa gochunjang selve</p>
						</div>
					</div>
				</div>

				<div class="cf tes">
					<div class="avatar_wrap">
						<img src="/app/views/assets/uploads/73_6.jpg" alt="" class="avatar">
					</div>
					<div class="text_wrap">
						<div class="text">
							<p>Traffaut DIY keffiyeh, twee messenger bag venno organic master clense marfa gochunjang selve</p>
						</div>
					</div>
				</div>
		</div>
	</div>
</section>


<section id="blog">
	<div class="wrapper">
		<div class="carousel">
			<div id="slides" class="cf">
				<ul>
				<?php foreach($articles as $article) : ?>
					<?php $lastspace = strrpos($article->text, ' ') ?>
					<li>
						<div class="item">
							<div class="featured_image">
							<?php
								$img = array(
									'abott.png',
									'20160119_225544.jpg',
									'20160222_173320.jpg',
									'20160409_235203.jpg',
									'20160417_001629.jpg',
									'20160507_235945.jpg'
									);
								$i = array_rand($img);
								?>
									<img src="app/views/assets/uploads/<?php echo $img[$i]; ?>" alt="" class="featured">
							</div>
							<div class="article">
								<p class="title"><a href="/blog/article/<?php echo $article->slug; ?>"><?php echo $article->title; ?></a></p>
								<p class="date_time"><?php echo $article->posted; ?></p>
								<div class="content">
								<?php echo substr($article->text, 0, $lastspace) ?></div>
							</div>
						</div>
					</li>
				<?php endforeach ?>
				</ul>
			</div>

			<div class="buttons">
				<a href="#" id="prev"></a>
				<a href="#" id="next"></a>
			</div>
		</div>
	</div>
</section>


<section id="contact">
	<div class="wrapper">
		<h2 class="title">Get in touch</h2>
		<p class="sub_title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt iusto autem voluptate similique vitae, soluta consequatur voluptatem.</p>
		<a href="#" class="button button_highlight button_large">Contact Us</a>
	</div>
</section>

<?php include('footer.php'); ?>
