<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/


/**
 * ======================================================
 * Custom password protected form
 * ------------------------------------------------------
 * Display the post password form using custom HTML
 * ======================================================
 */
if (!function_exists( 'wpcast_password_form' )){
	add_filter( 'the_password_form', 'wpcast_password_form' );
	function wpcast_password_form() {
		global $post;
		$random_inputid = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		ob_start();
		?>
		<div class="wpcast-form-wrapper">
			<form class="wpcast-form" method="post" action="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?action=postpass">
				<div class="wpcast-row">
					<div class="wpcast-col wpcast-s12 wpcast-m8 wpcast-l10">
						<div class="wpcast-fieldset">
							<input name="post_password" id="<?php echo esc_attr( $random_inputid ); ?>" type="password" placeholder="<?php esc_attr_e( 'Password', 'wpcast' ); ?>" /><label for="post_password"><?php esc_html_e( 'Password', 'wpcast' ); ?></label>
						</div>
					</div>
					<div class="wpcast-col wpcast-s12 wpcast-m4 wpcast-l2">
						<input type="submit" name="<?php esc_attr_e( "Submit", "wpcast" ); ?>" class="wpcast-btn wpcast-btn__l wpcast-btn__full wpcast-btn-primary" value="<?php esc_attr_e( "Submit", "wpcast" ); ?>" />
					</div>
				</div>
			</form>
		</div>
		<?php
		return ob_get_clean();
	}
}
