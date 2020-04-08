<?php  
/**
 * ======================================================
 * GUTENBERG SETTINGS
 * ------------------------------------------------------
 * add custom gutenberg styling and settings
 * ======================================================
 */


/**
 * ======================================================
 * Gutenberg
 * ------------------------------------------------------
 * Load Google Fonts in Gutenberg.
 * Load custom typography styling for Gutenberg editor
 * ======================================================
 */
if(!function_exists('wpcast_gutenberg_admin_css')){
	add_action('admin_head', 'wpcast_gutenberg_admin_css');
	function wpcast_gutenberg_admin_css() {
		wp_enqueue_style( 'wpcast-editor-gutenberg', get_theme_file_uri( '/inc/gutenberg/css/theme-editor-gutenberg.css' ), array(), wpcast_theme_version() );
	}
}