<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/


/**
 * ======================================================
 * Modify series archives to skip one post and fix offset
 * to display latest post of the serie with a custom fashion
 * https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
 * ======================================================
 */
if(!function_exists( 'wpcast_series_query_offset' )) {
	// add_action('pre_get_posts', 'wpcast_series_query_offset', 1 );
	function wpcast_series_query_offset(&$query) {
		
		

		$seriesname = 'qtserie';
		if(function_exists('qt_series_custom_series_name')) {
			$seriesname = qt_series_custom_series_name(); // from ttgcore plugin settings
		}

		//Before anything else, make sure this is the right query...
		if(!$query->is_main_query() || is_admin() || !$query->is_tax( $seriesname )){
			return;
		}

		$offset = 1;
		$ppp = 9; //get_option('posts_per_page');
		if ( $query->is_paged ) {
			$page_offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );
			$query->set('offset', $page_offset );
		}
		else {
			$query->set('offset',$offset);
		}
	}
}
if(!function_exists( 'wpcast_series_adjust_offset_pagination' )) {
	// add_filter('found_posts', 'wpcast_series_adjust_offset_pagination', 1, 2 );
	function wpcast_series_adjust_offset_pagination($found_posts, $query) {
		
		
		$seriesname = 'qtserie';
		if(function_exists('qt_series_custom_series_name')) {
			$seriesname = qt_series_custom_series_name(); // from ttgcore plugin settings
		}

		if(!$query->is_main_query() || is_admin() || !$query->is_tax( $seriesname )){
			return;
		}
		
		$offset = 1;
		return $found_posts - $offset;
	}
}
