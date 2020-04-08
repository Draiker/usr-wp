<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/
get_header(); 
?>
<div id="wpcastMaster" class="wpcast-master">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/pageheader-search' ); 
	?>
	<div class="wpcast-section wpcast-paper">
		<div id="wpcastLoop" class="wpcast-container">
			<?php 
			/**
			 * Loop for archive and archive page
			 */
			add_filter( 'excerpt_length', 'wpcast_excerpt_length_300', 999 );
			if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/post/post-wide' );
				endwhile; else: ?>
					<h3><?php esc_html_e("Sorry, nothing here","wpcast")?></h3>
				<?php endif;
			add_filter( 'excerpt_length', 'wpcast_excerpt_length', 999 );
			/**
			 * Pagination
			 */
			get_template_part ('template-parts/pagination/part-pagination'); 
			?>
		</div>
	</div>
</div>
<?php 
get_footer();