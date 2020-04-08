<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage wpcast
 **/


/**
 * Parse the updated list of orequired plugins from the private repository
 * @return [json] list of additional plugins from our server 
 */
function wpcast_parse_plugins_update( $theme_version , $stored_optionname, $url ){

	if( !is_admin() ) { return; } // Because TGM class is acting pretty widely

	/**
	 * Overflow prevention
	 * @var integer
	 */
	$update_expiration = 15; // can refresh any 30 seconds
	if( '2' == get_transient( 'wpcast_tgm_refreshed' ) ){
		add_action( 'admin_notices', 'wpcast_tgm_remote_refreshed__message' );
		return( get_option( $stored_optionname ) );
	} else if( '1' == get_transient( 'wpcast_tgm_refreshed' ) ) {
		set_transient( 'wpcast_tgm_refreshed', '2', $update_expiration );
	} else {
		set_transient( 'wpcast_tgm_refreshed', '1', $update_expiration );
	}
	

	/**
	 * Check stuff
	 */
	$iid = wpcast_iid( true ); // force refresh
	if( !wpcast_tgm_pcv( $iid )  ){
		delete_option( $stored_optionname );
		return false;
	}
   
   
	 /**
	 * Make list request
	 */
	
	 $args = array(
		'method'        => 'POST',
		'timeout'       => 45,
		'redirection'   => 5,
		'httpversion'   => '1.0',
		'blocking'      => true,
		'user-agent'    => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:20.0) Gecko/20100101 Firefox/20.0',
		'headers'       => array(),
		'body'          => array(
			'iid'           => trim( esc_attr( $iid ) ),
			'site_host'     => get_site_url(),
			'act_key'       => esc_attr( get_option( 'wpcast_ack_'. esc_attr( $iid ) ) ),
			'theme_version' => $theme_version
		),
	);
	$request = wp_remote_post(  $url , $args );

	// Validate received data
	if( is_wp_error( $request ) ){
		$error_message = $response->get_error_message();
		add_action( 'admin_notices', 'wpcast_plugins_conn__error' );
	} else {
		if( $request['response']['code'] == '200' ){
			$stored_plugins_list_json = $request['body'];
			$new_versioned_array = array(
				'theme_version'     => $theme_version,
				'plugins_list_json' => $stored_plugins_list_json
			);
			$new_plugins_list_versioned_json = json_encode( $new_versioned_array );
			$old = get_option(  $stored_optionname );
			if( $old ){
				delete_option( $stored_optionname );
			}
			if( false == update_option( $stored_optionname , $new_plugins_list_versioned_json ) ){
				add_action( 'admin_notices', 'wpcast_plugins_update_error' );
			}
			add_action( 'admin_notices', 'wpcast_plugins_refresh__success' );
			// prevent flooding
			return( get_option( $stored_optionname ) );
		} else {
			$stored_plugins_list_json = '';
			$new_versioned_array = array(
				'theme_version'     => $theme_version,
				'plugins_list_json' => $stored_plugins_list_json
			);
			$new_plugins_list_versioned_json = json_encode( $new_versioned_array );
			$old = get_option(  $stored_optionname );
			if( $old ){
				delete_option( $stored_optionname );
			}
			if( false == update_option( $stored_optionname , $new_plugins_list_versioned_json ) ){
				add_action( 'admin_notices', 'wpcast_plugins_update_error' );
			}
			add_action( 'admin_notices', function() use ($request){
				?>
				<div class="notice notice-error is-dismissible">
					<p><?php esc_html_e( 'Server message', 'wpcast' ); ?>: <?php print_r( $request['body'] ); ?></p>
				</div>
				<?php
			} );
			return false;
		}
		 
	}
	// if we arrive here, it means it's bad
	return false;
}


/**
 * Get the product ID from the server
 * @return [string] [the ID of the product]
 */
function wpcast_iid( $force_refresh = false ){
 
	$id = get_option('wpcast_product_id');
	$refresh = false;
	if(isset ($_GET)){
		if( array_key_exists('tgm-refresh-iid', $_GET ) ){
			$refresh = true;
		}
	}
	$t_access = get_transient( 'wpcast_product_id_temp' );
	if( $t_access == 'pending' && $refresh != true ){
		return $t_access;
	}
	if( !$id || $id == '' || $refresh == true  || $force_refresh == true){

		delete_transient( 'wpcast_product_id_temp' );
		$current_theme = wp_get_theme();
		$args = array(
			'method'        => 'POST',
			'timeout'       => 45,
			'redirection'   => 5,
			'httpversion'   => '1.0',
			'blocking'      => true,
			'body'          => array( 
				'sssite_host' => get_site_url(),
				'ssdate' => base64_encode(date("m-d-Y H:i:s.u")),
				'sstheme_version'  => esc_attr( $current_theme->version )
			),
		);
		// Perform request for theme ID
		$request = wp_remote_post(  wpcast_tgm_iid_url() , $args);


		$expiration = 3600; // 24 H maximum for the temporary code


		// Validate received data
		if( is_wp_error( $request ) ){
			$error_message = $response->get_error_message();
			// Grant temporary access for one day
			
			set_transient( 'wpcast_product_id_temp', 'pending', $expiration );
			add_action( 'admin_notices', 'wpcast_plugins_id_miss' );
			// Explain the error origin
			add_action( 'admin_notices', function() use ($error_message){
			   ?>
				<div class="notice notice-error is-dismissible">
					<h3><?php esc_html_e( 'Connection error', 'wpcast' ); ?></h3>
					<p><?php echo esc_html( $error_message ); ?></p>
				</div>
				<?php
			} );
		} else {
			if( $request['response']['code'] == '200' ){

				$id = $request['body'];
				if( $id == 'pending' ){
					set_transient( 'wpcast_product_id_temp', 'pending', $expiration );
				} else {
					update_option('wpcast_product_id', $request['body']);
				}
			  
			} else {
				$id = 'pending';
				add_action( 'admin_notices', 'wpcast_plugins_id_miss_server' );
			}
		}
	} 
   
	

	// id can be numeric or pending
	return trim( $id );
}

