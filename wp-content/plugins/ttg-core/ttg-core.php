<?php
/*
Plugin Name: Themes2Go Theme Core Plugin
Plugin URI: http://www.themes2go.xyz/
Description: Adds custom type and custom fields capabilities and extends customizer capabilities. Containes Metaboxes and Kirki cutom versions for Themes2Go and QantumThemes
Author: Themes2Go
Version: 2.1.0
Text Domain: ttg-core
Domain Path: /languages
*/


/**
 *
 *	For theme to check if is active
 * 
 */
if(!function_exists('ttg_core_active')){
	function ttg_core_active() {
		return true;
	}
}

/**
 *
 *	The plugin textdomain
 * 
 */
if(!function_exists('ttg_core_load_plugin_textdomain')){
function ttg_core_load_plugin_textdomain() {
	load_plugin_textdomain( 'ttg-core', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}}

add_action( 'plugins_loaded', 'ttg_core_load_plugin_textdomain' );

/**
 *
 *	Metaboxes component
 * 
 */
if(!function_exists('custom_meta_box_field')){
	require	plugin_dir_path( __FILE__ ) . '/inc/backend/metaboxes/meta_box.php';
}

/**
 *	Kirki Framework Files Inclusion
 *	Customizer component
 *	Documentation: https://github.com/aristath/kirki/wiki
 *	Attention: this is a custom version with many fixes
 */
if ( ! function_exists( 'Kirki' ) ) {
	require	plugin_dir_path( __FILE__ ) . '/inc/backend/kirki/kirki.php';
	
}
if ( ! class_exists( 'Kirki2_Kirki' ) ) {
	require	plugin_dir_path( __FILE__ ) . '/inc/backend/kirki-config-class/class-kirki2-kirki.php';
	require	plugin_dir_path( __FILE__ ) . '/inc/backend/kirki-config-class/include-kirki.php';
}

/**
 *
 *	Metaboxes component
 * 
 */
if(!function_exists('ttgcore_modify_contact_methods')){
	require	plugin_dir_path( __FILE__ ) . '/inc/backend/author/author-meta.php';
}

/**
 *
 *	Custom types component
 * 
 */
if ( ! function_exists( 'ttg_custom_post_type' ) ) {
	require	plugin_dir_path( __FILE__ ) . '/inc/backend/posttypes/posttypes.php';
}

/**
 *
 *	Custom shortcodes component
 * 
 */
if ( ! function_exists( 'ttg_custom_shortcode' ) ) {
	require	plugin_dir_path( __FILE__ ) . '/inc/frontend/shortcode-wrapper/shortcode-wrapper.php';
}

/*
*	Scripts and styles Backend
*	
*/
if(!function_exists("ttg_extensionsuite_loader_backend")){
function ttg_extensionsuite_loader_backend(){
	wp_enqueue_style( 'qtExtensionSuiteStyle',plugins_url( '/assets/style.admin.css' , __FILE__ ),false);
}}
add_action("admin_enqueue_scripts",'ttg_extensionsuite_loader_backend');


/*
*
*	We add some columns with featured images in the post archive so is easier 
*
*/
if (function_exists( 'add_theme_support' )){
    add_filter('manage_posts_columns', 'ttg_posts_columns', 5);
    add_action('manage_posts_custom_column', 'ttg_posts_custom_columns', 5, 2);    
}
function ttg_posts_columns($defaults){
    $defaults['wps_post_thumbs'] = __('Thumbs',"ttg-core");
    $defaults['wps_post_id'] = __('Post ID',"ttg-core");
    return $defaults;
}
function ttg_posts_custom_columns($column_name, $id){
	if($column_name === 'wps_post_thumbs'){
        echo the_post_thumbnail( "thumbnail" );
    }
    if($column_name === 'wps_post_id'){
        echo get_the_ID();
    }
}



add_filter('style_loader_tag', 'ttgcore_remove_type_attr', 9999, 2);
add_filter('script_loader_tag', 'ttgcore_remove_type_attr', 9999, 2);


function ttgcore_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}