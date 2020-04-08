<?php
/**
 * 
 * Display the post interactions on top of the header image
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/


$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}

if( function_exists( 'qtmplayer_play_circle' ) && $format == 'audio' ){
	// If we have QT Music Player actived we can use this one
	// ========================================================
	$player = '';
	$atts = array(
		'id' 		=> 	$post->ID,
		'classes' 	=>	'wpcast-a0'
	);
	// This is the interactive circle player
	// made by the qtmPlayer plugin
	$player = qtmplayer_play_circle( $atts );
	if( $player !== '' ){
		?>
		<div class="wpcast-actions__cont">
			<div class="wpcast-actions">
				<?php echo qtmplayer_play_circle( $atts ); ?>
			</div>
		</div>
		<?php
	} 
}

