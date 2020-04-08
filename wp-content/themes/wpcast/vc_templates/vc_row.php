<?php
/**
 * @package wpcast, VC
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$wpcast_fixedbg = $wpcast_negative = $wpcast_tilecolumn =  $wpcast_container = $el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpcast-stickycont',// added for sticky sidebar feature
	'wpb_row',
	//deprecated
	'vc_row-wpcast',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );


$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
}







if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	if(!get_theme_mod("wpcast_hq_parallax", 0)) {
		$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	}
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}


$parallax_image_src = false;

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
}






/**
 * wpcast customization
 */

if($wpcast_tilecolumn){
	$css_classes[] = 'wpcast-tilecolumn';
}
if($wpcast_negative){
	$css_classes[] = 'wpcast-negative';
}
if ( ! $parallax && $has_video_bg ) {
	// ///////////////////////////////////////// lo metto dentro al parallax $wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}


$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';




/**
 * Custom parallax
 */
$wpcast_parallax_bg = '';
$pbg_attributes = array();
if( $parallax_image_src && !$has_video_bg ){
	$speed = '0.1';
	if( $parallax_speed ){
		$parallax_speed = $parallax_speed / 10;
		$speed = trim( $parallax_speed );
	}
	ob_start();
	?>
		<div class="wpcast-bgimg wpcast-bgimg__parallax" data-wpcast-parallax
		<?php 
			if ($has_video_bg ) {
				?>
				data-vc-video-bg="<?php echo esc_attr( $video_bg_url ); ?>"
				<?php
			} 
		?>
		>
		<img data-stellar-ratio="<?php echo esc_attr( $parallax_speed ); ?>" src="<?php echo esc_url(  $parallax_image_src ); ?>" alt="<?php esc_attr_e('Background', 'wpcast'); ?>">
		</div>
	<?php
	$wpcast_parallax_bg = ob_get_clean();
} else {
	if ( $has_video_bg && isset( $parallax_image_src ) ) {
		$wrapper_attributes[] = 'data-wpcast-video-bg="' . esc_attr( $video_bg_url ) . '"';
		$vid = str_replace('https://www.youtube.com/watch?v=','',$parallax_image_src);
	}
}



/**
 * wpcast customization
 */
$output .= '<div class="wpcast-vc-row-container">';
	if($wpcast_container) {
		$output .=	'<div class="wpcast-container wpcast-rowcontainer-vc">';
	}
		$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
		$output .= wpb_js_remove_wpautop( $content );
		$output .= '</div>';

		
	if($wpcast_container) {
		$output .= '</div>';
	}


	$output .= $wpcast_parallax_bg;

$output .= '</div>';
$output .= $after_output;

echo wpcast_sanitize_content($output);

