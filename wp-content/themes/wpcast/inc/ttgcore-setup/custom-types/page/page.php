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
 *	Design settings for single page
 *	=============================================================
 */
if(!function_exists("wpcast_custom_page_fields_settings")){
function wpcast_custom_page_fields_settings() {
	$settings = array (
		array (
			'label' =>  esc_html__('Hide page header',"wpcast"),
			'id' =>  'wpcast_page_header_hide',
			'default' => "0",
			'type' 	=> 'select',
			'options' => array (
				array('label' => esc_attr__( 'Hide',"wpcast" ),'value' => '1'),	
			)
		)
	);
	if(function_exists('custom_meta_box_field')){
		$settingsbox = new Custom_Add_Meta_Box('wpcast_post_special_fields', 'Page design settings', $settings, 'page', true );
	}
}}
add_action('init', 'wpcast_custom_page_fields_settings');  

