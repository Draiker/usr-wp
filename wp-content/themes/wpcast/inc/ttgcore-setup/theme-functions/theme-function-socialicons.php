<?php  
/*
Package: wpcast
*/

if(!function_exists('wpcast_template_socialicons_shortcode')){
	function wpcast_template_socialicons_shortcode ($atts){
		extract( shortcode_atts( array(
			'text' => '',
			'link' => '#',
			'size' => 'qt-btn-s',
			'target' => '',
			'style' => 'qt-btn-default',
			'alignment' => '',
			'icon' => '',
			'class' => ''
		), $atts ) );

		if(!function_exists('vc_param_group_parse_atts') ){
			return;
		}
		if($size === 'qt-btn-xxl') {
			$class = $class.' qt-big-icons';
			$size = 'qt-btn-xl';
		}
		ob_start();
		?>
			<?php if ( $alignment == 'aligncenter' ) { ?><p class="aligncenter"> <?php } ?>
					<a href="<?php echo esc_attr($link); ?>" <?php if($target == "_blank"){ ?> target="_blank" <?php } ?> 
					class="wpcast-btn  wpcast-short-socialicon <?php  echo esc_attr($class.' '.$style.' '.$alignment); ?> <?php if($text !='') { echo 'wpcast-icon__l'; } else { echo 'wpcast-btn__r'; } ?>">
					<i class="qt-socicon-<?php echo esc_attr($icon); ?> qt-socialicon"></i><?php if($text) { echo ' '.esc_html($text); } ?></a>
			<?php if ( $alignment == 'aligncenter' ) { ?></p><?php } ?>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("wpcast-short-socicon","wpcast_template_socialicons_shortcode");
}




/* QT Socicons list [This is a configuration list used by Theme Core plugin]
=============================================*/
if(!function_exists('wpcast_template_qt_socicons_array')){
function wpcast_template_qt_socicons_array(){
	return array(
		'android' 			=> 'Android',
		'amazon' 			=> 'Amazon',
		'beatport' 			=> 'Beatport',
		'blogger' 			=> 'Blogger',
		'facebook' 			=> 'Facebook',
		'flickr' 			=> 'Flickr',
		'googleplus' 		=> 'Googleplus',
		'instagram' 		=> 'Instagram',
		'itunes' 			=> 'Itunes',
		'juno' 				=> 'Juno',
		'kuvo' 				=> 'Kuvo',
		'linkedin' 			=> 'Linkedin',
		'trackitdown' 		=> 'Trackitdown',
		'spotify' 			=> 'Spotify',
		'soundcloud' 		=> 'Soundcloud',
		'snapchat' 			=> 'Snapchat',
		'skype' 			=> 'Skype',
		'reverbnation' 		=> 'Reverbnation',
		'residentadvisor' 	=> 'Resident Advisor',
		'pinterest' 		=> 'Pinterest',
		'myspace' 			=> 'Myspace',
		'mixcloud' 			=> 'Mixcloud',
		'rss' 				=> 'RSS',
		'twitter' 			=> 'Twitter',
		'vimeo' 			=> 'Vimeo',
		'vk' 				=> 'VK.com',
		'youtube' 			=> 'YouTube',
		'whatsapp' 			=> 'Whatsapp',
	);
}}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'wpcast_template_socialicons_shortcode_vc' );
if(!function_exists('wpcast_template_socialicons_shortcode_vc')){
function wpcast_template_socialicons_shortcode_vc() {
  vc_map( array(
	"name" 			=> esc_html__( "Social icon button", "wpcast" ),
	"base" 			=> "wpcast-short-socicon",
	"icon" 			=> get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/qt-socialicons.png' ),
	"description" 	=> esc_html__( "Add a social link", "wpcast" ),
	 "category" 	=> esc_html__( "Theme shortcodes", "wpcast"),
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
				"heading" 	=> esc_html__( "Icon", "wpcast" ),
				"param_name"=> "icon",
				'value' 	=>  array_flip(wpcast_template_qt_socicons_array() ),
				"description" => esc_html__( "Choose social icon", "wpcast" )
			),

			array(
				"type" 		=> "dropdown",
				"heading" 	=> esc_html__( "Button style", "wpcast" ),
				"param_name"=> "style",
				'value' 	=> array( 
					esc_html__("Default","wpcast") 	=> "qt-btn-default",
					esc_html__("Primary","wpcast") 	=> "qt-btn-primary",
					esc_html__("Secondary","wpcast") => "qt-btn-secondary",
					esc_html__("Ghost","wpcast") 	=> "qt-btn-ghost",
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
				'description' 	=> 'add an extra class for styling with CSS'
			)
		)
  	));
}}
