<?php
/**
 * Featured author template part
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/ 


/**
 * @var $wpcast_featuredauthor_id id [<id of the wp author, can be passed using set_query_var]
 */
if( isset( $wpcast_featuredauthor_id ) ){
	$user_id = $wpcast_featuredauthor_id; 
	$avatar = get_avatar_url($user_id );
	$desc = get_the_author_meta( 'description' , $user_id );
	

	
	// Compatibility with ttgcore_authorbox 
	$image_id = false;
	$bg = false;
	if( function_exists( 'ttg_authorbox_plugin_get_version' )){
		$image_id = get_user_meta (  $user_id , 'ttg_authorbox_imgid', true );
		if ( $image_id ) { 
			$avatar = wp_get_attachment_image_src( $image_id, 'wpcast-squared-s' );    
			$avatar = $avatar[0];
			$bg = wp_get_attachment_image_src( $image_id, 'medium' );    
			$bg = $bg[0];
		} 
	}

	?>
	<div class="wpcast-authorbox">
		<div class="wpcast-authorbox__cn">
			<?php if ( $image_id ) { ?>
				<a class="wpcast-authorbox__img wpcast-paper" href="<?php get_author_posts_url( $user_id ); ?>">
				<?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
				</a>
			<?php } else { ?>
				<?php if($avatar){ ?>
					<a class="wpcast-authorbox__img wpcast-paper" href="<?php get_author_posts_url( $user_id ); ?>">
						<img src="<?php echo esc_url($avatar); ?>" alt="<?php esc_attr_e( "Avatar", "wpcast" ); ?>">
					</a>
				<?php } ?>
			<?php } ?>
			<h6 class="wpcast-caption wpcast-caption__xs wpcast-caption__c"><?php esc_html_e( "Author", 'wpcast' ); ?></h6>
			<h4><a href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>" class="qt-authorname qt-capfont"><?php echo get_the_author_meta( 'display_name', $user_id ); ?></a></h4>
			<?php if($desc && $desc !== ''){ ?>
				<p class="wpcast-small">
				<?php echo wp_kses($desc, array() ); ?>
				</p>
			<?php } ?>
			<p>
				<a href="<?php echo get_author_posts_url( $user_id ); ?>" class="wpcast-btn wpcast-btn-primary wpcast-icon-l"><i class="material-icons">list</i> <?php esc_html_e("Archive", 'wpcast'); ?></a>
			</p>
		</div>


		<?php if($bg !== false){ ?>
		<div class="wpcast-bgimg">
			<img src="<?php echo esc_url( $bg ); ?>" alt="<?php esc_attr_e('Background', 'wpcast'); ?>">
		</div>
		<?php } ?>

	</div>
	<?php 
}
