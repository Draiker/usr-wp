<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */
?>
<div class="wpcast-pageheader wpcast-primary">
	<div class="wpcast-pageheader__contents">
		<div class="wpcast-container">
			<h1><?php get_template_part( 'template-parts/pageheader/title' );  ?></h1>
			<div class="wpcast-pageheader__search">
				<?php get_search_form(); ?>
			</div>
			<p class="wpcast-meta"><?php get_template_part( 'template-parts/pageheader/meta-archive' );  ?></p>
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
</div>