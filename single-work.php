<? get_header(); ?>
	<section class="project">
		<div class="container clearfix">

			<? $fields = get_fields( $post->ID ); ?>

			<div class="column col-4 main space tablet-full">
				<h1>
					<? echo $fields["project_name"]; ?>
				</h1>

				<div class="description">

					<h6 class="components">
						<? echo $fields["components"]; ?>
					</h6>

					<h6 class="year">
						<? echo $fields["year"]; ?>
					</h6>

				</div>

				<div class="line">

				</div>

				<div class="lede">
					<? echo $fields["lede"]; ?>
				</div>
			</div>

			<div class="column col-7 tablet-full hero space push-1">
				<img src="<? echo $fields["hero_image"]["sizes"]["work"]; ?>" />
			</div>

			<? if ( $fields["slideshow"] ) { ?>
				<div class="column col-12 space" id="slideshow">
					<div class="slides">
						<? foreach ( $fields["slideshow"] as $slide ) { ?>
							<div class="slide">
								<img src="<? echo $slide["image"]["sizes"]["work"]; ?>" />
							</div>
						<? } ?>
					</div>
					<div class="slides-nav">
						<div class="slide-next">NEXT</div>
						<div class="slide-prev">PREVIOUS</div>
					</div>
				</div>
			<? } ?>

			<? if ( $fields["detail_images"] ) { ?>
				<? foreach ( $fields["detail_images"] as $image ) { ?>

					<div class="column col-12 detail-image space">
						<img src="<? echo $image["image"]["sizes"]["work"]; ?>" />
					</div>

				<? } ?>
			<? } ?>

			<? if ( $fields["additional_images"] ) { ?>
				<div class="additional_images">
					<? foreach ( $fields["additional_images"] as $image ) { ?>

						<div class="column col-4 additional-image space">
							<img src="<? echo $image["image"]["sizes"]["large"]; ?>" />
						</div>
						
					<? } ?>
				</div>
			<? } ?>

			<div class="column col-12 clearfix">
				<div class="work-pagination">

					<?
						//clog( array( "Current" , $post->ID ) );
						$prev = get_previous_project( $post );
						$next = get_next_project( $post );
					?>

					<? if ( $prev ) { ?>
						<a class="project-previous" href="<?= get_permalink( $prev ); ?>">Previous</a>
					<? } ?>

					<? if ( $next ) { ?>
						<a class="project-next" href="<?= get_permalink( $next ); ?>">Next</a>
					<? } ?>
				</div>
			</div>
			
		</div>

	</section>
<? get_footer(); ?>