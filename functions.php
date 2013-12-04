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

// Post Link Attributes
/*
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
	return 'ajax="true"';
}
*/

/*

// Work Queries: Show all results

add_action( 'pre_get_posts' , 'extend_work_results' );

function extend_work_results ( $query ) {
	if ( $query->query["post_type"] === "work" ) {
		$query->set( 'posts_per_page' , -1 );
	}
}

// Homepage Query: Show only Work items

add_action( 'pre_get_posts' , 'work_items_only' );

function work_items_only( $query ) {
	if ( is_home() && $query->is_main_query() ) {
		$query->set( 'post_type', 'work' );
	}
}

*/

function get_next_project ( $current ) {
	if ( $next = get_transient("project_" . $current . "_next" ) ) {
		return $next;
	} else {
		// Set a Transient, before returning...
		$wpdb->get_row("SELECT wp_posts.id FROM wp_posts  WHERE 1=1 AND wp_posts.post_type = 'work' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') AND wp_posts.menu_order > $current ORDER BY wp_posts.menu_order DESC")->id;
	}
}

function get_previous_project ( $current ) {
	if ( $prev = get_transient("project_" . $current . "_previous" ) ) {
		return $prev;
	} else {
		// Set a Transient, before returning...
		$wpdb->get_row("SELECT wp_posts.id FROM wp_posts  WHERE 1=1 AND wp_posts.post_type = 'work' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') AND wp_posts.menu_order < $current ORDER BY wp_posts.menu_order DESC")->id;
	}
}