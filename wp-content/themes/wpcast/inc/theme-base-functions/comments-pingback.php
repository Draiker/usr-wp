<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 * ======================================================
 * Comments and pingbacks.
 * ------------------------------------------------------
 * Used as a callback by wp_list_comments() for 
 * displaying the comments.
 * ======================================================
 */
if ( ! function_exists( 'wpcast_s_comment' ) ) {
	function wpcast_s_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class("comment wpcast-comment__item"); ?>>
				<article id="div-comment-<?php comment_ID(); ?>" class="wpcast-comment__body ">
					<div class="wpcast-comment wpcast-pingback">
						<span class="wpcast-comment__icon"><i class='material-icons'>link</i></span>
						<div class="wpcast-comment__c">
							<?php esc_html_e( 'Pingback:', "wpcast" ); ?> <?php edit_comment_link( "<i class='material-icons'>mode_edit</i>".esc_html__("Edit pingback","wpcast"), '<span class="edit-link">', '</span>' ); ?>
							<?php comment_author_link(); ?> 
						</div>
					</div>
				</article>
		<?php else : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'comment wpcast-comment__item wpcast-depth-'.$depth  : 'comment wpcast-comment__item parent wpcast-depth-'.$depth ); ?>>
				<article id="div-comment-<?php comment_ID(); ?>" class="wpcast-comment__body ">
					<div class="wpcast-comment">
						<a href="<?php echo esc_url( get_comment_author_url() ); ?>" class="wpcast-avatar">
							<?php 
							/** 
							 * User avatar
							 */
							$avatar = get_avatar( $comment, $args['avatar_size'] );
							if ( 0 != $args['avatar_size'] && $avatar != '' ){
								echo get_avatar( $comment, $args['avatar_size'] );
							}else{
								?><i class="fa fa-user"></i><?php
							}
							?>
						</a>
						<p class="wpcast-comment__auth wpcast-itemmetas">
							<?php echo get_comment_author_link(); ?>
							<span class="wpcast-comment__metas"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_attr_x( 'on %1$s', 'Comment date', "wpcast" ), get_comment_date(), get_comment_time() ); ?></a> <?php edit_comment_link( "<i class='material-icons'>mode_edit</i> ".esc_html__("Edit comment","wpcast"), '<span class="edit-link">', '</span>' ); ?></span>
						</p>
						
						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="wpcast-comment__c"><?php esc_html_e( 'Your comment is awaiting moderation.', "wpcast" ); ?></p>
						<?php endif; ?>
						<div class="wpcast-the-content wpcast-comment__c">
							<?php comment_text(); ?>							
						</div>
						<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply wpcast-comment__rlink">',
							'after'     => '</div>',
						) ) );
						?>	
					</div>	
			</article><!-- .comment-body -->
		<?php
		/* Yes, the LI is open and is correct in this way. */
		endif;
	}
}


