<?php
/**
 * Single post with sidebar
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/
?>
<div class="wpcast-section wpcast-paper">
	<div class="wpcast-container">
		<div class="wpcast-entrycontent">
			<?php 

			/**
			 * Tracklist
			 * @since  1.2.0
			 * @requires QtMusicPlayer 1.1.0
			 */
			get_template_part( 'template-parts/shared/part-tracklist' );

			/**
			 * Content
			 */
			the_content();

			
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

			/**
			 * Tags
			 */
			the_tags('<p class="wpcast-tags"><span>'.esc_html__("Tagged as:  ", "wpcast").'</span>', ', ', '.</p>' );
			
			/**
			 * Post footer with share
			 */
			get_template_part( 'template-parts/single/part-content-footer' );

			?>
		</div>
	</div>
</div>


<div class="wpcast-section">
	<div class="wpcast-container">
		<?php  
		/**
		 * ==============================================
		 * Author section
		 * ==============================================
		 */
		?>
		<div class="wpcast-author-section">
			<?php get_template_part( 'template-parts/single/part-author' ); ?>
		</div>

		<?php  
		/**
		 * ==============================================
		 * Previous post section
		 * ==============================================
		 */
		?>
		<div class="wpcast-previouspost-section">
			<?php get_template_part( 'template-parts/single/part-previous' ); ?>
		</div>

		<?php  
		/**
		 * ==============================================
		 * Related posts section
		 * ==============================================
		 */
		?>
		<div class="wpcast-relatedpost-section">
			<?php get_template_part( 'template-parts/single/part-related' ); ?>
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
	<div class="wpcast-section wpcast-paper">
		<div class="wpcast-container">
			<div class="wpcast-comments-section ">
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