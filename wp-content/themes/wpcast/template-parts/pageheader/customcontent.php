<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Display the page editor content in the first page of archives
*/


/**
 *
 *  This template can be used also as page template.
 *  In this case we show the page content only if is a page and is page 1
 * 
 */
$paged = wpcast_get_paged();
if(is_page()){
	if($paged == 1){
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$content = the_content();
			if( $content != '' && !is_wp_error( $content ) ){
			?>
			<div class="wpcast-customcontent-firstpage wpcast-spacer-l">
				<div class="wpcast-container">
					<?php the_content(); ?>
				</div>
			</div>
			<?php
			}
		endwhile; endif;
	}
}