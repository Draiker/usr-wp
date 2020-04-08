<?php
/*
Package: wpcast
*/
if (!function_exists('wpcast_short_gallery')){
function wpcast_short_gallery($atts){
	extract( shortcode_atts( array(
		'images'    => false,
		'thumbsize' => 'm',
		'linksize'  => 'large'
	), $atts ) );
	if(!function_exists('vc_param_group_parse_atts') ){
		return;
	}
	if(is_array($atts)){
		if(array_key_exists("images", $atts)){
			$images = explode(',', $images);
		}
	}
	ob_start();
	if(count($images) > 0){ 
		?>
			<div class="wpcast-gallery wpcast-s<?php echo esc_attr($thumbsize); ?>">
				<?php
					switch('thumbsize'){
						case 's':
							$imgsize = 'thumbnail';
							break;
						case 'm':
						case 'l':
						default: 
							$imgsize = 'wpcast-squared';
					}
					foreach($images as $image){
						$thumb = wp_get_attachment_image_src($image, $imgsize); 
						$link  = wp_get_attachment_image_src($image, $linksize);
						$thumb = $thumb[0];
						$link  = $link[0];
						?>
						<a href="<?php echo esc_url( $link ); ?>" class="wpcast-gallery__item">
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title($image)); ?>">
						</a>
						<?php
					}
				?>
			</div>
		<?php  
	}
	return ob_get_clean();
}}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode('wpcast-gallery', 'wpcast_short_gallery' );
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'wpcast_short_gallery_vc' );
if(!function_exists('wpcast_short_gallery_vc')){
function wpcast_short_gallery_vc() {
  vc_map( array(
	 "name" 	=> esc_html__( "Gallery", "wpcast" ),
	 "base" 	=> "wpcast-gallery",
	 "icon" 	=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/qt-gallery.png' ),
	 "category" => esc_html__( "Theme shortcodes", "wpcast"),
	 "params" 	=> array(
		array(
			"type" 			=> "attach_images",
			"heading" 		=> esc_html__( "Images", "wpcast" ),
			"param_name" 	=> "images"
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Image size", "wpcast" ),
			"param_name" 	=> "thumbsize",
			"std" 			=> 'm',
			'value' 		=> array(
				esc_html__("Small", "wpcast")	=>"s",
				esc_html__("Medium", "wpcast")	=>'m',
				esc_html__("Large", "wpcast")	=>'l',
			),
		   "description" 	=> esc_html__( "Choose the post template for the items", "wpcast" )
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__( "Linked image size", "wpcast" ),
			"param_name" 	=> "linksize",
			"std" 			=> "large",
			'value' 		=> array(
				esc_html__("Thumbnail", "wpcast")	=>"thumbnail",
				esc_html__("Medium", "wpcast")		=>"medium",
				esc_html__("Large", "wpcast")		=>"large",
				esc_html__("Full", "wpcast")			=> "full"
			),
		   "description" => esc_html__( "Choose the post template for the items", "wpcast" )
		)		
	 )
  ) );
}}
