<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 *
 * Note: this is not a real post archive, we are making an archive of taxonomies.
 * This means that we are making a custom "loop" which is not a real post loop
 * so don't even add the pagination.
 *
 */

// Design override
$hide = 0;
if( is_page() ){
	$hide = get_post_meta($post->ID, 'wpcast_page_header_hide', true); // see custom-types/page/page.php
}
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
			<h1><?php get_template_part( 'template-parts/pageheader/title' );  ?></h1>
			<p class="wpcast-meta">
				<?php 
				/**
				 * [$wpcast_var_series_ob] object with all the series passed from parent archive-series.php
				 */
				switch ($wpcast_var_series_amount){
					case 0:
						esc_html_e( "No series", 'wpcast' );
						break;
					case 1:
						esc_html_e( "1 Serie", 'wpcast' );
						break;
					default:
						echo esc_html( $wpcast_var_series_amount ).' '; 
						esc_html_e( "Series", 'wpcast' );
				}
				?>
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
<?php  
} // hide end
