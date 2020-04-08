<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 *
 * Settings for the PageBuilder plugin, if active
 */


/**
 * Page Builder declare as theme plugin
 * to avoid eccessive bothering.
 */
if(function_exists('vc_set_as_theme')){
	vc_set_as_theme();
}


/* Visual composer extension settings
=============================================*/
if(defined( 'WPB_VC_VERSION' ) && function_exists( 'vc_add_param' )){
	add_action( 'vc_after_init', 'wpcast_vc_after_init_actions' );
	function wpcast_vc_after_init_actions() {


		if(defined( 'WPB_VC_VERSION' )){
			wp_enqueue_script( 'wpb_composer_front_js' );
			wp_enqueue_style( 'js_composer_front' );
		}

		/**
		 * If using Ajax page loading, some elements of Page Builder (Visual Composer)
		 * annot be reinitialized because of the way its JS is created, so we need to remove
		 * those elements
		 */
		if(function_exists( 'vc_remove_element' ) && function_exists( 'qt_ajax_pageload_is_active' )){
			// Remove VC Elements 
			if( function_exists('vc_remove_element') ){
				vc_remove_element( 'vc_media_grid' );
				vc_remove_element( 'vc_masonry_grid' );
				vc_remove_element( 'vc_masonry_media_grid' );
				vc_remove_element( 'vc_basic_grid' );
				vc_remove_element( 'vc_line_chart' );
				vc_remove_element( 'vc_round_chart' );
				vc_remove_element( 'vc_pie' );
				vc_remove_element( 'vc_progress_bar' );
				vc_remove_element( 'vc_flickr' );
				vc_remove_element( 'vc_posts_slider' );
				vc_remove_element( 'vc_images_carousel' );
				vc_remove_element( 'vc_tta_pageable' );
				vc_remove_element( 'vc_gallery' );
				vc_remove_element( 'vc_tta_accordion' );
				vc_remove_element( 'vc_tta_tabs' );
				vc_remove_element( 'vc_tta_tour' );
			}
		}
		

		/**
		 * If using Ajax page loading, some parameters of Page Builder (Visual Composer)
		 * cannot be reinitialized because of the way its JS is created, so we need to remove
		 * those elements
		 */
		if( function_exists('vc_remove_param') && function_exists( 'qt_ajax_pageload_is_active' ) ){
			$all_shortcodes = array("vc_row","vc_row_inner","vc_column","vc_column_inner","vc_column_text","vc_section","vc_icon","vc_separator","vc_zigzag","vc_text_separator","vc_message","vc_facebook","vc_tweetmeme","vc_googleplus","vc_pinterest","vc_toggle","vc_tta_section","vc_custom_heading","vc_btn","vc_cta","vc_widget_sidebar","vc_video","vc_gmaps","vc_raw_html","vc_raw_js","vc_wp_search","vc_wp_meta","vc_wp_recentcomments","vc_wp_calendar","vc_wp_pages","vc_wp_tagcloud","vc_wp_custommenu","vc_wp_text","vc_wp_posts","vc_wp_links","vc_wp_categories","vc_wp_archives","vc_wp_rss","vc_empty_space","vc_tabs","vc_tour","vc_tab","vc_accordion","vc_accordion_tab","vc_posts_grid","vc_carousel","vc_button","vc_button2","vc_cta_button","vc_cta_button2");
			foreach ($all_shortcodes as $s){
				vc_remove_param( $s, 'css_animation' ); 
			}
			vc_remove_param( 'vc_row', 'full_width' ); 
		}
		
		/**
		 * Adding theme custom parameters
		 */
		if( function_exists('vc_add_param') ){ 
			vc_add_param(
				"vc_row", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Add container', "wpcast" ),
					'param_name' => 'wpcast_container',
					'description' => esc_html__( "Add a container box to the content to limit width", "wpcast" )
				)
			);
			vc_add_param(
				"vc_column", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Section vertical paddings', "wpcast" ),
					'param_name' => 'wpcast_section',
					'description' => esc_html__( "Add vertical paddings for section separator", "wpcast" )
				)
			);
			vc_add_param(
				"vc_row", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Negative colors', "wpcast" ),
					'param_name' => 'wpcast_negative',
					'description' => esc_html__( "Force white texts", "wpcast" )
				)
			);
			vc_add_param(
				"vc_row_inner", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Add container', "wpcast" ),
					'param_name' => 'wpcast_container',
					'description' => esc_html__( "Add a container box to the content to limit width", "wpcast" )
				)
			);
			vc_add_param(
				"vc_row_inner", 
				array(
					'type' => 'checkbox',
					'weight' => 1,
					'heading' => esc_html__( 'Negative colors', "wpcast" ),
					'param_name' => 'wpcast_negative',
					'description' => esc_html__( "Force white texts", "wpcast" )
				)
			);
		}
	}
}
