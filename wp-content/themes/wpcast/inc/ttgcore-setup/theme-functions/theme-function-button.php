<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Theme function for custom parts:
 * Custom Buttons
 *
 * Example:
 * [qt-button text="Click here" link="http" target="_blank" style="wpcast-btn-primary" alignment="left|aligncenter|right" class="custom-classes"]
*/


if(!function_exists( 'wpcast_template_button' )){
	function wpcast_template_button( $atts = array() ){


		extract( shortcode_atts( array(
			'text' => esc_html__('Click here', 'wpcast'),
			'link' => '#',
			'target' => '',
			'style' => '', // wpcast-btn-primary 
			'alignment' => '',
			'class' => ''
		), $atts ) );


		ob_start();
		
		if( $alignment == 'aligncenter' || $alignment == 'center' ){ ?> <p class="aligncenter"><?php } 
		
		?><a href="<?php echo esc_attr($link); ?>" <?php if($target == "_blank"){ ?> target="_blank" <?php } ?> 
		class="wpcast-btn <?php  echo esc_attr($style.' '.$alignment.' '.$class); ?>"><?php echo esc_html($text); ?></a><?php 

		if($alignment == 'aligncenter'){ ?></p><?php } 

		// Output end
		
		$output = ob_get_clean();
		
		return $output;
		
	}
}

// Set TTG Core shortcode functionality
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-button","wpcast_template_button");
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'wpcast_template_button_vc' );
if(!function_exists('wpcast_template_button_vc')){
function wpcast_template_button_vc() {
  vc_map( array(
	"name" 			=> esc_html__( "Button", "wpcast" ),
	"base" 			=> "qt-button",
	"icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/qt-button.png' ),
	"description" 	=> esc_html__( "Add a button with link", "wpcast" ),
	"category" 		=> esc_html__( "Theme shortcodes", "wpcast"),
	"params" 		=> array(
			array(
				'type' 		=> 'textfield',
				'value' 	=> '',
				'heading' 	=> 'Text',
				'param_name'=> 'text',
			),
			array(
				'type' 		=> 'textfield',
				'value' 	=> '',
				'heading'	=> 'Link',
				'param_name'=> 'link',
			),
			array(
				"type" 		=> "dropdown",
				"heading" 	=> esc_html__( "Link target", "wpcast" ),
				"param_name"=> "target",
				'value' 	=> array( 
					esc_html__("Same window","wpcast") 	=> "",
					esc_html__("New window","wpcast") 	=> "_blank",
					)			
				),

			array(
				"type" 		=> "dropdown",
				"heading" 	=> esc_html__( "Button style", "wpcast" ),
				"param_name"=> "style",
				'value' 	=> array( 
					esc_html__("Default","wpcast") 	=> "wpcast-btn-default",
					esc_html__("Primary","wpcast") 	=> "wpcast-btn-primary",
					esc_html__("Text only","wpcast") => "wpcast-btn__txt"
					)			
				),
			array(
				"type" 		=> "dropdown",
				"heading" 	=> esc_html__( "Alignment", "wpcast" ),
				"param_name"=> "alignment",
				'value' 	=> array( 
								esc_html__("Default","wpcast") 	=> "",
								esc_html__("Left","wpcast") 		=> "alignleft",
								esc_html__("Right","wpcast") 	=> "alignright",
								esc_html__("Center","wpcast") 	=> "aligncenter",
								),
				"description" => esc_html__( "Button style", "wpcast" )
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Class", "wpcast" ),
				"param_name" 	=> "class",
				'value' 		=> '',
				'description' => esc_html__( "Add an extra class for CSS styling", "wpcast" )
			)
		)
  	));
}}
