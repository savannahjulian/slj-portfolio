<?php
	/*
		Template Name: Work Landing Page
		Description: List of all work posts
	*/

	get_header();

	$projects = get_projects();

?>

<section class="work-feed">
	<div class="container clearfix"> 
		<?php foreach ( $projects as $project ) { ?>
			<? // $fields = get_fields( $project->ID ); ?>
			<?php // clog($project); ?>
			<div class="column col-3 tablet-half">
				<div class="work-item">
					<a href="<?= get_permalink( $project["post"]->ID ); ?>" class="work-tile">
						<div class="project-thumbnail">
							<?php // clog($fields["thumbnail"]); ?>
							<img src="<?= $project["fields"]["thumbnail"]["sizes"]["work-thumb-retina"]; ?>" />
						</div>
						<div class="project-name">
							<?php echo $project["fields"]["project_name"]; ?>
						</div>
					</a>
				</div>
			</div>
		<?php } ?>
	</div>
</section>

<?php get_footer(); ?>
