<?php  
/*
Plugin Name: Themes2Go ReAktions
Plugin URI: http://themes2go.xyz
Description: Adds ratings, views, love and sharing, all in one.
Version: 3.1.2
Author: Themes2Go
Author URI: http://themes2go.com
Text Domain: ttg-reaktions
Domain Path: /languages
*/

/**
 * Functions list:
 *
 * 	Shortcodes
 *	[ttg_reaktions-social Creates social sharing functions] -> returns HTML
 *	[ttg_reaktions-loveit-link --- ttg_reaktions_loveit_link Creates LOVE button] -> returns HTML
 *	[ttg_reaktions-loveit-count --- ttg_reaktions_loveit_count show number of loveit]
 *	[ttg_reaktions-rating --- 'ttg_reaktions_rating() Display the rating]
 *	[ttg_reaktions-views --- ttg_reaktions_viewsdisplay() Display number of views] -> returns HTML
 *	[ttg_reaktions-readingtime-raw]
 *	[ttg_reaktions-readingtime]
 *	[ttg_reaktions-full --- ttg_reaktions_full() All the stuff]
 *
 * 	Helpers:
 *	[ttg_reaktions_viewsread Display number of views without] -> returns INTEGER
 *	[ttg_reaktions_loveit_count Display number of LOVE] -> returns INTEGER
 *
 *
 *
 *
 *
 * 
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


function ttg_reaktions_active(){
	return true;
}



function ttg_reaktions_get_time_before_revote(){
	return get_option("ttg_reaktions_timeout_revote", '120');
}



/**
* Returns current plugin version.
* @return string Plugin version. Needs to stay here because of plugin file path
*/
function ttg_reaktions_plugin_get_version() {
	if ( is_admin() ) {
		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_version = $plugin_data['Version'];
	} else {
		$plugin_version = get_file_data( __FILE__ , array('Version'), 'plugin');
	}
	return $plugin_version;
}



/**
* Returns current plugin url for css and img.
*/
function ttg_reaktions_plugin_get_url() {
	return plugin_dir_url(__FILE__);
}


/**
 * 	language files
 * 	=============================================
 */
if(!function_exists('ttg_reaktions_load_text_domain')){
function ttg_reaktions_load_text_domain() {
	load_plugin_textdomain( 'ttg-reaktions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}}
add_action( 'init', 'ttg_reaktions_load_text_domain' );

/**
 * 	includes
 * 	=============================================
 */
include(plugin_dir_path( __FILE__ ) . '/includes/backend/settings.php');
include(plugin_dir_path( __FILE__ ) . '/includes/frontend/functions.php');
include(plugin_dir_path( __FILE__ ) . '/includes/ajax/ajax-love.php');


/**
 * 	hooks
 * 	=============================================
 */

if( get_option('ttg_reaktions_love', 1) ) {
	add_action('wp_ajax_nopriv_post-like', 'ttg_reaktions_post_like');
	add_action('wp_ajax_post-like', 'ttg_reaktions_post_like');
}
if( get_option('ttg_reaktions_views', 1) ) {
	add_action( 'wp_ajax_ttg_post_views', 'ttg_post_views' );
	add_action( 'wp_ajax_nopriv_ttg_post_views', 'ttg_post_views' );
}
if( get_option('ttg_reaktions_ratings', 1) ) {
	add_action( 'wp_ajax_ttg_rating_submit', 'ttg_rating_submit' );
	add_action( 'wp_ajax_nopriv_ttg_rating_submit', 'ttg_rating_submit' );
}



/**
 * 	Enqueue styles
 * 	=============================================
 */
if(!function_exists('ttg_reaktions_enqueue_styles')){
function ttg_reaktions_enqueue_styles(){
	wp_enqueue_style('ttg-reaktions-style', plugin_dir_url(__FILE__).'assets/css/style.css' );
	wp_enqueue_style('reakticons', plugin_dir_url(__FILE__).'assets/reakticons/styles.css', false, '2' );
	wp_enqueue_style('qt-socicon', plugin_dir_url(__FILE__).'assets/qt-socicon/styles.css', false, '2' );
}}
add_action( 'wp_head', 'ttg_reaktions_enqueue_styles', 0 );

/**
 * 	Enqueue scripts
 * 	=============================================
 */
if(!function_exists('ttg_reaktions_lenqueue_stuff')){
function ttg_reaktions_lenqueue_stuff(){
	// scripts
	wp_enqueue_script('popup', plugin_dir_url(__FILE__).'js/popup/popup.js', array('jquery'), '1.0', true );
	// ajax stuff
	wp_register_script('ttg_reaktions_script', plugin_dir_url(__FILE__).'js/ttg-reaktions.js', array('jquery', 'popup', 'qt-main' ), '1.0', true );
	wp_localize_script('ttg_reaktions_script', 'ajax_var', array(
	    'url' => admin_url('admin-ajax.php'),
	    'nonce' => wp_create_nonce('ajax-nonce')
	));
	wp_enqueue_script('ttg_reaktions_script');
}}

add_action( 'wp_enqueue_scripts', 'ttg_reaktions_lenqueue_stuff' );

