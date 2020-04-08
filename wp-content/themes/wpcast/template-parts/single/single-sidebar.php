<?php
/**
 * Single post with sidebar
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/
?>
<div class="wpcast-section">
	<div class="wpcast-container">
		<div class="wpcast-row">
			<div class="wpcast-col wpcast-s12 wpcast-m12 wpcast-l8">
				<div class="wpcast-paper wpcast-pad wpcast-card">
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
						the_tags('<p class="wpcast-tags"><span>'.esc_html__("Tagged as:  ", "wpcast").'</span>', ',&nbsp; ', '.</p>' );

						/**
						 * Post footer with share
						 */
						get_template_part( 'template-parts/single/part-content-footer' );
						?>
					</div>
					
				</div>



				<?php  
				/**
				 * ==============================================
				 * Author section
				 * ==============================================
				 */

				?>
				<div class="wpcast-author-section wpcast-spacer-m">
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



				<?php  
				/**
				 * ==============================================
				 * Comments section
				 * ==============================================
				 */
				if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) :
					?>
					<div class="wpcast-comments-section wpcast-spacer-m">
						<h3><span><?php esc_html_e("Post comments","wpcast"); ?></span></h3>
						<h5 class="wpcast-caption wpcast-caption__s">
						  <?php 
							/**
							 * [$comments_count amount of comments]
							 * NOTE: not using comments_number because escaping string in comments_number produces empty results.
							 * Need to use a custom function because this field in WordPress is not escaped and is a known vulnerability
							 * as pointed out by Themeforest reviewers.
							 */
							$comments_count = wp_count_comments( $id );
							$comments_count = $comments_count->approved;
							switch($comments_count){
								case 0:
									esc_html_e('This post currently has no comments.', 'wpcast');
									break;
								case 1:
									esc_html_e('This post currently has 1 comment.', 'wpcast');
									break;
								default:
									esc_html_e('This post currently has', 'wpcast'); echo '&nbsp'.esc_html($comments_count).'&nbsp'; esc_html_e('comments.', 'wpcast');
							}
							?>
						</h5>
							<?php  
							/**
							 * Comments template
							 */
							comments_template();
							?>
					</div>
					<?php 
				endif; 

				/* Comments section end ================= */
				?>


				<hr class="wpcast-spacer-m wpcast-hide-on-large-only">
			</div>
			<div class="wpcast-col wpcast-s12 wpcast-m12 wpcast-l4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
