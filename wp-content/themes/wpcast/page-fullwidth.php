<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Template Name: Page FullWidth
 */

get_header(); 
?>
<div id="wpcastMaster" <?php post_class('wpcast-master wpcast-single wpcast-single__fullwidth'); ?>>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		?>
		
		<div class="wpcast-entrycontent">
		<?php the_content(); ?>
		</div>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();