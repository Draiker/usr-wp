<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */


/**
 * ======================================================
 * This file adds the background image to archive headers.
 * ------------------------------------------------------
 * There are 3 cases:
 * ------------------------------------------------------
 * - Category image
 * - Page featured (for archive templates)
 * - Default customizer picture
 * ======================================================
 */

$header_image = false;

/**
 * ======================================================
 * 1. CUSTOMIZER FEATURED IMAGE
 * ------------------------------------------------------
 * Get the featured image from the customizer
 * ======================================================
 */
$wpcast_header_bgimg = get_theme_mod('wpcast_header_bgimg', false);
if ( $wpcast_header_bgimg ){
	$header_image = wp_get_attachment_image_src( $wpcast_header_bgimg, 'full' );
}


/**
 * ======================================================
 * 2. CATEGORY COVER
 * ------------------------------------------------------
 * If is a category, priority to the category picture
 * ======================================================
 */
if ( is_tax() || is_category() ){
	$tax = get_queried_object();
	$image_id =  get_term_meta( $tax->term_id , 'qt_taxonomy_img_id', true );
	if( $image_id ){
		$header_image = wp_get_attachment_image_src ( $image_id, 'full' ); 
	}
}


/**
 * ======================================================
 * 3. PAGE FEATURED IMAGE
 * ------------------------------------------------------
 * Otherwise, check for the featured image in case of an archive page
 * ======================================================
 */
if( is_page() || is_single() ){
	$id = get_the_ID();
	if ( has_post_thumbnail( $id ) ){
		$image_id = get_post_thumbnail_id( $id );
		$header_image = wp_get_attachment_image_src( $image_id, 'full' );
	}
}


/**
 * ======================================================
 * 4. USER FEATURED IMAGE
 * ------------------------------------------------------
 * Users may upload custom pictures
 * ======================================================
 */
if( is_author() ){
	$image_id = get_user_meta (  get_the_author_meta('ID') , 'ttg_authorbox_imgid', true );
	if ( $image_id ) { $header_image = wp_get_attachment_image_src( $image_id, 'full' );    } 
}



if( false !== $header_image ){
	$img = $header_image; 
	$wpcast_header_parallax = get_theme_mod( 'wpcast_header_parallax' );
	if($wpcast_header_parallax){
		?>
		<div class="wpcast-bgimg wpcast-bgimg__parallax" data-wpcast-parallax>
			<img data-stellar-ratio="0.1" src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr_e('Background', 'wpcast'); ?>">
		</div>
		<?php
	} else {
		?>
		<div class="wpcast-bgimg">
			<img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr_e('Background', 'wpcast'); ?>">
		</div>
		<?php
	}
	
}



/**
 * ======================================================
 * Background tone color
 * ======================================================
 */


if( get_theme_mod( 'wpcast_header_ol', '1' ) ){
	?> 
		<div class="wpcast-grad-layer"></div>
	<?php
}








