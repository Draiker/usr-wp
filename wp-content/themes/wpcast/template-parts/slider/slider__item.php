<?php
/**
 * 
 * Template part for displaying posts with Hero design (title in image)
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

$series = false;
if( function_exists( 'qt_series_custom_series_name' )){
	$series = get_the_terms( $post->ID, qt_series_custom_series_name());
}

$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}
add_filter( 'excerpt_length', 'wpcast_excerpt_length_40', 999 );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('wpcast-slider__item'); ?>>
	<div class="wpcast-slider__img">
		<?php 
		if( has_post_thumbnail( $post->ID )){
			the_post_thumbnail( 'full', array( 'class' => 'wpcast-slider__i', 'alt' => esc_attr( get_the_title() ) ) );
		}
		?>
	</div>
	<div class="wpcast-slider__c">
		<div class="wpcast-container">
			<h6 class="wpcast-capfont wpcast-slider_det">
				<?php 
				if($series){
					if(is_array($series)){ 
						if( array_key_exists(0, $series) ){
						?>
						<span class="wpcast-ser"><?php echo esc_html( $series[0]->name ); ?></span>
						<?php  
						}
					}
				}
				?>
				<span class="wpcast-dot"></span>
				<span class="wpcast-meta"><?php esc_html_e( 'By' , 'wpcast' ); echo ' '; the_author(); echo ' '; esc_html_e( 'On' , 'wpcast' ); echo ' '; echo get_the_date(); ?></span>
			</h6>
			<h2 class="wpcast-post__title wpcast-cutme-t-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p><?php echo get_the_excerpt(); ?></p>
			<div class="wpcast-slider__btns">
				<a href="<?php the_permalink(); ?>" class="wpcast-btn wpcast-btn__neg wpcast-icon-l"><i class='material-icons'>play_arrow</i><?php esc_html_e( 'Read All', 'wpcast' ); ?></a>
				<?php 
				if($series && '1' == get_theme_mod( 'display_subscribe', '1' )){
					if(is_array($series) && function_exists( 'qt_series_custom_series_name' )){ 
						if( array_key_exists(0, $series) ){
							?><a href="<?php echo esc_attr( wpcast_archive_feed_link( $series[0]->term_id, qt_series_custom_series_name() ) ) ; ?>" class="wpcast-btn wpcast-btn__txt wpcast-icon-l" target="_blank"><i class="material-icons">rss_feed</i><?php esc_html_e( 'Subscribe', 'wpcast' ); ?></a><?php  
						}
					}
				}
				?>
			</div>
		</div>

		<?php 
		/**
		 * Action content
		 * ===============================
		 */
		?>
		<div class="wpcast-slider__ac">
			<?php
			/**
			 * Action button
			 * ===============================
			 */
			switch ( $format ){
				case 'audio': 
					/**
					 * ========================================================
					 * Audio post type actions
					 * ========================================================
					 */

					// If we have QT Music Player actived we can use this one
					$player = '';
					if( function_exists( 'qtmplayer_play_circle' )) {
						$atts = array(
							'id' 		=> 	$post->ID,
							'classes' 	=>	'wpcast-slider__ab'
						);
						$player = qtmplayer_play_circle( $atts );
					} 

					if( $player !== '' ){
						if( function_exists( 'qtmplayer_play_circle' )) {
							echo qtmplayer_play_circle( $atts ); // this is from qtm player
						}
					} else {
						?>
						<a href="<?php the_permalink(); ?>" class="wpcast-slider__ab"><i class="material-icons">play_arrow</i></a>
						<?php
					}
					break;
				case 'std': 
				default: 
					/**
					 * Normal post type actions
					 */
					?>	
					<a href="<?php the_permalink(); ?>" class="wpcast-slider__ab"><i class="material-icons">insert_link</i></a>
				<?php
			}
			?>
		</div>

		
	</div>
</article>
<?php  
add_filter( 'excerpt_length', 'wpcast_excerpt_length', 999 );