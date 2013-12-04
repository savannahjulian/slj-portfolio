<div class="sidebar">

	<?php $recent = wp_get_recent_posts( array( "numberposts" => 5 ) ); ?>

	<?php if ( count( $recent ) ) { ?>
		<ul>
		<?php foreach ( $recent as $fresh ) { ?>
			<li>
				<a href="<?php echo get_permalink( $fresh["ID"] ); ?>"><?php echo $fresh["post_title"]; ?></a>
			</li>
		<?php } ?>
		</ul>
	<?php } ?>

</div>