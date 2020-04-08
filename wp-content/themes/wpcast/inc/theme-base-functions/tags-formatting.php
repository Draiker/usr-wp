<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/


/* Tags formatting
=============================================*/
if ( ! function_exists( 'wpcast_custom_tag_cloud_widget' ) ) {
	add_filter( 'widget_tag_cloud_args', 'wpcast_custom_tag_cloud_widget' );
	function wpcast_custom_tag_cloud_widget($args) {
		$args['number'] = '26'; //adding a 0 will display all tags
		$args['largest'] = '12'; //largest tag
		$args['smallest'] = '12'; //smallest tag
		$args['unit'] = 'px'; //tag font unit
		return $args;
	}
}
