<!DOCTYPE html>
<html>
	<head>
		<!-- <title><?php wp_title( ' / ', true, 'right' ); ?></title> -->
		<title><?php bloginfo('title'); ?></title>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/stylesheets/slj.css" />

		<link rel="icon" href="images/favicon.png" type="image/png">

		<?php // pre_dump($_SERVER); ?>

		<?php wp_head(); ?>
	</head>

	<body id="pjax">
		<div class="content">
			<div id="main" <?php body_class(); ?>>
				<section class="header">
					<div class="container clearfix">
						<!--<img src="<?= get_field('logo','option')["sizes"]["medium"]; ?>" alt="<?php bloginfo('title'); ?>" />-->

						<div class="column col-12">
							<div class="animation">

								<div class="cat">
								</div>

								<div class="cat moving">
								</div>

							</div>
						</div>

						<div class="column col-9">
							<p class="large">
								<?php echo get_field('introduction','option'); ?>
							</p>
						</div>
						
						<div class="column col-12">
							<div class="navigation">
								<?php wp_nav_menu( array( 'location' => 'primary' ) ); ?>
							</div>
						</div>
					</div>
				</section>