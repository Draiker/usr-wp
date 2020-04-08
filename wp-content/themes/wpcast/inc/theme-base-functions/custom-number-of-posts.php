<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 * ======================================================
 * Item pagination amount
 * ------------------------------------------------------
 * Customize number of posts depending on the archive post type
 * ======================================================
 */

if(!function_exists('wpcast_custom_number_of_posts')){
function wpcast_custom_number_of_posts( $query ) {
	$seriesname = 'qtserie';
	if(function_exists('qt_series_custom_series_name')) {
		$seriesname = qt_series_custom_series_name(); // from ttgcore plugin settings
	}
	if($query->is_main_query() && !is_admin()){
		if ( 
			is_archive()
			|| is_category()
			|| is_tag()
			|| $query->is_tax( $seriesname )
		) {
			$query->set( 'posts_per_page','9' );
		}
		return;
	}
}}
add_action( 'pre_get_posts', 'wpcast_custom_number_of_posts', 1, 999 );
