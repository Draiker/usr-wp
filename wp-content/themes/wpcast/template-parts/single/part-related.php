<?php
/**
 * Related posts
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

$postid = get_the_id();

/**
 *
 *  Basic query preparation
 *  
 */

$previous_post = get_previous_post();
if($previous_post && !is_wp_error( $previous_post )){
	$argsList = array(
		'post_type' => 'post',
		'posts_per_page' => 2,
		'ignore_sticky_posts' => 1,
		'orderby' => array(  'menu_order' => 'ASC' ,    'post_date' => 'DESC'),
		'post_status' => 'publish',
		'post__not_in'=>array( $postid, $previous_post->ID )
	);




	/**
	 *
	 *  If this post is in a serie we try to get the posts
	 *  in the same serie, otherwise in same category.
	 *  
	 */

	$term_ids = false;

	// If this post is in a serie we check by serie
	$related_taxonomy = false;
	if( function_exists( 'qt_series_custom_series_name' ) ){
		$related_taxonomy = qt_series_custom_series_name();
		$terms = get_the_terms( $postid  , $related_taxonomy, 'string');
	}


	// If is not, go by category
	if( empty( $terms ) || is_wp_error( $terms ) ) {
		$terms = get_the_terms( $postid  , 'category', 'string');
	}


	// Add taxonomy query arguments
	if( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		if(is_array($terms) && false !== $related_taxonomy ) {
			$term_ids = wp_list_pluck($terms,'term_id');
			if ($term_ids) {
				$argsList['tax_query'] =  array(
					array(
						'taxonomy' => $related_taxonomy,
						'field' => 'id',
						'terms' => $term_ids,
						'operator'=> 'IN'
					)
				);
			}
		}
	}


	/**
	 * 
	 * Execute query
	 * 
	 */
	$the_query = new WP_Query($argsList);

	if ( $the_query->have_posts() ) :

		if( $the_query->post_count > 0 ){
			?>
			<h6 class="wpcast-caption wpcast-caption__s wpcast-spacer-m">
			<?php 
			if( get_post_format() === 'audio' ){
				esc_html_e( 'Similar episodes', 'wpcast' ); 
			} else {
				esc_html_e( 'Similar posts', 'wpcast' ); 
			}
			?>
			</h6>
			<div class="wpcast-row">
				<?php 
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
					?>
					<div class="wpcast-col  wpcast-s12 wpcast-m6  wpcast-l6">
						<?php
						setup_postdata( $post ); 
						get_template_part( 'template-parts/post/post-vertical' );
						wp_reset_postdata();
						?>
					</div>
					<?php
				endwhile;
				?>
			</div>
			<?php  
		}
	endif;
}
wp_reset_postdata();
