<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 *	TTG Core is our own plugin to create custom types, metas and options
 *	based on the specifi theme's configuration
 *
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * ======================================================
 * TTG Theme Core setup
 * ------------------------------------------------------
 * For custom types fields and appearance customizer.
 * These are settings used by our Theme Core plugin.
 * These settings are defined to load customizer options,
 * custom post types, post meta options and user options.
 * ======================================================
 */
if(function_exists('ttg_core_active') ){
	

	/**
	 * Settings for the TTG Core plugin
	 * This will shape custom types and taxonomies if required from the theme
	 */
	require_once get_theme_file_path( '/inc/ttgcore-setup/custom-types/post/post.php' );
	require_once get_theme_file_path( '/inc/ttgcore-setup/custom-types/page/page.php' );

	/**
	 * Author box settings (if the plugin Themes2Go Author Box is enabled)
	 * $qt_user_social [array] list of social icons that overrides the default in TTG Core Plugin
	 */
	if ( function_exists( 'ttgcore_modify_contact_methods' )){
		$qt_user_social = array(); // disable the Themes2Go Core author box fields because we include a more complete plugin
	}

	/* Customizer */
	// Early exit if Kirki is not installed
	if ( class_exists( 'Kirki' ) ) {
		require_once   get_theme_file_path( '/inc/ttgcore-setup/customizer/kirki-configuration/sections.php' );
		require_once   get_theme_file_path( '/inc/ttgcore-setup/customizer/kirki-configuration/fields.php' );
		require_once   get_theme_file_path( '/inc/ttgcore-setup/customizer/kirki-configuration/configuration.php' ); 
	}
}

// can be used also without ttg-core plugin, so include is out of the exception
// because now this works also with Gutenberg (assuming you have the Gutenberg extension for this theme)
require_once   get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-functions.php' ); 