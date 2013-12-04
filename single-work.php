<? get_header(); ?>
	<section class="project">
		<div class="container clearfix">

			<? $fields = get_fields( $post->ID ); ?>

			<div class="column col-4 main space tablet-half">
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

			<div class="column col-1">
				&nbsp;
			</div>

			<div class="column col-7 tablet-half hero space">
				<img src="<? echo $fields["hero_image"]["sizes"]["work"]; ?>" />
			</div>

			<? if ( count($fields["slideshow"]) ) { ?>
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

			<? if ( count( $fields["detail_images"] ) ) { ?>
				<? foreach ( $fields["detail_images"] as $image ) { ?>

					<div class="column col-12 detail-image space">
						<img src="<? echo $image["image"]["sizes"]["work"]; ?>" />
					</div>

				<? } ?>
			<? } ?>

			<? if ( count( $fields["additional_images"] ) ) { ?>
				<div class="additional_images">
					<? foreach ( $fields["additional_images"] as $image ) { ?>

						<div class="column col-4 additional-image space">
							<img src="<? echo $image["image"]["sizes"]["large"]; ?>" />
						</div>
						
					<? } ?>
				</div>
			<? } ?>

			<div class="column col-12 work-pagination clearfix">
				<?
					$prev = get_next_post();
					$next = get_previous_post();
				?>
				<? if ( $prev ) { ?>
					<a class="project-previous" href="<?= get_permalink( $prev->ID ); ?>"><?= $prev->post_title ?></a>
				<? } ?>

				<? if ( $next ) { ?>
					<a class="project-next" href="<?= get_permalink($next->ID); ?>"><?= $next->post_title ?></a>
				<? } ?>
			</div>
			
		</div>

	</section>
<? get_footer(); ?>