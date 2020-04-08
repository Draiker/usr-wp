<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}

?>
<div class="wpcast-pageheader wpcast-primary">
	
	<?php 
	/**
	 * ======================================================
	 * Breadcrumb
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/breadcrumb' ); 
	?>

	<div class="wpcast-pageheader__contents">
		<div class="wpcast-container">

			<?php  
			if( 'audio' ===  get_post_format( $post->ID ) ){
				get_template_part( 'template-parts/shared/actions-pageheader' ); 
			}
			?>

			<p class="wpcast-cats wpcast-small">
				<?php  
				wpcast_postcategories( 1 );
				?>
			</p>
			
			<h1><?php the_title(); ?></h1>
			<p class="wpcast-meta wpcast-small">
				<?php get_template_part( 'template-parts/shared/author-date' );  ?>
				<?php echo wpcast_do_shortcode('[ttg_reaktions-views-raw]' ); ?>
				<?php echo wpcast_do_shortcode('[ttg_reaktions-commentscount-raw]' ); ?>
				<?php echo wpcast_do_shortcode('[ttg_reaktions-loveit-raw]' ); ?>
				<?php echo wpcast_do_shortcode('[ttg_reaktions-rating-raw]' ); ?>
			</p>			
			<hr class="wpcast-decor wpcast-center">
		</div>
	</div>

	<?php 
	/**
	 * ======================================================
	 * Background image
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/image' ); 
	?>



	<?php 
	/**
	 * ======================================================
	 * Breadcrumb
	 * ======================================================
	 */
	get_template_part( 'template-parts/shared/shareball' ); 
	?>

</div>