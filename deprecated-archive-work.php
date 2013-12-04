<?php get_header(); ?>
Yo dog!
<?php if ( have_posts() ) { ?>

	<?php while ( have_posts() ) { ?>

		<?php the_post(); ?>

		<?php $fields = get_fields(); ?>

		<div class="work-item">
			<a href="<?php echo get_permalink(); ?>">
				<h3 class="project-name">
					<?php echo $fields["project_name"]; ?>
				</h3>
				<div class="project-thumbnail">
					<?php // clog($fields["thumbnail"]); ?>
					<img src="<?php echo $fields["thumbnail"]["sizes"]["work-thumb"]; ?>" />
				</div>
			</a>
		</div>
	<?php } ?>

<?php } ?>

<?php get_footer(); ?>