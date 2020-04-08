<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/


/* Register fonts
=============================================*/
if(!function_exists('wpcast_fonts_url')){
function wpcast_fonts_url() {
	$font_url = '';
	/*
	Translators: If there are characters in your language that are not supported
	by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'wpcast' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Rubik:500|Karla:400,700' ), "//fonts.googleapis.com/css" );
	}
	return $font_url;
}}



/* ADMIN CSS and Js loading
=============================================*/
if(!function_exists('wpcast_admin_files_inclusion')){
function wpcast_admin_files_inclusion() {
	wp_enqueue_style( 'wpcast-fonts', wpcast_fonts_url(), array(), '1.0.0' );
}}
add_action( 'admin_enqueue_scripts', 'wpcast_admin_files_inclusion', 999999 );


/**
 * ======================================================
 * CSS and Js loading
 * ------------------------------------------------------
 * Theme javascript and style inclusion
 * ======================================================
 */
if(!function_exists('wpcast_styles_inclusion')){
	
	add_action( 'wp_enqueue_scripts', 'wpcast_styles_inclusion', 500 );
	
	function wpcast_styles_inclusion() {
		
		// Styles
		wp_enqueue_style( "qt-socicon", get_theme_file_uri( '/fonts/qt-socicon/styles.css' ), false, '1', "all" );
		wp_enqueue_style( "material-icons", get_theme_file_uri( '/fonts/google-icons/material-icons.css' ), false, wpcast_theme_version(), "all" );
		// if no customizer is active, load default colors and fonts
		if( !function_exists( 'ttg_core_active' ) ){
			wp_enqueue_style( 'wpcast-fonts', wpcast_fonts_url(), array(), '1.0.0' );
			wp_enqueue_style( "wpcast-typography", 	get_theme_file_uri( '/css/wpcast-typography.css' ), false, wpcast_theme_version(), "all" );
		}
		wp_enqueue_style( 'wpcast-style', get_stylesheet_uri(), false, wpcast_theme_version(), "all" );
		


		// js libraries
		$deps = array('jquery', 'masonry');



		/**
		 * Enqueue Visual Composer styles in every page for ajax compatibility
		 */
		if( defined( 'WPB_VC_VERSION' ) && function_exists( 'qt_ajax_pageload_is_active' )){
			if(function_exists('vc_asset_url')){
				wp_register_style( 'vc_tta_style', vc_asset_url( 'css/js_composer_tta.min.css' ), false, WPB_VC_VERSION );
				wp_enqueue_style( 'vc_tta_style' );
				wp_register_script( 'vc_accordion_script', vc_asset_url( 'lib/vc_accordion/vc-accordion.min.js' ), array( 'jquery' ), WPB_VC_VERSION, true );
				wp_register_script( 'vc_tta_autoplay_script', vc_asset_url( 'lib/vc-tta-autoplay/vc-tta-autoplay.min.js' ), array( 'vc_accordion_script' ), WPB_VC_VERSION, true );
				wp_enqueue_script( 'vc_accordion_script' );  $deps[] = 'vc_accordion_script';
				if ( ! vc_is_page_editable() ) {
					wp_enqueue_script( 'vc_tta_autoplay_script' ); $deps[] = 'vc_tta_autoplay_script';
				}
				// required to ajax-load pages with background videos
				wp_register_script( 'vc_youtube_iframe_api_js', 'https://www.youtube.com/iframe_api', array(), WPB_VC_VERSION, true );
				wp_enqueue_script( 'vc_youtube_iframe_api_js' ); $deps[] = 'vc_youtube_iframe_api_js' ;
			}
			wp_enqueue_script( 'wpb_composer_front_js' );$deps[] = 'wpb_composer_front_js' ;
			// CSS for ajax page composer
			wp_enqueue_style( 'js_composer_front' );
			wp_enqueue_style( 'js_composer_custom_css' );
			wp_enqueue_style( 'animate-css' ); // visual composer animation styles
		}


		wp_enqueue_script( 'modernizr', get_theme_file_uri( '/components/modernizr/modernizr-custom.js' ), $deps, '3.5.0', true ); $deps[] = 'modernizr';
		wp_enqueue_script( 'skip-link-focus-fix', get_theme_file_uri( '/js/skip-link-focus-fix.js' ), array(), '20151215', true );
		// stellar.js for parallax fx
		wp_enqueue_script( 'stellar', get_theme_file_uri( '/components/stellar/jquery.stellar.min.js' ), $deps, '0.6.2', true ); $deps[] = 'stellar';
		
		// ======================================================
		// main script file:
		// ------------------------------------------------------
		// IMPORTANT! 
		// 		IMPORTANT! 
		// 			IMPORTANT! 
		// ------------------------------------------------------
		// It has to be called qt-main as it's a dependency of 
		// external plugins as the QT Music Player
		// and QT Ajax Page Loader, which are standard 
		// corporate plugins for all of our themes.
		// 
		// For Themeforest development guidelines, we can't include the functionalities of these plugins in the theme.
		// 
		// ANYWAY, the JS of external plugins must interact with the theme's js and the only way is to use this
		// as dependency of the external plugins from our company.
		// 
		// ==================================================================================
		// ==================================================================================
		// 
		// 		This is the only way to put the functions in external plugins
		// 		and have them working correctly with the theme, as we always did in every theme.
		// 		
		// 	==================================================================================
		// 	==================================================================================
		// 
		// qt- is official prefix for qantumthemes framework.
		// ======================================================
		wp_enqueue_script( 'qt-main', get_theme_file_uri('/js/qt-main.js'), $deps, wpcast_theme_version(), true ); $deps[] = 'qt-main';
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
