<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Theme function for custom parts:
 * Authors small cards grid
 *
 * Example:
 * [qt-authors-grid number="6" orderby="post_count|nicename|registered"]
*/


if(!function_exists( 'wpcast_template_authors_small' )){
	function wpcast_template_authors_small( $atts = array() ){
		ob_start();
		$atts = shortcode_atts( array(
			'blog_id'      => $GLOBALS['blog_id'],
			'orderby'      => 'post_count', // nicename // registered
			'order'        => 'DESC', // ASC
			'offset'       => '',
			'search'       => '',
			'number'       => 999, // HOW MANY
			'count_total'  => false,
			'fields'       => 'ID', // not a variable, we just need the IDs
			'who'          => 'subscriber', // subscriber
			'class' => ''
		), $atts );

		$atts[ 'number' ] = intval( $atts['number'] );

		$orderby = $atts[ 'orderby' ];
		if( $orderby == 'nicename' || $orderby == 'email' || $orderby == 'display_name'){
			$atts['order'] = 'ASC';
		}
		$blogusers = get_users( $atts );
		
		// Output start
		?>
		<div class="wpcast-container">
			<div class="wpcast-row">
				<?php
				foreach ( $blogusers as $id ) {
					$post_count = count_user_posts( $id );
					if ( $post_count > 0 ){
						?><div class="wpcast-col wpcast-s6 wpcast-m4 wpcast-l2"><?php  
						set_query_var( 'wpcast_featuredauthor_id', $id );
						get_template_part( 'template-parts/author/author-card' ); 
						remove_query_arg( 'wpcast_var_series_amount' );
						?></div><?php  
					}	
				}
				?>
			</div>
		</div>
		<?php
		// Output end
		$output = ob_get_clean();
		return $output;
	}
}



// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-authors-small","wpcast_template_authors_small");
}


/**
 *  Visual Composer / Page Builder integration
 */
if(!function_exists('wpcast_template_authors_small_vc')){
	add_action( 'vc_before_init', 'wpcast_template_authors_small_vc' );
	function wpcast_template_authors_small_vc() {
		vc_map( 
			array(
				"name" 			=> esc_html__( "Authors small", "wpcast" ),
				"base" 			=> "qt-authors-small",
				"icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/qt-authors-small.png' ),
				"description" 	=> esc_html__( "Grid of authors small cards. Only authors with published posts will be extracted.", "wpcast" ),
				"category" 		=> esc_html__( "Theme shortcodes", "wpcast"),
				"params" 		=> array(
					array(
					   "type" 		=> "dropdown",
					   "heading" 	=> esc_html__( "Order by", "wpcast" ),
					   "param_name" => "orderby",
					   'std'		=> 'post_count',
					   'value' 		=> array(
					   		esc_html__("Post Count", "wpcast")		=> "post_count",
					   		esc_html__("Nicename", "wpcast")		=> "nicename",
							esc_html__("Email", "wpcast")			=> "email",
							esc_html__("Display name", "wpcast")	=> "display_name",
						),
					),
					array(
					   "type" => "textfield",
					   "heading" => esc_html__( "Offset (number)", "wpcast" ),
					   "description" => esc_html__("Number of posts to skip in the database query","wpcast"),
					   "param_name" => "offset"
					),
					array(
			           "type" => "textfield",
			           "heading" => esc_html__( "Quantity", "wpcast" ),
			           "param_name" => "number",
			           "description" => esc_html__( "Number of items to display", "wpcast" )
			        ),
			        array(
			           "type" => "textfield",
			           "heading" => esc_html__( "Search by name", "wpcast" ),
			           "param_name" => "search",
			           "description" => esc_html__( "Use this argument to search users by email address, URL, ID, username or display_name. More info: ", "wpcast" ).'https://codex.wordpress.org/Function_Reference/get_users'
			        ),
			        array(
					   "type" => "textfield",
					   "heading" => esc_html__( "Class", "wpcast" ),
					   "param_name" => "class",
					   'value' => '',
					   'description' => esc_html__( "Add an extra class for CSS styling", "wpcast" )
					)
				)
	 		)
		);
	}
}








