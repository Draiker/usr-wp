<?php
/**
 * 
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

if( function_exists( 'qt_series_custom_series_name' )){
	$tags = get_the_terms( $post->ID, qt_series_custom_series_name());
	if(is_array($tags)){
		?><span class="wpcast-caption"><a href="<?php echo get_term_link( $tags[0]->term_id ); ?>" class="wpcast-cutme-t"><?php echo esc_html($tags[0]->name); ?></a></span><?php
	}
}
