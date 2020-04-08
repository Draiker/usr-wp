<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/


/**
 * ======================================================
 * Register sidebars
 * ------------------------------------------------------
 * Creates 2 custom sidebars for the theme
 * ======================================================
 */
if(!function_exists( 'wpcast_widgets_init' )){
	add_action( 'widgets_init', 'wpcast_widgets_init' );
	function wpcast_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', "wpcast" ),
			'id'            => 'wpcast-right-sidebar',
			'before_widget' => '<li id="%1$s" class="wpcast-widget wpcast-col wpcast-s12 wpcast-m6 wpcast-l12  %2$s">',
			'before_title'  => '<h6 class="wpcast-widget__title wpcast-caption wpcast-caption__s"><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Off canvas Sidebar', "wpcast" ),
			'id'            => 'wpcast-offcanvas-sidebar',
			'before_widget' => '<li id="%1$s" class="wpcast-widget wpcast-col wpcast-s12 wpcast-m6 wpcast-l12  %2$s">',
			'before_title'  => '<h6 class="wpcast-widget__title wpcast-caption wpcast-caption__s"><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
	}
}