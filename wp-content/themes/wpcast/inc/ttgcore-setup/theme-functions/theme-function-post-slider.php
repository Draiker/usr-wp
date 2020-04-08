<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Theme function for custom parts:
 * Post slider
 *
 * [qt-post-slider post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'wpcast_template_post_slider' )){
	function wpcast_template_post_slider( $atts = array() ){
				
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
			'items_per_page'		=> '10',
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'meta_key'				=> false,
			'offset'				=> 0,

			'exclude'				=> '',

			// Global parameters
			'el_id'					=>  uniqid( 'qt-post-slider-'.get_the_ID() ), // 
			'el_class'				=> '',
			'list_id'				=> false // required for compatibility with WPBakery Page Builder
		), $atts ) );

		$items_per_page = intval($items_per_page);
		if($items_per_page > 10){
			$items_per_page = 10;
		}

		if(false === $list_id){
			$list_id = 'list'.$el_id;
		}
		$list_id = str_replace(':', '-', $list_id);

		$paged = 1;

		include 'helpers/query-prep.php';

		$wp_query = new WP_Query( $args );

		// Max results value, used in pagination
		$max = $wp_query->max_num_pages;

		ob_start();
		if ( $wp_query->have_posts() ) : 

			$all_posts = $wp_query->posts;
			$total = count( $all_posts );
		
			?>
			<div id="<?php echo esc_attr( $list_id ); ?>" class="wpcast-slider__container">
				<div class="wpcast-slider__main">
					
					<?php  
					$n = 1;
					foreach ($all_posts as $mypost ){
						?>
						<input type="radio" name="slides" id="slides_<?php echo esc_attr( $n ); ?>" <?php echo esc_attr( ( $n == 1 )? 'checked' : '' ) ?> />
						<?php 
						$n++;
					}
					?>
					<ul>
					<?php  
					/**
					 * Loop
					 */
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
						setup_postdata( $post );
						?>
						<li>
							<?php  
							get_template_part ('template-parts/slider/slider__item');
							?>
						</li>
						<?php wp_reset_postdata(); ?>
					<?php 
					endwhile; 
					?>
					 </ul>
					<div class="wpcast-slider__arrows">
						<?php  
						$n = 1;
						foreach ($all_posts as $mypost ){
							?>
							<label for="slides_<?php echo esc_attr( $n ); ?>" class="<?php echo esc_attr( ( $n == 1 )? 'wpcast-goto-first' : '' ). esc_attr( ( $n == $total )? 'wpcast-goto-last' : '' ) ?>"></label>
							<?php 
							$n++;
						}
						?>
					</div>
					<div class="wpcast-slider__nav">
						<div>
							<?php  
							$n = 1;
							foreach ($all_posts as $mypost ){
								?>
								<label for="slides_<?php echo esc_attr( $n ); ?>"></label>
								<?php 
								$n++;
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
			
		else: 
			esc_html_e("Sorry, there is nothing for the moment.", "wpcast");
		endif; 
		wp_reset_postdata();
		
		return ob_get_clean();

	}
}


// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-post-slider","wpcast_template_post_slider");
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'wpcast_template_post_slider_vc' );
if(!function_exists('wpcast_template_post_slider_vc')){
	function wpcast_template_post_slider_vc() {
  		vc_map( 
  			array(
				"name" => esc_html__( "Post slider", "wpcast" ),
				"base" => "qt-post-slider",
				"icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/qt-post-slider.png' ),
				"description" => esc_html__( "Responsive slideshow", "wpcast" ),
				"category" => esc_html__( "Theme shortcodes", "wpcast"),
				"params" => array_merge(
					wpcast_vc_query_fields()
				)
			)
  		);
	}
}