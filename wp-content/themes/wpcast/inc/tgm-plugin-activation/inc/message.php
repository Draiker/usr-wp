<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage wpcast
 **/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function wpcast_message_tgm ( ){
	ob_start();
	$item_remote = wpcast_iid();	
    
	$v = wpcast_tgm_pcv( $item_remote );
	
	/**
	 * Display message
	 */
	if(!$v) {
		?>
		<p class="wpcast-welcome__activation-msg">
			<a href="<?php echo admin_url().'themes.php?page=wpcast-welcome'; ?>"><?php esc_html_e( 'Please activate your license', 'wpcast' ); ?></a> 
			<?php esc_html_e("to install the premium plugins and demo contents", 'wpcast') ?>
		</p>
		<?php
	}

	/**
	 * Display the product ID if set in remote
	 */
	if('pending' !== $item_remote) {
		?>
		<p><?php esc_html_e('Item ID: ','wpcast'); echo esc_html( $item_remote ); ?></p>
		<?php
	}

	/**
	 * Display a force refresh link. Can be used every 30 seconds.
	 * Triggers product ID update as well
	 */
    if( get_transient( 'wpcast_tgm_refreshed' ) ){
		?>
		<p><?php esc_html_e("The plugins list is up to date.", 'wpcast') ?></p>
		<?php
	} else {
		$urladmin = admin_url( 'themes.php?page='.wpcast_tgmpa_page() );
		$url = add_query_arg(
	        array(
	        	'tgm-refresh-iid' => '1',
	            'tgmpa-force' => '1',
	            'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
	        ),
	        $urladmin
	    );
		?>
		<p><?php esc_html_e("If you just updated your theme, please ", 'wpcast') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Try to refresh clicking here', 'wpcast' ); ?></a></p>
		<?php
	}

	return ob_get_clean();
}