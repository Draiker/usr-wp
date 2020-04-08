<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Template Name: Page wide
 */

get_header(); 
?>
<div id="wpcastMaster" <?php post_class('wpcast-master wpcast-single'); ?>>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		?>
		
		<div class="wpcast-section wpcast-paper">
			<div class="wpcast-container">
				<div class="wpcast-entrycontent">
				<?php the_content(); ?>
				</div>
			</div>
		</div>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();