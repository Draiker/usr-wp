<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */


?>
<div class="wpcast-pageheader__nav-archive">
	<div class="wpcast-pageheader__nav-container">
		<?php 
		$pagination_args = array(
			'type' => 'plain',
			'prev_next' => true,
			
			'before_page_number' => '<span class="wpcast-num">',
			'after_page_number'  => '</span>',
			'mid_size' => 2,
			'prev_text'          => '<span class="wpcast-btn wpcast-btn__txt wpcast-navlink wpcast-navlink__p"><i class="material-icons">trending_flat</i>'.esc_html__('Previous page', 'wpcast').'</span>',
			'next_text'          => '<span class="wpcast-btn wpcast-btn__txt wpcast-navlink wpcast-navlink__n">'.esc_html__('Next page', 'wpcast')
			.'<i class="material-icons">trending_flat</i></span>',
		);
		$links = paginate_links( $pagination_args );

		if( $links ){
			echo paginate_links( $pagination_args ); 
		} else {

			/**
			 * This pagination is for the archive page templates
			 */
			$paged = wpcast_get_paged();
			$args = array('posts_per_page' => 10, 'paged' => $paged );

			/**
			 * [$args Query arguments]
			 * @var array
			 */
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'suppress_filters' => false,
				'paged' => wpcast_get_paged()
			);
			/**
			 * [$wp_query execution of the query]
			 * @var WP_Query
			 */
			$wp_query = new WP_Query( $args );
			if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			endwhile;endif;
			echo paginate_links( $pagination_args ); 
		}
		?>
	</div>
</div>



