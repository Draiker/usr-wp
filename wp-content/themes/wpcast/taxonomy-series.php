<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Template Name: Single serie for Seriously Simple Podcasting
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
	get_template_part( 'template-parts/pageheader/pageheader-serie' ); 
	?>

	<div class="wpcast-section">
		<div class="wpcast-container">


			<?php  
			/**
			 * 
			 * Hero post latest podcast of this serie
			 * -------------------------------------------------
			 */
			if($paged == 1){
				$args = array(	
					'post_type' => 'podcast',
					'posts_per_page' => 1,
					'offset' => 0,
					'tax_query' => array(
				        array(
				            'taxonomy' => get_query_var( 'taxonomy' ),   // taxonomy name
				            'field' => 'slug',           // term_id, slug or name
				            'terms' =>  get_query_var( 'term' )                  // term id, term slug or term name
				        )
				    )

				);
				$query = new WP_query ( $args );
				if ( $query->have_posts() ) { ?>
					<section class="wpcast-featured-post">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php get_template_part ( 'template-parts/post/post-hero' ); ?>
						<?php endwhile; ?>
				  		<?php wp_reset_postdata(); ?>
				  	</section>
					<?php 
				} 
			}
			?>

			<?php  
			/**
			 * 
			 * Display taxonomy description in first archive page 
			 * -------------------------------------------------
			 */
			
			if($paged == 1){
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
				if( isset( $term->description ) ) {
					?>
					<div class="wpcast-col wpcast-s12 wpcast-m12 wpcast-l12 wpcast-text-l">
						<?php echo wpautop( wp_kses_post( $term->description ) ); ?>
						<hr class="wpcast-spacer-s">
					</div>
					<?php
				}
			}
			?>


			<div id="wpcastLoop" class="wpcast-row">
				<?php 
				
				/**
				 * 
				 * Loop
				 * -------------------------------------------------
				 */
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					setup_postdata( $post );
					?>
					<div class="wpcast-col wpcast-s12 wpcast-m6 wpcast-l4">
						<?php get_template_part ( 'template-parts/post/post-vertical' ); ?>
					</div>
					<?php
				endwhile; else: 
					esc_html_e( 'Sorry, this serie is empty', 'wpcast' );
				endif;

				/**
				 * Pagination
				 * -------------------------------------------------
				 */
				get_template_part ('template-parts/pagination/part-pagination'); 
				?>
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();