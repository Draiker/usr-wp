<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

/**
 * This teplate displays results information below the title
 * in the archive pages as total results, current page and total 
 * pages for the current archive
 */

// global $wp_query; // the info are available only in thw global query parameter
$max = $wp_query->max_num_pages;
$results = $wp_query->found_posts;

if( is_page() ){
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'suppress_filters' => false,
		'posts_per_page' => 9,
		'paged' => wpcast_get_paged()
	);
	$custom_wp_query = new WP_Query( $args );
	$max = $custom_wp_query->max_num_pages;
	$results = $custom_wp_query->found_posts;
}





switch ($results){
	case 0:
		// Do nothing because in some archives there is an offset and may result "no results" even if there is one
		break;
	case 1:
		esc_html_e( "1 Result", 'wpcast' );
		break;
	default:
		echo esc_html($results).' '; 
		esc_html_e( "Results", 'wpcast' );
}

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
   $paged = 1;
}


if( $max >= $paged ) {
	echo ' / ';
	esc_html_e ( 'Page', 'wpcast' );
	echo ' '.esc_html( $paged ).' ';
	esc_html_e ( 'of', 'wpcast' );
	echo ' '.esc_html( $max );
}


