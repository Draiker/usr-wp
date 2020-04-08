<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 * ======================================================
 * Thumbnails
 * ------------------------------------------------------
 * Change default thumbnails sizes 
 * ======================================================
 */
if (!function_exists( 'wpcast_setup_options' )){
	add_action( 'after_switch_theme', 'wpcast_setup_options' );
	function wpcast_setup_options () {
		update_option( 'medium_size_w', 770 );
		update_option( 'medium_size_h', 770 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 1170 );
	}
}