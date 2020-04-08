<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 * ======================================================
 * THEME VERSION
 * ------------------------------------------------------
 * Theme version definition to prevent caching of old files
 * ======================================================
 */
if(!function_exists('wpcast_theme_version')){
function wpcast_theme_version(){
	$my_theme = wp_get_theme( );
	return $my_theme->get( 'Version' );
}}