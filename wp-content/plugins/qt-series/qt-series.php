<?php  
/*
Plugin Name: QantumThemes Series
Plugin URI: http://qantumthemes.xyz
Description: Adds series management
Version: 1.0
Author: qantumthemes
Author URI: http://qantumthemes.com
Text Domain: qt-series
Domain Path: /languages
*/


/**
 * 	Global series taxonomy name and slug. To use in the theme too
 * 	=============================================
 */

if( !function_exists('qt_series_custom_series_name') ){
	function qt_series_custom_series_name(){
		return 'qtserie'; // strongly recommended to keep it like this
	}
}
if( !function_exists('qt_series_custom_series_slug') ){
	function qt_series_custom_series_slug(){
		return 'podcast-series'; // change to whatever you like, no problem. Refresh permalinks afterwards
	}
}

/**
 * Returns current plugin version.
 * @return string Plugin version.
 * =============================================
 */

function qt_series_plugin_get_version() {
	if ( is_admin() ) {
		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_version = $plugin_data['Version'];
	} else {
		$plugin_version = get_file_data( __FILE__ , array('Version'), 'plugin');
	}
	return $plugin_version;
}




/**
 * 	language files
 * 	=============================================
 */

if(!function_exists('qt_series_load_text_domain')){
function qt_series_load_text_domain() {
	load_plugin_textdomain( 'qt-series', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}}
add_action( 'init', 'qt_series_load_text_domain' );




/**
 * 	includes
 * 	=============================================
 */

include(plugin_dir_path( __FILE__ ) . '/includes/taxonomy.php');
