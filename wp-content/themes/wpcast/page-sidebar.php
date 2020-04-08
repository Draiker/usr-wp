<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Template Name: Page sidebar
 */

get_header(); 
?>
<div id="wpcastMaster" <?php post_class('wpcast-master'); ?>>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		?>
		
		<div class="wpcast-section">
			<div class="wpcast-container">
				<div class="wpcast-row">
					<div id="wpcastContent" class="wpcast-col wpcast-s12 wpcast-m12 wpcast-l8">
						<div class="wpcast-paper wpcast-card wpcast-pad">
							<?php the_content(); ?>
						</div>
					</div>
					<div id="wpcastSidebarContainer" class="wpcast-col wpcast-s12 wpcast-m12 wpcast-l4">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();