<?php  
/*
Plugin Name: QantumThemes Taxonomy Background
Plugin URI: http://qantumthemes.xyz
Description: Adds background image to taxonomies
Version: 1.0.1
Author: qantumthemes
Author URI: http://qantumthemes.com
Text Domain: qt-taxonomy-background
Domain Path: /languages
*/


// Just let the theme know the plugin is active
function qt_taxonomy_background_active(){
	return true;
}

/**
 * 	includes
 * 	=============================================
 */

include(plugin_dir_path( __FILE__ ) . '/inc/background.php');
include(plugin_dir_path( __FILE__ ) . '/inc/customizations-frontend.php');
