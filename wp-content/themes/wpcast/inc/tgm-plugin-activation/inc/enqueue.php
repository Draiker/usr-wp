<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage wpcast
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/* ADMIN CSS and Js loading
=============================================*/
if(!function_exists('wpcast_tgm_admin_files_inclusion')){
function wpcast_tgm_admin_files_inclusion() {
	wp_enqueue_style( 'wpcast-tgm-admin', get_theme_file_uri('/inc/tgm-plugin-activation/css/wpcast-tgm-admin.css' ), false, '1.0.0' );
}}
add_action( 'admin_enqueue_scripts', 'wpcast_tgm_admin_files_inclusion', 999999 );