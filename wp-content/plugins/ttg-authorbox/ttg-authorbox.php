<?php
/*
Plugin Name: Themes2Go Author Box
Plugin URI: http://themes2go.xyz
Description: Add author custom fields and display a nice author box below the posts
Version: 1.1.1
Author: Themes2Go
Author URI: http://themes2go.xyz
Text Domain: ttg-authorbox
Domain Path: /languages
*/


/**
 *
 *	The plugin textdomain
 * 	=============================================
 */
if(!function_exists('ttg_authorbox_load_plugin_textdomain')){
	add_action( 'plugins_loaded', 'ttg_authorbox_load_plugin_textdomain' );
	function ttg_authorbox_load_plugin_textdomain() {
		load_plugin_textdomain( 'ttg-authorbox', FALSE, plugin_dir_path( __FILE__ ) . 'languages' );
	}
}



/* Returns current plugin version.
=============================================*/
if(!function_exists('ttg_authorbox_plugin_get_version')){
function ttg_authorbox_plugin_get_version() {
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}}



/**
 * ===============================================================================================
 *
 * Backend
 *
 * ===============================================================================================
 */



/**
 *
 *	Helpers
 * 
 */
require plugin_dir_path( __FILE__ ) . '/includes/author_image_uploader.php';





/* User special fields
=============================================*/
function ttg_authorbox_get_user_social(){
	$ttg_authorbox_user_social = array(
		"user_title" => array(
						'label' => esc_html__( 'Title' , "ttg-authorbox" )
		)						
		,"twitter" => array(
						'label' => esc_html__( 'Twitter Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-twitter" )
		,"facebook" => array(
						'label' => esc_html__( 'Facebook Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-facebook" ) 
		,"google" => array(
						'label' => esc_html__( 'Google Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-google" )
		,"flickr" => array(
						'label' => esc_html__( 'Flickr Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-flickr" )
		,"pinterest" => array(
						'label' => esc_html__( 'Pinterest Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-pinterest" )
		,"amazon" => array(
						'label' => esc_html__( 'Amazon Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-amazon" )
		,"github" => array(
						'label' => esc_html__( 'Github Url' , "ttg-authorbox" ),
						'icon' => "fa fa-github-alt" )
		,"soundcloud" => array(
						'label' => esc_html__( 'Soundcloud Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-cloud" )
		,"vimeo" => array(
						'label' => esc_html__( 'Vimeo Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-vimeo" )
		,"tumblr" => array(
						'label' => esc_html__( 'Tumblr Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-tumblr" )
		,"youtube" => array(
						'label' => esc_html__( 'Youtube Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-youtube" )
		,"wordpress" => array(
						'label' => esc_html__( 'WordPress Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-wordpress" )
		,"wikipedia" => array(
						'label' => esc_html__( 'Wikipedia Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-wikipedia" )
		,"instagram" => array(
						'label' => esc_html__( 'Instagram Url' , "ttg-authorbox" ),
						'icon' => "qt-socicon-instagram" )
	);
	return $ttg_authorbox_user_social;
}


/* Modify contact methods
=============================================*/
global $ttg_authorbox_user_social;
if ( ! function_exists( 'ttg_authorbox_modify_contact_methods' ) ) {
function ttg_authorbox_modify_contact_methods( $profile_fields ) {
	$social = ttg_authorbox_get_user_social();
	foreach ( $social as $q => $v ){
		
			$profile_fields[$q] = $v['label'];
		
	}
	return $profile_fields;
}}
add_filter('user_contactmethods', 'ttg_authorbox_modify_contact_methods');

/* Saving the user meta
=============================================*/
add_action( 'personal_options_update', 'ttg_authorbox_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'ttg_authorbox_save_extra_profile_fields' );
function ttg_authorbox_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    $social = ttg_authorbox_get_user_social();
	foreach ( $social as $q => $v ){
		 update_user_meta( $user_id, $q , esc_url($_POST[$q]), esc_url(get_the_author_meta( $q , $user_id )) );
	}
}






/**
 * ===============================================================================================
 *
 * Frontend
 *
 * ===============================================================================================
 */


/* Frontend: create user social icons
=============================================*/
if(!function_exists('ttg_authorbox_user_social_icons')) {
function ttg_authorbox_user_social_icons($id = null){
	if(null === $id){
		echo 'No id';
		return;
	}

	$ttg_authorbox_user_social = ttg_authorbox_get_user_social();
	foreach($ttg_authorbox_user_social as $var => $val){
		if( array_key_exists('icon', $v) ){ // Exclude fields without Icon attribute
			$link = get_the_author_meta( $var , $id);
			if(!empty($link)){
				?>
				<a href="<?php echo esc_url($link); ?>" class="qt-social-author"><i class="<?php echo esc_attr($val['icon']); ?>"></i></a>
				<?php
			}
		}
	}
}}

/* CSS and Js loading
=============================================*/
if(!function_exists('ttg_authorbox_files_inclusion')){
function ttg_authorbox_files_inclusion() {
	wp_enqueue_style( "qt-socicon", plugins_url('assets/font/qt-socicon/styles.css' , __FILE__), false, '1.0', "all" );
}}
add_action( 'wp_enqueue_scripts', 'ttg_authorbox_files_inclusion', 500 );


/* Author box output
=============================================*/
function ttg_authorbox_display(){
	ob_start();
	$user_id = get_the_author_meta('ID');
	$avatar = get_avatar_url($user_id );
	$desc = get_the_author_meta( 'description' );

	// Custom image?
	
	$image_id = get_user_meta ( $user_id, 'ttg_authorbox_imgid', true );
	if ( $image_id ) {  $avatar = wp_get_attachment_thumb_url ( $image_id, 'post-thumbnail' );    } 


	?>
	<div class="ttg-authorbox-author">
		<?php 
		/** 
		 * User avatar
		 */
		if($avatar){ 
			?>
			<a class="ttg-authorbox-author__t" href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>">
				<img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr("Avatar", "ttg-authorbox"); ?>">
			</a>
			<?php 
		} 
		?>
		<h6 class="ttg-authorbox-author__n">
			<a href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>"><?php echo get_the_author(); ?></a>
		</h6>
		<span class="ttg-authorbox-author__soc">
			<?php ttg_authorbox_user_social_icons( $user_id ); ?>
		</span>
		<p class="ttg-authorbox-author__b">
			<?php echo wp_kses( $desc, array() ); ?>
		</p>
	</div>
	<?php
	return ob_get_clean();
}

