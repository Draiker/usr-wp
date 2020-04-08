<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 * ======================================================
 * Excerpt length
 * ------------------------------------------------------
 * Depending on the template we may require to change the 
 * excerpt length to different sizes for a nice effect.
 * ======================================================
 */
add_filter( 'excerpt_length', 'wpcast_excerpt_length', 999 );
if(!function_exists('wpcast_excerpt_length')){
function wpcast_excerpt_length( $length ) {
	return 50;
}}
if(wp_is_mobile()){
	add_filter( 'excerpt_length', 'wpcast_excerpt_length_20', 999 );
}



if(!function_exists('wpcast_the_excerpt_scremove_now')){
function wpcast_the_excerpt_scremove_now( $content ) {
	// $content = '';
	// return $content;
	// $content = preg_replace('#\[[^\]]+\]#', '',$content );
	return strip_shortcodes( $content );
}}


if(!function_exists('wpcast_excerpt_length_20')){
function wpcast_excerpt_length_20( $length ) {
	return 20;
}}

if(!function_exists('wpcast_excerpt_length_30')){
function wpcast_excerpt_length_30( $length ) {
	return 30;
}}
if(!function_exists('wpcast_excerpt_length_40')){
function wpcast_excerpt_length_40( $length ) {
	return 40;
}}
if(!function_exists('wpcast_excerpt_length_100')){
function wpcast_excerpt_length_100( $length ) {
	return 100;
}}
if(!function_exists('wpcast_excerpt_length_300')){
function wpcast_excerpt_length_300( $length ) {
	return 300;
}}

if(!function_exists('wpcast_trim_all_excerpt')){
function wpcast_trim_all_excerpt($text) {
	// Creates an excerpt if needed; and shortens the manual excerpt as well
	global $post;
   $raw_excerpt = $text;
   if ( '' == $text ) {
	  $text = get_the_content('');
	  $text = strip_shortcodes( $text );
	  $text = apply_filters('the_content', $text);
	  $text = str_replace(']]>', ']]&gt;', $text);
   }

	$text = strip_tags($text);
	$excerpt_length = apply_filters('excerpt_length', 55);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
	$text = wp_trim_words( $text, $excerpt_length, $excerpt_more ); 

	return apply_filters('wpcast_trim_excerpt', $text, $raw_excerpt); 
}}
add_filter('get_the_excerpt', 'wpcast_trim_all_excerpt');