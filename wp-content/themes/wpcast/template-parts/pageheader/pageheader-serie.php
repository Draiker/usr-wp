<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

?>
<div class="wpcast-pageheader wpcast-pageheader__serie wpcast-primary">

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
			<?php if( '1' == get_theme_mod( 'display_subscribe', '1'  )){ ?><p><a class="wpcast-btn wpcast-feed-btn wpcast-icon-l" href="<?php echo wpcast_archive_feed_link() ; ?>" rel="nofollow" ><i class="material-icons">rss_feed</i><?php esc_html_e("Subscribe", 'wpcast'); ?></a></p><?php } ?>
			<?php if(isset( $term->name )){ ?>
				<h1><?php echo esc_html( $term->name ); ?></h1>
			<?php } ?>
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