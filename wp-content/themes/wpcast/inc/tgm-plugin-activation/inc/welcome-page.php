<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage wpcast
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function wpcast_disable_activation_link(){
	ob_start();
	$wpcast_iid = wpcast_iid();
	if(isset($_GET)){
		if( isset( $_GET[ 'wpcast-tgm-remove-act-nonce' ] ) && isset( $_GET[ 'wpcast-tgm-remove-act' ] ) ){
			$nonce = $_GET[ 'wpcast-tgm-remove-act-nonce' ];
			if ( wp_verify_nonce( $nonce, 'remove-act-nonce') ) {
			   	if( isset ($_GET[ 'wpcast-tgm-remove-act-conf' ] ) ){
			   		if( $_GET[ 'wpcast-tgm-remove-act-conf' ] == '2' ){
				   		delete_option( 'wpcast_' . 'ac' . 'k_'. $wpcast_iid );
				   	} else {
				   		esc_html_e( 'Invalid request', 'wpcast' );
				   	}
			   	} else {
				   	/**
					 * 
					 * Allow to disable activation + confirmation
					 * @var [type]
					 * 
					 */
					$urladmin = admin_url( 'themes.php?page=wpcast-welcome' );
					$url = add_query_arg(
				        array(
				        	'wpcast-tgm-remove-act' => '1',
				        	'wpcast-tgm-remove-act-conf' => '2',
				            'wpcast-tgm-remove-act-nonce' => wp_create_nonce( 'remove-act-nonce' )
				        ),
				        $urladmin
				    );
					?>
					<p class="wpcast-welcome__center"><?php esc_html_e("Please confirm to remove activation:", 'wpcast') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'click here', 'wpcast' ); ?></a></p>
					<?php
				}
			} else {
				echo 'Invalid';
			}
		} else {

			/**
			 * 
			 * Allow to disable activation
			 * @var [type]
			 * 
			 */
			$urladmin = admin_url( 'themes.php?page=wpcast-welcome' );
			$url = add_query_arg(
		        array(
		        	'wpcast-tgm-remove-act' => '1',
		            'wpcast-tgm-remove-act-nonce' => wp_create_nonce( 'remove-act-nonce' )
		        ),
		        $urladmin
		    );
			?>
			<p class="wpcast-welcome__center"><?php esc_html_e("To remove the activation from this website and use the purchase code in another website, ", 'wpcast') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'click here', 'wpcast' ); ?></a></p>
			<?php
		}
		return ob_get_clean();
	}
	return;
}







/**
 * wpcast Welcome Page
 * =============================================*/
if ( ! function_exists( 'wpcast_welcome_page_content' ) ) {
	function wpcast_welcome_page_content() {
		
		if(!is_admin()){
			return;
		}
		$wpcast_iid = wpcast_iid( true );
		$msg_rem = wpcast_disable_activation_link();


		if(isset($_POST)){
			if(isset( $_POST['wpcastpcode']) ){
				if ( ! isset( $_POST['nonce_verify_pc'] )   || ! wp_verify_nonce( $_POST['nonce_verify_pc'], 'action_verify' ) ) {
				   	wp_die( esc_html_e('This request comes from an unidentified source. If you should not expect this error, please contact the theme author.', 'wpcast') );
				    exit;
				} else {
					$tpc =  esc_attr( trim( $_POST['wpcastpcode'] ) );
					if (preg_match("/^(\w{8})-((\w{4})-){3}(\w{12})$/", $tpc)) {
						$args = array(
							'method'        => 'POST',
							'timeout'       => 45,
							'redirection'   => 5,
							'httpversion'   => '1.0',
							'blocking'      => true,
							'user-agent' 	=> 'WordPress Connector',
							'headers'       => array(),
							'body'          => array( 
								'ttg_connector_envato_pc' 		=> $tpc,
								'ttg_connector_website_url' 	=> get_site_url(),
								'ttg_connector_iid' 			=> $wpcast_iid,
								'ttg_connector_person'			=> wpcast_person()
							),
						);
						$request = wp_remote_post(  wpcast_connector_url() , $args );
						if( is_wp_error( $request ) ){
							$error_message = $request->get_error_message();
							add_action( 'admin_notices', 'wpcast_plugins_conn__error' );
							return $error_message;
						} else {
							if( $request['response']['code'] == '200' ){
								$p = stripos($request['body'], 'error' );

								if( $p !== false ) {
									$msg = '<span class="wpcast-welcome__msg__error">'.$request['body'].'</span>'. '<br>' . esc_html__('If you are sure that your code is correct, please retry late or use the Support section of the theme documentation. Thanks.', 'wpcast');
								} else {
									$msg = '<span class="wpcast-welcome__msg__success">'.esc_html__('Congratulations! Your purchase code was correctly verified!', 'wpcast').'</span>';
									update_option( 'wpcast_' . 'ac' . 'k_'. $wpcast_iid , esc_attr( trim( $request['body'] ) ) ); // helps against thefts
								}
							} else {
								$msg = esc_html( $request['response']['code'] );
							}
						}				
					}  else {
						$msg = '<span class="wpcast-welcome__msg__error">'.esc_html__('Sorry, this is not a valid purchase code.', 'wpcast').'</span>';
					} 	
				}
			}
		}


		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$title = sprintf(
			esc_html__( 'Thank you for choosing %1$s %2$s', 'wpcast' ),
			$current_theme->name,
			$current_theme->version
		);
		?>
		<div class="wpcast-welcome">
			<div class="wpcast-welcome__container">
				<div class="wpcast-welcome__wrapper">
					<div class="wpcast-welcome__logo">
						<img src="<?php echo esc_url( get_theme_file_uri('/inc/tgm-plugin-activation/img/logo.png' )); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
					</div>
					<h1 class="wpcast-welcome__title"><?php echo esc_html( $title ); ?></h1>
					
					<?php
					$v = wpcast_tgm_pcv( trim( $wpcast_iid ) );
					if( isset( $msg ) ){
						?> <p class="wpcast-welcome__center"> <?php echo wp_kses_post( $msg ); ?></p><?php
					}
					if( true == $v ) {
						?>
						<p class="wpcast-welcome__description">
							<?php
							echo esc_html(
								sprintf(
									esc_html__( 'Very good! The %1$s license is active.', 'wpcast' ),
										$current_theme->name
								)
							);
							?><br>


							<?php  
							/**
							 * Link including a force refresh
							 */
							$urladmin = admin_url( 'themes.php?page='.wpcast_tgmpa_page() );
							$url = add_query_arg(
						        array(
						        	'tgm-refresh-iid' => '1',
						            'tgmpa-force' => '1',
						            'tgmpa-force-nonce2' => wp_create_nonce( 'tgmpa-force-nonce2' ),
						            'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
						        ),
						        $urladmin
						    );


							?>
							<a href="<?php echo esc_url( $url ); ?>"><?php
							echo esc_html(
								sprintf(
									esc_html__( 'Go to %1$s Plugins ', 'wpcast' ),
										$current_theme->name
								)
							);
							?></a>
						</p>
						<?php
						if( isset( $msg_rem ) ){
							echo wp_kses_post( $msg_rem ) ;
						}
					} else {
						?>
						<h4 class="wpcast-welcome__center"><?php esc_html_e( 'Please copy here your purchase code to enjoy automatic plugins installation and demo import' , 'wpcast' ); ?></h4>
						<form class="wpcast-welcome__form" method="post" action="<?php echo admin_url() . 'themes.php?page=wpcast-welcome'; ?>">
							<input type="text" name="wpcastpcode" class="wpcast-pcode" placeholder="<?php esc_attr_e('Your purchase code', 'wpcast'); ?>">
							<?php wp_nonce_field( 'action_verify', 'nonce_verify_pc' ); ?>
							<input type="submit" value="<?php esc_html_e('Verify', 'wpcast'); ?>"  class="wpcast-btn button button-primary">
						</form>
						<p class="wpcast-welcome__center"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'wpcast' ); ?></a></p>
						<?php
					}
					?>
					
				</div>

			</div>
			

			<div class="wpcast-welcome__container">
				<div class="wpcast-welcome__info">
					<h3><?php esc_html_e('Activation process info and privacy', 'wpcast'); ?></h3>
					<ul>
						<li><?php esc_html_e("We will check your purchase code via Envato API", 'wpcast'); ?></li>
						<li><?php esc_html_e('You can activate this license on unlimited localhost / 127.0.0.1 installations and subfolders or subdomains', 'wpcast'); ?></li>
						<li><?php esc_html_e("We don't store any personal information except domain and purchase code.", 'wpcast'); ?></li>
						<li><?php esc_html_e("You can request the deactivation of your purchase code via helpdesk, in order to associate it with another domain.", 'wpcast'); ?></li>
						<li><?php esc_html_e("For deactivations or activation issues: ", 'wpcast'); ?><?php echo wpcast_support_message() ?> <?php esc_html_e("[Mon - Fri 09-18]", 'wpcast'); ?></li>
						<li><strong><?php esc_html_e("The activation is compliant with the Envato license regulations and Themeforest theme requirements.", 'wpcast'); ?></strong></li>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
}


/**
 *  Redirect to Welcome Page after the theme activation
 * =============================================*/
if ( !function_exists( 'wpcast_welcome_switched' ) ) {
	/**
	 * When we switch theme, we save a variable that will force
	 * redirect to the wizard on next page load
	 */
	add_action( 'after_switch_theme', 'wpcast_welcome_switched', 1000 );
	function wpcast_welcome_switched() {
		update_option( 'wpcast_welcome_page', 'installer' );
	}
}


/**
 * Include the Welcome Page in the menu
 * =============================================*/
if ( ! function_exists( 'wpcast_welcome_menupage' ) ) {
	add_action( 'admin_menu', 'wpcast_welcome_menupage' );
	function wpcast_welcome_menupage() {
		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$pid = wpcast_iid();
		if($pid == 'pending'){
			return;
		}

		add_theme_page(
			sprintf( esc_html__( '%s Activation', 'wpcast' ), $current_theme->name ),
			sprintf( esc_html__( '%s Activation', 'wpcast' ),  $current_theme->name ),
			'manage_options',
			'wpcast-welcome',
			'wpcast_welcome_page_content'
		);
	}	
}