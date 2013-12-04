<?php get_header(); ?>

	<section class="blog">
		<div class="container clearfix">
			<div class="column col-8 tablet-full">
				<?php if ( have_posts() ) { ?>

					<?php while ( have_posts() ) { ?>
						<?php the_post(); ?>
						<div class="post in-feed">
							<div class="post-meta clearfix">
								<div class="date">
									<?php the_time('M j, Y'); ?>
								</div>

								<div class="title large">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</div>
							</div>

							<div class="post-body">
								<?php the_content('More&hellip;'); ?>

								<h6>
									<a href="<?php the_permalink(); ?>">MORE</a>
								</h6>
							</div>
						</div>
					<?php } ?>

					<div class="pagination">
						<?php next_posts_link("Older"); ?>
						<?php previous_posts_link("Newer"); ?>
					</div>
				<?php } ?>
			</div>

			<div class="column push-1 col-3">
				<div class="side-bar">
					<h3>recent posts</h3>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>