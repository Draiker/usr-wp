<?php  
/**
 * Configuration for the Kirki Customizer.
 * @package Kirki
 */


Kirki::add_config( 'wpcast_config', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod'
) );



if(!function_exists('wpcast_kirki_configuration')){
function wpcast_kirki_configuration( $config ) {
	return wp_parse_args( array (
		'disable_loader' => true
	), $config );
}}

add_filter( 'kirki/config', 'wpcast_kirki_configuration' );