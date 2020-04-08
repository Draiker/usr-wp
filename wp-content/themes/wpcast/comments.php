<?php
/**
 * @package wpcast
 * @version 1.0.0
 * 
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 *  
 */

if ( post_password_required() )
	return;

if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<!-- ==================================== COMMENTS START ========= -->
	<div id="comments" class="comments-area comments-list wpcast-part-post-comments wpcast-card  wpcast-paper">
		
		<?php if ( have_comments() ) : ?>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav id="comment-nav-below" class="wpcast-comment__navigation wpcast-comment__navigation__top" role="navigation">
					<p class="wpcast-itemmetas wpcast-comment__navlinks">
					<span class="wpcast-comment__previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', "wpcast" ) ); ?></span>
					<span class="wpcast-comment__next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', "wpcast" ) ); ?></span>
					</p>
				</nav>
			<?php endif; // check for comment navigation ?>
				<ol class="wpcast-comment-list">
					<?php
					wp_list_comments( array( 'callback' => 'wpcast_s_comment' ) );
					?>
				</ol>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
					
			<nav id="comment-nav-below" class="wpcast-comment__navigation" role="navigation">
				<p class="wpcast-itemmetas wpcast-comment__navlinks">
				<span class="wpcast-comment__previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', "wpcast" ) ); ?></span>
				<span class="wpcast-comment__next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', "wpcast" ) ); ?></span>
				</p>
			</nav><!-- #comment-nav-below -->
			<hr class="wpcast-spacer-s">
			<?php endif; // check for comment navigation ?>
		<?php endif; // have_comments() ?>
		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="wpcast-comment__closed"><?php esc_html_e( 'Comments are closed.', "wpcast" ); ?></p>
		<?php endif; ?>
		<?php

		/*
		*
		*     Custom parameters for the comment form
		*
		*/
		$required_text = esc_html__('Required fields are marked *',"wpcast");
		if(!isset ($consent) ) { 
			$consent = ''; 
		}
		$args = array(
			'id_form'           => 'wpcast-commentform',
			'id_submit'         => 'wpcast-submit',
			'class_form'		=> 'wpcast-form-wrapper wpcast-commentform',
			'title_reply_to'    => esc_html__( 'Leave a Reply to %s', "wpcast" ),
			'cancel_reply_before' 	=> '<span class="wpcast-commentform__cancelreply">',
			'cancel_reply_after'	=> '</span>',
			'cancel_reply_link' 	=> '<span class="wpcast-btn  wpcast-btn__s wpcast-icon-l"><i class="material-icons">cancel</i> '.esc_html__( 'Cancel', 'wpcast' ).'</span>',
			'label_submit'      => esc_html__( 'Post Comment' ,"wpcast" ),
			'class_submit'		=> 'wpcast-btn wpcast-btn-primary',
			
			'title_reply'       => esc_html__( 'Leave a reply', "wpcast" ),
			'title_reply_before' => '<h4><span>',
			'title_reply_after'   => '</span></h4>',
			
			'must_log_in' => '<h6 class="must-log-in wpcast-mustlogin wpcast-caption wpcast-caption__xs">' .
				esc_html__( 'You must be logged in to post a comment.' , "wpcast").
				' '.'<a href="'.wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ).'">'.esc_html__( 'Log in now' , "wpcast").'</a>'.
				'</h6>',
			'logged_in_as' => '<h6 class="wpcast-caption wpcast-caption__xs">' .
				sprintf(
					esc_html__( 'Logged in as ','wpcast')
					.' <a href="%1$s">%2$s</a>. '
					.'<a href="%3$s" title="'.esc_attr__('Log out of this account','wpcast').'">'
					.' '.esc_html__('Log out?','wpcast')
					.'</a>',
					admin_url( 'profile.php' ),
					$user_identity,
					wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )
				) . '</h6>',
			'comment_notes_before' => '<h6 class="wpcast-caption wpcast-caption__xs">'.esc_html__("Your email address will not be published. Required fields are marked *","wpcast").'</h6>',
			'comment_notes_after' => '',


			'comment_field' 	=>  '
				<div class="wpcast-fieldset">
					<label for="comment" >'.esc_html__("Comment*", 'wpcast').'</label>
					<textarea id="comment" name="comment" required="required"></textarea>
				</div>',

			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author'  => '
					<div class="wpcast-fieldset wpcast-fieldset__half">
						<label for="author" >'.esc_html__("Name*", 'wpcast').'</label>
						<input id="author" name="author" type="text" required="required"  value="' . esc_attr( $commenter['comment_author'] ) .'" />
						
					</div>',
				'email'  => '
					<div class="wpcast-fieldset wpcast-fieldset__half">
						<label for="email" >'.esc_html__("Email*", 'wpcast').'</label>
						 <input id="email" name="email" type="text" required="required"  value="' . esc_attr( $commenter['comment_author_email'] ) .'" />
					</div>',
				'url'  => '
					<div class="wpcast-fieldset">
						<label for="url" >'.esc_html__("Url", 'wpcast').'</label>
						 <input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" />
					</div>'
				)
			),
		);


		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (  comments_open() && post_type_supports( get_post_type(), 'comments' ) ) :?>
				<?php  
				comment_form($args); 
				?>
		<?php endif; ?>

	</div><!-- #comments -->
	<!-- ==================================== COMMENTS END ========= -->
<?php endif; ?>
