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

	$feedlink = wpcast_archive_feed_link( $serie_id, $tax );
	
	?>
	<div class="wpcast-scard wpcast-primary-light wpcast-negative">
		<div class="wpcast-scard__con">
			<div class="wpcast-scard__t">
				<h6 class="wpcast-caption"><?php esc_html_e( 'Series', 'wpcast' ); ?></h6>
				<h4 ><a href="<?php echo get_term_link( $serie_id ); ?>" class="wpcast-cutme-t-2 wpcast-negative"><?php echo esc_html( $name ); ?></a></h4>
			</div>
			<div class="wpcast-scard__des">
				<p class="wpcast-intro ">
					<span class="wpcast-cutme-3">
						<?php echo esc_html( $desc ); ?>
					</span>
				</p>
				<?php 
				/**
				 * 
				 * set_query_var: Used to pass variables to template files (actually safest way)
				 * https://developer.wordpress.org/reference/functions/set_query_var/#comment-2285
				 * 
				 */
				set_query_var( 'wpcast_query_id', sanitize_key( $serie_id ) );
				set_query_var( 'wpcast_query_tax', sanitize_key( $tax ) );

				get_template_part( 'template-parts/serie/episodes' ); 

				// remove useless args
				remove_query_arg( 'wpcast_query_id' );
				remove_query_arg( 'wpcast_query_tax' );
				?>				
			</div>
		</div>
		<div class="wpcast-scard__foot wpcast-negative">
			<a href="<?php echo get_term_link( $serie_id ); ?>" class="wpcast-btn wpcast-btn__ghost wpcast-icon-l wpcast-btn__neg"><i class="material-icons">play_arrow</i> <?php echo esc_html( $count ); ?> <?php esc_html_e( 'Episodes', 'wpcast' ); ?></a>
			<?php if( '1' == get_theme_mod( 'display_subscribe', '1'  )){ ?><a href="<?php echo esc_attr( $feedlink ); ?>" target="_blank" class="wpcast-btn wpcast-btn__txt  wpcast-feedlink wpcast-icon-l"><i class="material-icons">rss_feed</i> <?php esc_html_e( 'Follow', 'wpcast' ); ?></a><?php } ?>
		</div>
		<div class="wpcast-bgimg">
			<?php  
			$image_id =  get_term_meta( $serie_id , 'qt_taxonomy_img_id', true );
			if( $image_id ){
				$img = wp_get_attachment_image_src ( $image_id, 'wpcast-card' ); 
				?>
				<img src="<?php echo esc_url( $img[0] ); ?>" width="<?php echo esc_attr( $img[1] ); ?>" height="<?php echo esc_attr( $img[2] ); ?>" alt="<?php esc_attr_e("Serie image", "wpcast"); ?>" />
				<?php
			}
			?>
		</div>
	</div>
	<?php
} 