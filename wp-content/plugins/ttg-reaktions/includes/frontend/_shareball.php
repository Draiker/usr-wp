<?php
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

add_shortcode( 'ttg_reaktions-shareball', 'ttg_reaktions_shareball');

function ttg_reaktions_shareball(  $atts = array() ){
	ob_start();
	$id = get_the_ID();
	

	/*
	 *	Defaults
	 * 	All parameters can be bypassed by same attribute in the shortcode
	 */
	extract( shortcode_atts( array(

		'class' => '',
		// Global parameters
		'el_id'					=> uniqid( 'ttg-shareball' ), // 
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


	$email_url = 'subject='. get_the_title().'&amp;body=' . esc_attr__('Check out this site', 'ttg-reaktions'). ' '.get_the_permalink()  ;



	?>
	<div id="ttg-reaktionsShareBall" class="ttg-reaktions-shareball <?php echo esc_html( $class ); ?>">
	  	<div class="ttg-reaktions-shareball__menu-btn ttg-reaktions-accent" 
	  	data-ttg-reaktions-activates="parent">
			<i class="material-icons ttg-reaktions-share">share</i>
			<i class="material-icons ttg-reaktions-close">close</i>
	  	</div>
	  	<div class="ttg-reaktions-shareball__icons-wrapper">
		    <div class="ttg-reaktions-shareball__icons">
				<a class="ttg-reaktions-shareball__pinterest qt-popupwindow " href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class="qt-socicon-pinterest"></i></a>
				<a class="ttg-reaktions-shareball__facebook qt-popupwindow " href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="qt-socicon-facebook"></i></a>
				<a class="ttg-reaktions-shareball__twitter qt-popupwindow " href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="qt-socicon-twitter"></i></a>
				<a class="ttg-reaktions-shareball__linkedin qt-popupwindow " href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="qt-socicon-linkedin"></i></a>
				<a class="ttg-reaktions-shareball__whatsapp qt-popupwindow " href="https://wa.me/?text=<?php echo urlencode( get_the_title().' - ' ).get_the_permalink(); ?>"><i class="qt-socicon-whatsapp"></i></a>
				<a class="ttg-reaktions-shareball__tumblr qt-popupwindow " href="<?php echo esc_url( $tumblr_url ); ?>" target="_blank"><i class="qt-socicon-tumblr"></i></a>

				<a class="ttg_reaktions-link ttg-reaktions-shareball__like <?php if(ttg_reaktions_hasAlreadyVoted($id)) { ?>ttg-reaktions-btn-disabled <?php } ?><?php  echo esc_attr($class); ?>" data-post_id="<?php echo esc_attr($id); ?>" href="#">
			        <span class="qtli"><i class="reakticons-heart"></i></span>
			        <span class="qtli count"><?php echo esc_attr($vote_count); ?></span>
			    </a>


				<a class="ttg-reaktions-shareball__email qt-popupwindow " href="mailto:<?php echo esc_url($email_url); ?>" target="_blank"><i class="material-icons">email</i></a>
		    </div>
	  	</div>
	</div>
	<?php 
	return ob_get_clean();
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'ttg_reaktions_shareball_vc' );
if(!function_exists('ttg_reaktions_shareball_vc')){
function ttg_reaktions_shareball_vc() {
  vc_map( array(
	 "name" => esc_html__( "Share Ball", "ttg-reaktions" ),
	 "base" => "ttg_reaktions-shareball",
	 "icon" => ttg_reaktions_plugin_get_url(). '/assets/css/img/shareball.png',
	 "description" => esc_html__( "Sharing ball", "ttg-reaktions" ),
	 "params" => array(
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Class", "ttg-reaktions" ),
		   "param_name" => "class",
		   'value' => '',
		   'description' => esc_html__( "Add an extra class for CSS styling", "ttg-reaktions" )
		)
	 )
  ) );
}}
