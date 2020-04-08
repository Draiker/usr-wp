<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts list
 *
 * Example:
 * [qt-post-list-horizontal post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/

/**
 * 
 * Spacer
 * =============================================
 */
if(!function_exists('wpcast_spacer')){
	function wpcast_spacer ($atts){
		extract( shortcode_atts( array(
			'size' => 'm',
		), $atts ) );
		if($size !== 'xs' && $size !== 's' && $size !== 'm' && $size !== 'l') {
			$size = 'm';
		}
		ob_start();
		?>
			<hr class="wpcast-spacer-<?php echo esc_attr($size); ?>">
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-spacer","wpcast_spacer");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'wpcast_vc_spacer' );
if(!function_exists('wpcast_vc_spacer')){
function wpcast_vc_spacer() {
  vc_map( array(
     "name" => esc_html__( "Responsive spacer", "wpcast" ),
     "base" => "qt-spacer",
     "icon" => get_theme_file_uri( '/inc/ttgcore-setup/theme-functions/img/qt-spacer.png' ),
     "description" => esc_html__( "Spacer", "wpcast" ),
     "category" => esc_html__( "Theme shortcodes", "wpcast"),
     "params" => array(
      	array(
           "type" => "dropdown",
           "heading" => esc_html__( "Size", "wpcast" ),
           "param_name" => "size",
           'std'  => 'm',
           'value' => array("xs", "s", "m", "l"),
           "description" => esc_html__( "Empty spacer separator based on responsive sizes", "wpcast" )
        )
     )
  ) );
}}