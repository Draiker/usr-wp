<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Template Name: Blog grid
*/
get_header(); 
$paged = wpcast_get_paged();
?>
<div id="wpcastMaster" class="wpcast-master">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/pageheader-archive' ); 
	?>
	<?php 
	/**
	 *
	 *  This template can be used also as page template.
	 *  In this case we show the page content only if is a page and is page 1
	 * 
	 */

	get_template_part( 'template-parts/pageheader/customcontent' ); 
	?>
	<div class="wpcast-section">
		<div class="wpcast-container">
			<div id="wpcastLoop" class="wpcast-row">
				
					<?php 
					/**
					 * Loop for archive and archive page
					 */
					if( is_page() ){
						/**
						 * [$args Query arguments]
						 * @var array
						 */
						$args = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'suppress_filters' => false,
							'posts_per_page' => 9,
							'paged' => wpcast_get_paged()
						);
						/**
						 * [$wp_query execution of the query]
						 * @var WP_Query
						 */
						$wp_query = new WP_Query( $args );
						if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$post = $wp_query->post;
							setup_postdata( $post );
							?>
								<div class="wpcast-col wpcast-s12 wpcast-m6 wpcast-l4">
									<?php  
									get_template_part ('template-parts/post/post-vertical');
									?>
								</div>
							<?php  
						endwhile; else: ?>
							<h3><?php esc_html_e("Sorry, nothing here","wpcast")?></h3>
						<?php endif;
						wp_reset_postdata();
					} else {
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							?>
								<div class="wpcast-col wpcast-s12 wpcast-m6 wpcast-l4">
									<?php  
									get_template_part ('template-parts/post/post-vertical');
									?>
								</div>
							<?php  
						endwhile; else: ?>
							<h3><?php esc_html_e("Sorry, nothing here","wpcast")?></h3>
						<?php endif;
					}
					/**
					 * Pagination
					 */
					get_template_part ('template-parts/pagination/part-pagination'); 
					?>
				</div>

			</div>
			
		</div>
	</div>
</div>
<?php 
get_footer();