<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Theme function for custom parts:
 * Category grid
 *
 * Example:
 * [qt-category-grid label="episodes|whatever" hide_empty="0|1" include="all|''|1,2,3" exclude="false|1,2,3" exclude="''|1,2,3" parent="1|0" child_of="false|1,2,3"]
*/

if(!function_exists( 'wpcast_template_category_grid' )){
	function wpcast_template_category_grid( $atts = array() ){
		extract( shortcode_atts( array(
			'amount'				=> '4',
			'label'					=> esc_html__( 'Episodes', 'wpcast' ),
			'hide_empty' 			=> 0, //can be 1, '1' too
			'include' 				=> 'all', //empty string(''), false, 0 don't work, and return empty array
			'exclude' 				=> false, //empty string(''), false, 0 don't work, and return empty array
			'exclude_tree' 			=> '', //empty string(''), false, 0 don't work, and return empty array
			'parent' 				=> '1', // if "1", will show only first level categories
			'child_of' 				=> false,
			'el_id'					=> 'qt-category-grid-'.get_the_ID(), // 
			'grid_id'				=> false, // required for compatibility with WPBakery Page Builder
		), $atts ) );

		// Hide empty categories
		if( $hide_empty == 0 ){
			$args['hide_empty'] = 0;
		} else {
			$args['hide_empty'] = 1;
		}
		// include only these
		if( $include !== 'all' && $include !== '' ){
			$args['include'] = array_map( 'trim', explode(',', $include) );
		}
		// esclude only these
		if( $exclude ){
			$args['exclude'] =  array_map( 'trim', explode(',', $exclude) );
		}
		// esclude all the cats under these IDs
		if( $exclude_tree ){
			$args['exclude_tree'] = array_map( 'trim', explode(',', $exclude_tree) );
		}
		// show only first level
		if( $parent == '1' ){
			$args['parent'] = 0;
		}
		// sub cats of a parent id
		if( $child_of ){
			$args['child_of'] = intval( $child_of );
			unset( $args['parent'] );
		}
		// Unique ID
		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);
		// $cats = get_categories( $args );
		$cats = wpcast_get_sorted_categories( 'id', $args );
		ob_start();
		if( count($cats) > 0 ){
			
		?>

		<div id="<?php echo esc_attr( $grid_id ); ?>" class="wpcast-container wpcast-template-category-grid">
			<div class="wpcast-row">
				<?php
				$amount = intval($amount);
				$index = 0;
				foreach($cats as $var => $val){

					if($index < $amount){

						$catid = $val->term_taxonomy_id; 
						$link = get_category_link( $catid );
						$name = $val->cat_name;
						$category = get_category($catid);
						$count = $category->category_count;
						$image_id =  get_term_meta( $catid , 'qt_taxonomy_img_id', true );
						$tax_color = get_term_meta( $catid , 'qt_taxonomy_color', true );
						?>

						<div class="wpcast-col wpcast-s6 wpcast-m3 wpcast-l3 wpcast-catid-<?php echo esc_attr( $catid ); ?>">
							<div class="wpcast-cat-card">
								<?php
								if( $image_id ){
									$img = wp_get_attachment_image_src ( $image_id, 'medium' ); 
									?><img src="<?php echo esc_url( $img[0] ); ?>" width="<?php echo esc_attr( $img[1] ); ?>" height="<?php echo esc_attr( $img[2] ); ?>" alt="<?php echo esc_attr( $name ); ?>" /><?php
								}
								?>
								<a href="<?php echo esc_url( $link ); ?>">
									<h6 class="wpcast-cutme"><?php echo esc_html( $name ); ?></h6>
									<small><?php echo esc_html( $count ); echo ' '; echo esc_html( $label ); ?></small>
								</a>
								<hr class="wpcast-catid-<?php echo esc_attr( $catid ); ?>">
							</div>
						</div>

						<?php
						$index ++;
					}
				}
				?>
			</div>
		</div>
		<?php
		}
		// Output end
		$output = ob_get_clean();
		return $output;
	}
}


// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-category-grid","wpcast_template_category_grid");
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'wpcast_template_category_grid_vc' );
if(!function_exists('wpcast_template_category_grid_vc')){
function wpcast_template_category_grid_vc() {
  vc_map( array(
	 "name" 		=> esc_html__( "Categories grid", "wpcast" ),
	 "base" 		=> "qt-category-grid",
	 "icon" 		=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/qt-category-grid.png' ),
	 "description" 	=> esc_html__( "Display a grid of categories", "wpcast" ),
	 "category" 	=> esc_html__( "Theme shortcodes", "wpcast"),
	 "params" 		=> array(
	 	array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Max amount", "wpcast" ),
		   "param_name" => "amount",
		   'std'		=> '4' // not translatable, is a dynamic parameter for the query
		),
		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Label for posts count", "wpcast" ),
		   "param_name" => "label",
		   'std'		=> esc_html__( 'Episodes', 'wpcast' )
		),
		array(
			"type" 		=> "dropdown",
			"heading" 	=> esc_html__( "Hide empty categories", "wpcast" ),
			"param_name"=> "hide_empty",
			'std'		=> 0,
			'value' 	=> array( 
				esc_html__("No","wpcast") 	=> 0,
				esc_html__("Yes","wpcast") 	=> "1",
				
				)			
			),
		array(
			"type" 		=> "dropdown",
			"heading" 	=> esc_html__( "Display sub-categories", "wpcast" ),
			"param_name"=> "parent",
			'std'		=> '1',
			'value' 	=> array( 
				esc_html__("No","wpcast") 	=> "1",
				esc_html__("Yes","wpcast") 	=> "0",
				
				)			
			),

		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Include by id, comma separated", "wpcast" ),
		   "param_name" => "include",
		   'std'		=> 'all' // not translatable, is a dynamic parameter for the query
		),
		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Exclude by id, comma separated", "wpcast" ),
		   "param_name" => "exclude",
		   'std'		=> false // not translatable, is a dynamic parameter for the query
		),
		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Exclude entire tree by id, comma separated", "wpcast" ),
		   "param_name" => "exclude",
		),
		array(
		   "type" 		=> "textfield",
		   "heading" 	=> esc_html__( "Child of (ID)", "wpcast" ),
		   "param_name" => "child_of",
		),
	 )
  ) );
}}

