<?php
/**
 * @package WordPress
 * @subpackage ttgcore
 * @subpackage wpcast
 * @version 1.0.0
 *
 * ======================================================================
 * SETTINGS FOR THE TTGCORE PLUGIN
 * _____________________________________________________________________
 * This file adds configurations for the TTGcore plugin for custom 
 * posty types and/or taxonomies
 * ======================================================================
 */


/*
 *	Design settings for single post to override customizer defaults
 *	=============================================================
 */
if(!function_exists("wpcast_custom_post_fields_settings")){
	add_action('init', 'wpcast_custom_post_fields_settings');  
	function wpcast_custom_post_fields_settings() {
		$settings = array (
			array (
				'label' =>  esc_html__('Post template',"wpcast"),
				'id' =>  'wpcast_post_template',
				'default' => "default",
				'type' 	=> 'select',
				'options' => array (
					array('label' => esc_attr__( 'Force full',"wpcast" ),'value' => '1'),	
					array('label' => esc_attr__( 'Force sidebar',"wpcast" ),'value' => '2'),	
				)
			)
		);
		if(class_exists('Custom_Add_Meta_Box')){
			$settingsbox = new Custom_Add_Meta_Box('wpcast_post_special_fields_design', 'Design settings', $settings, 'post', true );
		}
	}
}


