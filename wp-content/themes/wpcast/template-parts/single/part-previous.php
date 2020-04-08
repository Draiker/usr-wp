<?php
/**
 * Previous post
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/



$in_same_term = false;
$taxonomy = 'category' ;
$excluded_terms = '';
if( function_exists( 'qt_series_custom_series_name' ) ){
	$related_taxonomy = qt_series_custom_series_name();
	$format = get_post_format();
	$terms = get_the_terms( $post->ID  , $related_taxonomy, 'string');
	if( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		if(is_array($terms)) {
			$in_same_term = true;
			$taxonomy = $related_taxonomy;
		}
	}
}

// Extract objects because we make custom HTML
$prev_post = get_adjacent_post( $in_same_term, $excluded_terms, true, $taxonomy );

// $prev_post = get_previous_post(); // no support to get it in same taxonomy
if (!empty( $prev_post )): 


	$post = $prev_post;
	setup_postdata( $post );

	add_filter( 'excerpt_length', 'wpcast_excerpt_length_30', 999 );

	?>
	<h6 class="wpcast-caption wpcast-caption__s wpcast-spacer-m">
	<?php 
	if( get_post_format() === 'audio' ){
		esc_html_e( 'Previous episode', 'wpcast' ); 
	} else {
		esc_html_e( 'Previous post', 'wpcast' ); 
	}
	?>
	</h6>
	<?php 
	
	get_template_part( 'template-parts/post/post-horizontal' );
	wp_reset_postdata();
	// put excerpt back to normal
	add_filter( 'excerpt_length', 'wpcast_excerpt_length', 999 );
endif;
wp_reset_postdata();