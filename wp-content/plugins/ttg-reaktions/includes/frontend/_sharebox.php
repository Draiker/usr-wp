<?php
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

add_shortcode( 'ttg_reaktions-sharebox', 'ttg_reaktions_sharebox');

function ttg_reaktions_sharebox(  $atts = array() ){
	ob_start();
	$id = get_the_ID();
	

	/*
	 *	Defaults
	 * 	All parameters can be bypassed by same attribute in the shortcode
	 */
	extract( shortcode_atts( array(

		'class' => '',
		'classbtn' => '',
		// Global parameters
		'el_id'					=> uniqid( 'ttg-sharebox' ), // 
		'el_class'				=> '',
		'grid_id'				=> false // required for compatibility with WPBakery Page Builder
	), $atts ) );


	$vote_count = get_post_meta($id, "ttg_reaktions_votes_count", true);

	// Get the featured image.
	if ( has_post_thumbnail() ) {
		$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$thumbnail    = $thumbnail_id ? current( wp_get_attachment_image_src( $thumbnail_id, 'large', true ) ) : '';
	} else {
		$thumbnail = null;
	}

	// Generate the Twitter URL.
	$twitter_url = 'http://twitter.com/share?text=' . get_the_title() . '&url=' . get_the_permalink() . '';

	// Generate the Facebook URL.
	$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&title=' . get_the_title() . '';

	// Generate the LinkedIn URL.
	$linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink() . '&title=' . get_the_title() . '';

	// Generate the Pinterest URL.
	$pinterest_url = 'https://pinterest.com/pin/create/button/?&url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $thumbnail ) . '';

	// Generate the Tumblr URL.
	$tumblr_url = 'https://tumblr.com/share/link?url=' . get_the_permalink() . '&name=' . get_the_title() . '';


	$email_url = 'subject='. get_the_title().'&amp;body=' . esc_html__('Check out this site', 'ttg-reaktions'). ' '.get_the_permalink()  ;



	
	?>
	<div class="ttg-reaktions-sharebox <?php echo esc_html( $class ); ?>">
		<a class="ttg-reaktions-sbtn___pinterest qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class="qt-socicon-pinterest"></i></a>
		<a class="ttg-reaktions-sbtn___facebook qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="qt-socicon-facebook"></i></a>
		<a class="ttg-reaktions-sbtn___twitter qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="qt-socicon-twitter"></i></a>
		<a class="ttg-reaktions-sbtn___linkedin qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="qt-socicon-linkedin"></i></a>
		<a class="ttg-reaktions-sbtn___whatsapp qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="https://wa.me/?text=<?php echo urlencode( get_the_title().' - ' ).get_the_permalink(); ?>" ><i class="qt-socicon-whatsapp"></i></a>
		<a class="ttg-reaktions-sbtn___tumblr qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $tumblr_url ); ?>" target="_blank"><i class="qt-socicon-tumblr"></i></a>
		<a class="ttg_reaktions-link ttg-reaktions-sbtn___like <?php if(ttg_reaktions_hasAlreadyVoted($id)) { ?>ttg-reaktions-btn-disabled <?php } ?><?php echo esc_html( $classbtn ); ?>" data-post_id="<?php echo esc_attr($id); ?>" href="#"><span class="qtli"><i class="reakticons-heart"></i></span></a>
		<a class="ttg-reaktions-sbtn___email qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="mailto:<?php echo esc_url($email_url); ?>" target="_blank"><i class="material-icons">email</i></a>
	
	</div>
	<?php 
	return ob_get_clean();
}

