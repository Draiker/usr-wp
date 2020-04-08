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

if( isset($wpcast_featuredauthor_id) ){
	$user_id = $wpcast_featuredauthor_id; 
	$avatar = get_avatar_url($user_id );

	// Compatibility with ttgcore_authorbox 
	if( function_exists( 'ttg_authorbox_plugin_get_version' )){

		$image_id = get_user_meta (  $user_id , 'ttg_authorbox_imgid', true );
		if ( $image_id ) { 
			$avatar = wp_get_attachment_image_src( $image_id, 'wpcast-squared-s' );    
			$avatar = $avatar[0];
		} 
	}

	?>
	<div class="wpcast-authorbox wpcast-authorbox__card">
		<a class="wpcast-authorbox__img" href="<?php echo get_author_posts_url( $user_id ); ?>">
			<?php if($avatar){ ?>
				<img src="<?php echo esc_url($avatar); ?>" alt="<?php esc_attr_e( "Avatar", "wpcast" ); ?>">
			<?php } ?>
		</a>
		<div class="wpcast-authorbox__card__bg">
			<?php if($avatar){ ?>
				<img src="<?php echo esc_url($avatar); ?>" alt="<?php esc_attr_e( "Avatar", "wpcast" ); ?>">
			<?php } ?>
		</div>
		<h6>
			<a href="<?php echo  get_author_posts_url( $user_id  ); ?>" class="wpcast-cutme"><?php echo get_the_author_meta( 'display_name', $user_id ); ?></a>
		</h6>
		<p class="wpcast-caption wpcast-caption__s wpcast-caption__c">
			<?php echo esc_html( get_the_author_meta( 'user_title', $user_id ) ? get_the_author_meta( 'user_title', $user_id ) : esc_html__('Author', 'wpcast') ) ; ?>
		</p>
	</div>
	<?php 
}
