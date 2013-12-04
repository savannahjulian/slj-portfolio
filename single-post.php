<?php get_header(); ?>

	<section class="entry">
		<div class="container clearfix">

			<div class="blog-post">

				<div class="column col-8">
					<?php if ( have_posts() ) { ?>
						<?php the_post(); ?>
						<div class="post single">
							<p class="large">
								<?php the_title(); ?>
							</p>
							<div class="post-body">
								<?php the_content(); ?>
							</div>
						</div>
					<?php } ?>
				</div>

				<div class="column push-1 col-3">
					<h3>recent posts</h3>
					<?php get_sidebar(); ?>
				</div>

			</div>

		</div>

	</section>

<?php get_footer(); ?>