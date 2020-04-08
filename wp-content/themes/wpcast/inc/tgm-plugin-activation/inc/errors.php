<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage wpcast
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Error notices
 */



function wpcast_plugins_refresh__success() {
	?>
	<div class="notice notice-success is-dismissible">
		<h4><?php esc_html_e( 'The plugins list was successfully updated', 'wpcast' ); ?></h4>
	</div>
	<?php
}


// refreshing too fast
function wpcast_tgm_remote_refreshed__message(){
	?>
	<div class="notice notice-warning is-dismissible">
		<h4><?php esc_html_e( 'Refreshing the page too often. Please wait a a few seconds to avoid overloads.', 'wpcast' ); ?></h4>
	</div>
	<?php
}

// allow refresh
function wpcast_plugins_notice__refresh() {
	$urladmin = admin_url( 'themes.php?page='.wpcast_tgmpa_page() );
	$url = add_query_arg(
		array(
			'tgmpa-force' => '1',
			'tgmpa-force-nonce2' => wp_create_nonce( 'tgmpa-force-nonce2' ),
			'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
		),
		$urladmin
	);
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'wpcast Notice', 'wpcast' ); ?></h3>
		<p><?php esc_html_e( 'The stored list of required plugins is empty, do you want to try again?', 'wpcast' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email providing the Envato purchase code.', 'wpcast' ); ?> <?php echo wpcast_support_message(); ?></p>
		<p><?php esc_html_e( 'If you already tried this, please wait some time, the server can be under maintainance.', 'wpcast' ); ?></p>
		<p><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Try to refresh clicking here', 'wpcast' ); ?></a></p>
	</div>
	<?php
}


// Activation notice
function wpcast_plugins_notice__activationnag() {
	$scr = get_current_screen();
	if( $scr->id !== 'appearance_page_'.wpcast_tgmpa_page() &&  $scr->id !== 'appearance_page_wpcast-welcome' && !wpcast_tgm_pcv( wpcast_iid() ) ){
		?>
		<div class="notice notice-success is-dismissible wpcast-welcome__notice">
			<img src="<?php echo esc_url( get_theme_file_uri( '/inc/tgm-plugin-activation/img/logo.png' ) ); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
			<h3><?php esc_html_e( 'Thanks for choosing wpcast!', 'wpcast' ); ?></h3>
			<p><a href="<?php echo admin_url().'themes.php?page=wpcast-welcome'; ?>"><?php esc_html_e( 'Please activate your license', 'wpcast' ); ?></a> <?php esc_html_e("to install the premium plugins and demo contents", 'wpcast') ?></p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 'wpcast_plugins_notice__activationnag' );





/**
 * Add a one time only admin notice to check the documentation and support
 */
if(!function_exists('wpcast_manual_notice')){
	add_action( 'admin_notices', 'wpcast_manual_link_notice' );
	function wpcast_manual_link_notice() {

		$dismissed = true;
		
		if( !$dismissed && isset( $_POST ) ){
			if(array_key_exists('wpcast_dismiss_docu_link', $_POST) && array_key_exists('wpcast_manual_dismiss', $_POST)){
				if($_POST['wpcast_dismiss_docu_link'] == 'yes'){
					if ( ! wp_verify_nonce( $_POST['wpcast_manual_dismiss'], 'wpcast_action_dismiss_notice' ) ) {
						wp_die('Verification error. The theme security system triggered a block. Please go back to your admin home.');
					} else {
						add_option( 'wpcast_manual_dismissed', '1', '', 'yes' );
						$dismissed = true;
					}
				}
			}
		}
		
		if( !$dismissed ){
			?>
			<div class="notice notice-success wpcast-welcome__notice">
				<img src="<?php echo esc_url( get_theme_file_uri( '/inc/tgm-plugin-activation/img/docs.png' ) ); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
				<form class="wpcast-notice__form" method="post" action="<?php echo admin_url(); ?>">
					<input type="hidden" name="wpcast_dismiss_docu_link" id="wpcast_dismiss_docu_link"  value="yes">
					<?php wp_nonce_field( 'wpcast_action_dismiss_notice', 'wpcast_manual_dismiss' ); ?>
					<h3><?php esc_html_e( 'Theme documentation and support', 'wpcast' ); ?></h3>
					<p><?php esc_html_e("New to this theme? Please check our", 'wpcast') ?> <a href="<?php echo wpcast_connector_documentation_url(); ?>" target="_blank"><?php esc_html_e( 'documentation and support', 'wpcast' ); ?></a>. </p>
					<input type="submit" value="<?php esc_html_e('Dismiss notice for good', 'wpcast'); ?>"  class="wpcast-btn button button-primary">
				</form>
			</div>
			<?php
		}
	}
}







// generic error
function wpcast_plugins_notice__error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'wpcast Notice', 'wpcast' ); ?></h3>
		<p><?php esc_html_e( 'We are experiencing an error while searching for the required plugins. Please make sure your server or firewall are not blocking outgoing requests to our server.', 'wpcast' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the Envato purchase code.', 'wpcast' ); ?> <?php echo wpcast_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'wpcast' ); ?></a></p>
	</div>
	<?php
}
// generic error
function wpcast_plugins_notice__nolist() {
	?>
	<div class="notice notice-warning is-dismissible">
		<h3><?php esc_html_e( 'wpcast Notice', 'wpcast' ); ?></h3>
		<p><?php esc_html_e( 'It seems the list of plugins is actually empty. You can try searching again in a couple of minutes.', 'wpcast' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the Envato purchase code.', 'wpcast' ); ?> <?php echo wpcast_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'wpcast' ); ?></a></p>
	</div>
	<?php
}

// database error
function wpcast_plugins_update_error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'wpcast TGM Notice', 'wpcast' ); ?></h3>
		<p><?php esc_html_e( 'There is some issue while saving data in your database, please check database permissions', 'wpcast' ); ?></p>
		<p><?php esc_html_e( 'If you need support please check the Support section of your manual.', 'wpcast' ); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'wpcast' ); ?></a></p>
	</div>
	<?php
}

// connection error
function wpcast_plugins_conn__error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'wpcast Notice', 'wpcast' ); ?></h3>
		<p><?php esc_html_e( 'Your server is being blocked while searching for plugins. Please make sure your server or firewall are not blocking outgoing requests to our server.', 'wpcast' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email at, providing the Envato purchase code.', 'wpcast' ); ?> <?php echo wpcast_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'wpcast' ); ?></a></p>
	</div>
	<?php
}


// connection error server
function wpcast_plugins_conn__error_server() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'wpcast TGM Notice', 'wpcast' ); ?></h3>
		<p><?php esc_html_e( 'Sorry, our server is temporary unable to retreive the plugins list. You may try in a few minutes or contact our helpdesk at, providing the Envato purchase code.', 'wpcast' ); ?> <?php echo wpcast_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'wpcast' ); ?></a></p>
	</div>
	<?php
}

// product ID missing
function wpcast_plugins_id_miss() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'wpcast TGM Notice', 'wpcast' ); ?></h3>
		<p><?php esc_html_e( 'Your server is not able to parse the product ID. Your firewall or server settings are blocking the request.', 'wpcast' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the Envato purchase code.', 'wpcast' ); ?> <?php echo wpcast_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'wpcast' ); ?></a></p>
	</div>
	<?php
}

// product ID missing
function wpcast_plugins_id_miss_server() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'wpcast TGM Notice', 'wpcast' ); ?></h3>
		<p><?php esc_html_e( 'Sorry, our server is not able to handle your request. You may try in a few minutes or contact our helpdesk, providing the Envato purchase code.', 'wpcast' ); ?> <?php echo wpcast_support_message(); ?></p>
		<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'wpcast' ); ?></a></p>
	</div>
	<?php
}

// Server responding wrong
function wpcast_plugins_conn__error_sever() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Activation required', 'wpcast' ); ?></h3>
		<p><?php esc_html_e( 'Premium plugins require a valid purchase code activation.', 'wpcast' ); ?> <?php echo wpcast_support_message(); ?></p>
	</div>
	<?php
}


// Check if a purchase code is stored and if its structure is valid
function wpcast_tgm_pcv ( $req = false ){
	return true;
}