<?php
/**
 * Footer for post content in single posts
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/
?>
<?php  

if( function_exists( 'ttg_reaktions_social' ) || function_exists( 'ttg_reaktions_rating' )  || function_exists( 'qtmplayer_downloadlink' ) ){

?>

	<?php 
	if( function_exists( 'qtmplayer_downloadlink' ) ){
		$link = qtmplayer_downloadlink( $post->ID );
		if($link !== '' && $link != false){
		?>
		<div class="wpcast-entrycontent__footer">
			<div class="wpcast-dlbox wpcast-primary-light wpcast-card wpcast-pad aligncenter">
				<h5><?php esc_html_e('Download now', 'wpcast'); ?>: <?php the_title(); ?></h5>
				<p class="wpcast-spacer-xs"><a class="wpcast-btn wpcast-btn-primary wpcast-icon-l" href="<?php echo esc_url( $link ); ?>" target="_blank"><i class="material-icons">file_download</i> <?php esc_html_e('Download', 'wpcast'); ?></a></p>
			</div>
		</div>
		<?php
		}
	}
	?>


	<div class="wpcast-entrycontent__footer">

		<div class="wpcast-entrycontent__share">
			<?php 
			if( function_exists( 'ttg_reaktions_social' ) ){
				echo ttg_reaktions_social();
			}
			?>
		</div>
		<div class="wpcast-entrycontent__rating">
			<?php
			if( function_exists( 'ttg_reaktions_rating' ) ){
				echo ttg_reaktions_rating();
			}
			?>
		</div>
	</div>
<?php  
}
?>
