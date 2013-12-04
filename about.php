<?php 
/*
	Template Name: About
*/

get_header(); ?>

	<section class="about-page">

		<div class="container clearfix">

			<?php if ( have_posts() ) {  ?>

				<?php the_post(); ?>

				<?php $fields = get_fields(); ?>

				<div class="column col-5 tablet-full">
					<h3>
						A Bit About Me
					</h3>

					<div class="line">
					</div>

					<p>
						<?php echo $fields["about"]; ?>
					</p>
				</div>

				<div class="column col-4 tablet-half">
					<h3>
						Experience
					</h3>

					<div class="line">
					</div>

					<p>
						<?php echo $fields["experience"]; ?>
					</p>
				</div>

				<div class="column col-3 tablet-half">
					<?php if ( count( $fields["friends"] ) ) { ?>
						<h3>
							Friends
						</h3>

						<div class="line">
						</div>

						<ul>
						<?php foreach ( $fields["friends"] as $friend ) { ?>
							<li>
								<a href="<?php echo $friend["link"]; ?>" target="_blank"><?php echo $friend["name"]; ?></a>
							</li>
						<?php } ?>
						</ul>
					<?php } ?>
				</div>

			<?php } ?>
			
		<div>

	</section>

<?php get_footer(); ?>