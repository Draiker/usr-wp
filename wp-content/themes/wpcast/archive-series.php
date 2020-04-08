<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Template Name: Archive series
 *
 * =======================================================
 * Important: 
 * -------------------------------------------------------
 * this is not an items archive but a taxonomy archive. 
 * Terms are used as items.
 * =======================================================
*/

get_header(); 

$series = false;
$seriesname = 'qtserie';
if( function_exists( 'qt_series_custom_series_name' ) ){
	
	$seriesname = qt_series_custom_series_name();
	$series = get_terms( $seriesname , array(
	    'hide_empty' => false,
	) );
}
$paged = wpcast_get_paged();
?>
<div id="wpcastMaster" class="wpcast-master">
	<?php 
	if( !$series || count($series) == 0 ){
		?>
		<div class="wpcast-section">
			<div class="wpcast-container">
				<h3><?php esc_html_e( "There are no series yet", 'wpcast' ); ?></h3>
			</div>
		</div>
		<?php
	} else {

			/**
			 * ======================================================
			 * Archive header template
			 * ======================================================
			 */
			
			/**
			 * 
			 * set_query_var: Used to pass variables to template files (actually safest way)
			 * https://developer.wordpress.org/reference/functions/set_query_var/#comment-2285
			 * 
			 */
			set_query_var( 'wpcast_var_series_amount', count( $series ) );
			get_template_part( 'template-parts/pageheader/pageheader-archive-series' ); 
			remove_query_arg( 'wpcast_var_series_amount' );

			/**
			 *
			 *  This template can be used also as page template.
			 *  In this case we show the page content only if is a page and is page 1
			 * 
			 */

			get_template_part( 'template-parts/pageheader/customcontent' ); 
			?>
			<div class="wpcast-section">
				<div class="wpcast-container">
					<div id="wpcastLoop" class="wpcast-row">
						
							<?php 
							// List of series taxonomy terms
							foreach($series as $serie){

								/**
								 * 
								 * Used to pass variables to template files (actually safest way)
								 * https://developer.wordpress.org/reference/functions/set_query_var/#comment-2285
								 * 
								 */
								set_query_var( 'wpcast_var_serie',  $serie  ); 
								?>
									<div class="wpcast-col wpcast-s12 wpcast-m6 wpcast-l4">
										<?php  
										get_template_part ('template-parts/serie/serie-card');
										?>
									</div>
								<?php  
								remove_query_arg( 'wpcast_var_serie' );

							}

							// No pagination needed
							?>
						</div>

					</div>
					
				</div>
			</div>
		
		<?php 
		}
	?>
</div>
<?php
get_footer();