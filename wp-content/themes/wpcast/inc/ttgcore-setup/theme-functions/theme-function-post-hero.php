<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Theme function for custom parts:
 * Post Hero
 *
 * Example:
 * [qt-post-hero  post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'wpcast_template_post_hero' )){
	function wpcast_template_post_hero( $atts = array() ){

		ob_start();
		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(

			// Query parameters
			'post_type' 			=> 'post',
			'include_by_id'			=> false,
			'custom_query'			=> false,
			'tax_filter'			=> false,
			'items_per_page'		=> 10,
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'meta_key'				=> false,
			'offset'				=> 0,

			'exclude'				=> '',

			// Global parameters
			'el_id'					=>  'qt-post-grid-'.get_the_ID(), // 
			'el_class'				=> '',
			'grid_id'				=> false // required for compatibility with WPBakery Page Builder
		), $atts ) );



		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);

		$paged = 1;

		include 'helpers/query-prep.php';

		/**
		 * [$wp_query execution of the query]
		 * @var WP_Query
		 */
		$wp_query = new WP_Query( $args );

		/**
		 * Loop start
		 */
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$post = $wp_query->post;
			setup_postdata( $post );
			?>
			
			<div class="wpcast-container">
				<?php get_template_part( 'template-parts/post/post-hero' ); ?>
			</div>
			
			<?php
			wp_reset_postdata();
		endwhile; endif;

		$output = ob_get_clean();
		
		return $output;

	}
}


// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-post-hero","wpcast_template_post_hero");
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'wpcast_template_post_hero_vc' );
if(!function_exists('wpcast_template_post_hero_vc')){
	function wpcast_template_post_hero_vc() {
  		vc_map( 
  			array(
				"name" => esc_html__( "Post hero", "wpcast" ),
				"base" => "qt-post-hero",
				"icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/qt-post-hero.png' ),
				"description" => esc_html__( "Post hero", "wpcast" ),
				"category" => esc_html__( "Theme shortcodes", "wpcast"),
				"params" => array_merge(
					wpcast_vc_query_fields()
				)
			)
  		);
	}
}