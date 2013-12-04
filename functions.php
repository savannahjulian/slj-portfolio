<?php

add_action( 'init', 'slj_init' );

function slj_init ( ) {

	/*
		Spin up Work custom post type
	*/

	register_post_type( 'work',
		array(
			'labels' => array(
				'name' => 'Work',
				'singular_name' => 'Piece'
			),
			'public' => true,
			'has_archive' => true,
			'hierarchical' => true,
			'supports' => array( 'page-attributes', 'title' )
		)
	);

	/*
		Add Main Navigation
	*/

	register_nav_menu( 'primary', 'Primary Menu' );

	/*
		Add Additional Image Sizes
	*/

	add_image_size( 'work-thumb' , 300 , 300 , true );
	add_image_size( 'work-thumb-retina' , 600 , 600 , true );

	add_image_size( 'work' , 1200 , null , false );
	add_image_size( 'work-retina' , 2400 , null , false );
}

function get_projects ( ) {

	if ( $projects = get_transient('projects') ) {

		// clog("Cached Query");

		return $projects;

	} else {

		// clog("Uncached Query");

		$projects = array();

		$params = array(
			'post_type' => 'work',
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC'
		);

		$query = new WP_Query( $params );

		foreach ( $query->posts as $project ) {
			$item = array(
				"post" => $project,
				"fields" => get_fields( $project->ID )
			);

			array_push( $projects , $item );
		}

		// clog($projects);

		set_transient( 'projects' , $projects , 0 );

		return $projects;
	}
}

function update_projects_cache ( ) {
	delete_transient('projects');
	get_projects();
}

add_action( 'save_post' , 'update_projects_cache');

/*
	Miscellaneous
*/

function clog ( $var ) {
	echo '<script>console.log(' . json_encode( $var ) . ');</script>';
}

function pre_dump ( $var ) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function is_pjax ( ) {
    if ( isset( $_SERVER['HTTP_X_PJAX'] ) && strtolower( $_SERVER['HTTP_X_PJAX'] ) == 'true' ) {
        return true;
    }
    return false;
}


/*
	Filters & Hooks
*/

function get_next_project ( $current ) {
	global $wpdb;

	if ( $next = get_transient("project_" . $current->ID . "_next" ) ) {
		return $next;
	} else {
		$next = $wpdb->get_row("SELECT wp_posts.* FROM wp_posts WHERE 1=1 AND wp_posts.post_type = 'work' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') AND wp_posts.menu_order < $current->menu_order ORDER BY wp_posts.menu_order DESC LIMIT 1");

		set_transient("project_" . $current->ID . "_next" , $next , 0 );

		// clog( array( "Next" => $next , "Current" => $current ) );

		return $next;
	}
}

function get_previous_project ( $current ) {
	global $wpdb;

	if ( $prev = get_transient("project_" . $current->ID . "_previous" ) ) {
		return $prev;
	} else {
		$prev = $wpdb->get_row("SELECT wp_posts.* FROM wp_posts WHERE 1=1 AND wp_posts.post_type = 'work' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') AND wp_posts.menu_order > $current->menu_order ORDER BY wp_posts.menu_order ASC LIMIT 1");

		set_transient("project_" . $current->ID . "_previous" , $prev , 0 );

		// clog( array( "Previous" => $prev , "Current" => $current ) );

		return $prev;
	}
}

function scrub_links ( $id ) {
	delete_transient( "project_" . $id . "_next" );
	delete_transient( "project_" . $id . "_previous" );

	get_transient("project_" . $id . "_previous" );
	get_transient("project_" . $id . "_next" );
}

add_action( "save_post" , "scrub_links" );