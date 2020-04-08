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
$share = false;
?>
<div class="wpcast-actions__cont">
	<div class="wpcast-actions">
			<?php 
			
			if(function_exists('ttg_reaktions_loveit_link')){
				echo ttg_reaktions_loveit_link('wpcast-a1');
			}

			/**
			 * ========================================================
			 * Qt Music Player compatibility
			 * Display a functional player for audio posts and 
			 * ========================================================
			 */
			switch ( $format ){
				case 'audio': 
					// If we have QT Music Player actived we can use this one
					// ========================================================
					$player = '';
					if( function_exists( 'qtmplayer_play_circle' )) {
						$atts = array(
							'id' 		=> 	$post->ID,
							'classes' 	=>	'wpcast-a0'
						);
						// This is the interactive circle player
						// made by the qtmPlayer plugin
						$player = qtmplayer_play_circle( $atts );
					} 

					if( $player !== '' ){
						echo qtmplayer_play_circle( $atts );
					} else {
						?>
						<a href="<?php the_permalink(); ?>" class="wpcast-a0"><i class="material-icons">insert_link</i></a>
						<?php
					}
					break;
				case 'std': 
				default: 
					/**
					 * Normal post type actions
					 */
					?>	
					<a href="<?php the_permalink(); ?>" class="wpcast-a0"><i class="material-icons">insert_link</i></a>
					
				<?php
			}


			/**
			 * ========================================================
			 * Ttg Reaktions Plugin COmpatibility
			 * If we are using the Reaktions plugin, we can include the share functionality
			 * ========================================================
			 */
			if( shortcode_exists( 'ttg_reaktions-sharebox' )){
				?>
				<i class="material-icons wpcast-a2" data-wpcast-activates="gparent">share</i>
				<?php
			}
		
			/**
			 * ========================================================
			 * Qt Music Player compatibility
			 * Add To Playlist button
			 * ========================================================
			 */

			if( 'audio' ==  $format && function_exists( 'qtmplayer_add_to_playlist' )) { // if the plugin of the player is active
				$atts = array(
					'id' 		=> 	$post->ID,
					'classes' 	=>	'material-icons wpcast-a3',
					'icon'		=> 'playlist_add'
				);
				echo qtmplayer_add_to_playlist($atts);
			}
			?>
	</div>
	<?php  
	/**
	 * Ttg Reaktions Plugin COmpatibility
	 * If we are using the Reaktions plugin, we can include the share functionality
	 */
	if( shortcode_exists( 'ttg_reaktions-sharebox' )){
		?>
		<div class="wpcast-sharebox">
			<div class="wpcast-sharebox__c">
				<?php 
				echo wpcast_do_shortcode( '[ttg_reaktions-sharebox classbtn="wpcast-btn wpcast-btn__r wpcast-btn__neg"]' ); 
				?>
			</div>
			<i class="material-icons wpcast-sharebox__x" data-wpcast-activates="gparent">close</i>
		</div>
		<?php  
	}
	?>
</div>


