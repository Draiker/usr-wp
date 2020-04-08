<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

get_header(); 

// Customizer sidebar settings
$hassidebar =  get_theme_mod( 'wpcast_postsidebar' );

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	// Design override
	$override = get_post_meta($post->ID, 'wpcast_post_template', true); // see custom-types/post/post.php

	switch( $override ){
		case '2': // force sidebar
			$hassidebar = '1';
			break;
		case '1': // force full
			$hassidebar = false;
			break; 
	}


	if( $hassidebar ){
		$post_class = 'wpcast-master wpcast-single wpcast-single__sidebar';
	} else {
		$post_class = 'wpcast-master wpcast-single wpcast-single__nosidebar';
	}

	?>
	<div id="wpcastMaster" <?php post_class( $post_class ); ?>>
		<?php

		/**
		 * ======================================================
		 * Single post header template
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/pageheader-single' ); 


		/**
		 * ======================================================
		 * Content
		 * ======================================================
		 */
		if ( post_password_required() ) {
			get_template_part( 'template-parts/single/protected' );
		} else {
			/**
			 * ======================================================
			 * Customizable layout
			 * ======================================================
			 */
			if( $hassidebar ) {
				get_template_part( 'template-parts/single/single-sidebar' );
			} else {
				get_template_part( 'template-parts/single/single-full' );
			}
		}
		?>
	</div>
	<?php 
endwhile; endif; 

get_footer();