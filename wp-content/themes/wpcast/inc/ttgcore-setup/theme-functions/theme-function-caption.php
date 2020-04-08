<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Theme function for custom parts:
 * caption
 *
 * Example:
 * [qt-caption title="My Title" size="xs|s|m|l|xl" alignment="center|left"]
*/


if(!function_exists( 'wpcast_template_caption' )){
	function wpcast_template_caption( $atts = array() ){

		ob_start();
	
		extract( shortcode_atts( array(
			'title' => esc_html__( 'Caption Here', 'wpcast' ),
			'cssclass' => '',
			'size' => 'm',
			'alignment' => 'left',
			
		), $atts ) );

		// Output start
		
		$classes = array(  
			$cssclass,
			'wpcast-caption__'.$size
		);

		switch ( $size ){
			case 'xs':
				$tag = 'h6';
				break;
			case 's':
				$tag = 'h5';
				break;
			case 'l':
				$tag = 'h3';
				break;
			case 'xl':
				$tag = 'h2';
				break;
			case 'm':
			default:
				$tag = 'h4';
		}



		if($alignment == 'alignright') {
			$classes[] = 'alignright';
		}
		if($alignment == 'alignleft') {
			$classes[] = 'alignleft';
		}

		if($alignment == 'center') {
			$classes[] = 'center wpcast-center wpcast-caption__c';
		}

		?>
		<div>
			<?php if ( $alignment == 'aligncenter' ) { ?><div class="aligncenter"> <?php } 

				echo '<'.esc_attr( $tag ).' class="wpcast-element-caption wpcast-caption ' . esc_attr( implode( ' ', $classes ) ) . ' ' . ( ( $alignment == 'aligncenter' ) ? 'wpcast-caption__c' : '' ) . ' ">' . esc_html($title) . '</' . esc_attr( $tag ) . '>';

			if ( $alignment == 'aligncenter' ) { ?></div><?php } ?>
		</div>
		<?php 

		// Output end
		
		$output = ob_get_clean();
		
		return $output;
		
	}
}

// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-caption","wpcast_template_caption");
}




/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'wpcast_template_caption_vc' );
if(!function_exists('wpcast_template_caption_vc')){
function wpcast_template_caption_vc() {
  vc_map( array(
	 "name" => esc_html__( "Caption", "wpcast" ),
	 "base" => "qt-caption",
	 "icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/qt-caption.png' ),
	 "description" => esc_html__( "Section caption", "wpcast" ),
	 "category" => esc_html__( "Theme shortcodes", "wpcast"),
	 "params" => array(

		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Text", "wpcast" ),
		   "param_name" => "title",
		   'value' => ''
		),
		array(
			"type" 		=> "dropdown",
			"heading" 	=> esc_html__( "Size", "wpcast" ),
			"param_name"=> "size",
			'std' 		=> 'm',
			'value' 	=> array(
					"Extra small" 	=> "xs",
					"Small" 		=> "s",
					"Medium" 		=> "m",
					"Large" 		=> "l", 
					"Extra large" 	=> 'xl'
				),
			"description" => esc_html__( "Button size", "wpcast" )
		),
		array(
			"type" 		=> "dropdown",
			"heading" 	=> esc_html__( "Alignment", "wpcast" ),
			"param_name"=> "alignment",
			'std' 		=> 'left',
			'value' 	=> array(
					esc_html("Left",'wpcast') 	=> "left",
					esc_html("Center",'wpcast') 	=> "aligncenter",
				),
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Class", "wpcast" ),
		   "param_name" => "cssclass",
		   'value' => '',
		   'description' => esc_html__( "Add an extra class for CSS styling", "wpcast" )
		)
	 )
  ) );
}}

