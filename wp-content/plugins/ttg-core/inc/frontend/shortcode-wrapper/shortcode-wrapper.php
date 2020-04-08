<?php  
/**
 *
 *	shortcode-wrapper.php
 *	Author: Igor Nardo (Themes2Go - Qantumthemes)
 *	This component is a wrapper for shortcodes
 *	so the themes can customize those aspetcs without editing the engine of the backend
 *	and adding maintainability to the software.
 * 
 */

if(!function_exists('ttg_custom_shortcode')){
function ttg_custom_shortcode ( $shortcode , $function ){
	add_shortcode($shortcode , $function);
}}