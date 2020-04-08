<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

get_header(); 
?>
<div id="wpcastMaster" <?php post_class('wpcast-master'); ?>>
	<div class="wpcast-section wpcast-paper">
		<div class="wpcast-container wpcast-notfound404">
			<h2><?php esc_html_e('404', 'wpcast'); ?></h2>
			<h4><?php esc_html_e('Page Not Found', 'wpcast'); ?></h4>
			<?php  
			/**
			 * ======================================================
			 * Quick menu
			 * ======================================================
			 */
			?>
			<ul class="wpcast-menubar">
				<?php 
				/**
				*  Footer left
				*  =============================================
				*/
				if ( has_nav_menu( 'wpcast_menu_notfound' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'wpcast_menu_notfound',
						'depth' => 1,
						'container' => false,
						'items_wrap' => '%3$s'
					));
				}
				?>
			</ul>

			<?php get_search_form(); ?>

		</div>
	</div>
</div>
<?php 
get_footer();