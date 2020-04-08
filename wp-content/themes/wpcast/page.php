<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

get_header(); 
?>
<div id="wpcastMaster" <?php post_class('wpcast-master wpcast-single wpcast-single__nosidebar'); ?>>
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
				<?php 
				$atts_pagelink = array(
					'before'           => '<div><h6 class="wpcast-caption wpcast-caption__s wpcast-pagelinks">',
					'after'            => '</h6></div>',
					'link_before'      => '',
					'link_after'       => '',
					'next_or_number'   => 'next',
					'separator'        => ' ',
					'nextpagelink'     => esc_html__( 'Next page', 'wpcast'),
					'previouspagelink' => esc_html__( 'Previous page', 'wpcast' ),
					'pagelink'         => '%',
					'echo'             => 1
				);
				wp_link_pages( $atts_pagelink ); 
				?>
				</div>
			</div>
		</div>



		<?php  
		/**
		 * ==============================================
		 * Comments section here
		 * ==============================================
		 */
		$comments_count = wp_count_comments( $id );
		$comments_count = $comments_count->approved;
		if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
			<div class="wpcast-section">
				<div class="wpcast-container">
					<div class="wpcast-comments-section">
						<h5><span><?php esc_html_e("Post comments","wpcast"); ?></span> (<?php echo esc_html( $comments_count ); ?>)</h5>
						<?php  
						/**
						 * Comments template
						 */
						comments_template();
						?>
					</div>
				</div>
			</div>
			<?php 
		endif; 

		/* Comments section end ================= */
		?>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();