<?php
/**
 * Protected post
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 *
 * This template outputs the tracklist with time cues
 * Tracklist fields created by the QtMusicPlayer plugin
 *
 *
 *
 * IMPORTANT: 
 * If you set in the customizer the replace of the default audio block,
 * there will be no output from this template.
 *
 * If replace audio is active, the output will be performed directly below the player,
 * from the qtMusicPlayer plugin!
*/
if(function_exists('qtmplayer_tracklist')) {
	$atts = array(
		'id' => $post->ID,
		'title_classes'	=> 'wpcast-caption wpcast-caption__s',
		'classes' => 'wpcast-tracklist-container', // additional container classes
		'print' => true // include the echo function
	);
	if( get_theme_mod( 'wpcast_replace_default', '1' ) == '0') {
		qtmplayer_tracklist( $atts );
		wp_reset_postdata();
	}
}