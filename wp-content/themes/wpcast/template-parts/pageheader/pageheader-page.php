<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

// Design override
$hide = get_post_meta($post->ID, 'wpcast_page_header_hide', true); // see custom-types/page/page.php
if('1' != $hide){
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
				<h1><?php the_title(); ?></h1>
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
	<?php  
} // hide end
