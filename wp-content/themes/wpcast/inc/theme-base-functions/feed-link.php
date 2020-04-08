<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.3.2
*/

/**
 * ======================================================
 * Feed link
 * ======================================================
 */

if(!function_exists('wpcast_archive_feed_link')){
	function wpcast_archive_feed_link( $term_id = false, $taxonomy = false ) {


		$custom_feed_link = get_theme_mod( 'custom_feed_url' );
		if( $custom_feed_link ){
			return esc_attr( $custom_feed_link );
		}


		if( false === $term_id || false === $taxonomy ){
			if( is_archive() ) {
				global $wp_query;
				$taxonomy = $wp_query->get_queried_object();
				return get_term_feed_link( $taxonomy->term_id, $taxonomy->taxonomy );
			}
			return;
		} else {
			return get_term_feed_link( $term_id, $taxonomy );
		}
	}
}