<?php
/**
 * 
 * Template part for displaying a serie taxonomy card containin its posts
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 *
 * $wpcast_var_serie passed from parent archive-series.php
 */
if( is_object($wpcast_var_serie)){

	$serie_id 		= $wpcast_var_serie->term_id;
	$name 		= $wpcast_var_serie->name;
	$slug 		= $wpcast_var_serie->slug;
	$desc 		= $wpcast_var_serie->description;
	$count 		= $wpcast_var_serie->count;
	$tax 		= $wpcast_var_serie->taxonomy;

	$link = get_term_link( $serie_id );
	?>
	<a href="<?php echo esc_url( $link ); ?>" class="wpcast-scard-s wpcast-card">
		
		<?php  
		$image_id =  get_term_meta( $serie_id , 'qt_taxonomy_img_id', true );
		if( $image_id ){
			$img = wp_get_attachment_image_src ( $image_id, 'wpcast-card' ); 
			?>
			<img src="<?php echo esc_attr( $img[0] ); ?>" class="wpcast-bgimg" width="<?php echo esc_attr( $img[1] ); ?>" height="<?php echo esc_attr( $img[2] ); ?>" alt="<?php esc_attr_e("Serie image", "wpcast"); ?>" />
			<?php
		}
		?>
		<div class="wpcast-scard-s__c">
			<h6 class="wpcast-cutme-t-2"><?php echo esc_html( $name ); ?></h6>
			<p><?php echo esc_html( $count ); ?> <?php esc_html_e( 'Episodes', 'wpcast' ); ?></p>
		</div>
	</a>
	<?php
} 