<?php  
/**
 * WoCast Child theme
 * custom functions.php file
 */

/**
 * Add parent and child stylesheets
 */
add_action( 'wp_enqueue_scripts', 'wpcast_child_enqueue_styles' );
if(!function_exists('wpcast_child_enqueue_styles')) {
function wpcast_child_enqueue_styles() {
    wp_enqueue_style( 'wpcast-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'wpcast-child-style', get_stylesheet_uri() );
}}

/**
 * Upon activation flush the rewrite rules to avoid 404 on custom post types
 */
add_action( 'after_switch_theme', 'wpcast_child_rewrite_flush_child' );
if(!function_exists('wpcast_child_rewrite_flush_child')) {
function wpcast_child_rewrite_flush_child() {
    flush_rewrite_rules();
}}	


/**
 * Setup wpcast Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function wpcast_child_theme_setup() {
	load_child_theme_textdomain( 'wpcast-child',  get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'wpcast_child_theme_setup' );