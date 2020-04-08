<?php  
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

add_shortcode( 'ttg_reaktions-social', 'ttg_reaktions_social');

/**
 *
 * 
 * [ttg_reaktions_social Creates social sharing functions]
 * @return [html] [social sharing buttons]
 *
 * 
 */

function ttg_reaktions_encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}


function ttg_reaktions_social( $class = false ){
	
	$id = get_the_ID();
	ob_start();
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


	$classes = 'qt-popupwindow ttg-reaktions-btn ttg-btn-share ttg-btn-shareaction '.$class.' tooltipped';
	
	if(get_option( "ttg_reaktions_pinterest", 1 )){ 
		?><a class="<?php echo esc_attr( $classes ); ?> ttg-bg__pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class="qt-socicon-pinterest"></i></a><?php 
	}
	if(get_option( "ttg_reaktions_facebook", 1 )){ 
		?><a class="<?php echo esc_attr( $classes ); ?> ttg-bg__facebook" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="qt-socicon-facebook"></i></a><?php 
	}
	if(get_option( "ttg_reaktions_twitter", 1 )){ 
		?><a class="<?php echo esc_attr( $classes ); ?> ttg-bg__twitter" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="qt-socicon-twitter"></i></a><?php 
	}
	if(get_option( "ttg_reaktions_linkedin", 1 )){ 
		?><a class="<?php echo esc_attr( $classes ); ?> ttg-bg__linkedin" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="qt-socicon-linkedin"></i></a><?php 
	}
	if(get_option( "ttg_reaktions_email", 1 )){ 
		?><a class="<?php echo esc_attr( $classes ); ?> ttg-bg__email" href="mailto:?<?php echo esc_url( $email_url ); ?>" target="_blank"><i class="material-icons">email</i></a><?php 
	}
	if(get_option( "ttg_reaktions_tumblr", 1 )){ 
		?><a class="<?php echo esc_attr( $classes ); ?> ttg-bg__tumblr" href="<?php echo esc_url( $tumblr_url ); ?>" target="_blank"><i class="qt-socicon-tumblr"></i></a><?php 
	}
	if(get_option( "ttg_reaktions_whatsapp", 1 )){ 
		?><a class="<?php echo esc_attr( $classes ); ?> ttg-bg__whatsapp" href="https://wa.me/?text=<?php echo urlencode( get_the_title().' - ' ).get_the_permalink(); ?>"><i class="qt-socicon-whatsapp"></i></a><?php 
	}

	return ob_get_clean();
}



function ttg_reaktions_social_sc(){
	ob_start();
	?>
	<div class="ttg-reaktions-all">

	<?php echo ttg_reaktions_social(); ?>

	</div>
	<?php  
	return ob_get_clean();
}



