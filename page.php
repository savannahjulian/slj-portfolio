<? get_header(); ?>

<? if ( have_posts() ) { ?>
	<? the_post(); ?>

	<h1><? the_title(); ?></h1>
	<div class="page-content">
		<? the_content(); ?>
	</div>

<? } ?>

<? get_footer(); ?>