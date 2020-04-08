<?php  

/* User special fields
=============================================*/
$qt_user_social = array(

	"picture" => array(
					'label' => esc_attr__( 'Profile picture URL (2550px)' , "ttg-core" ),
					'icon' => "qticon-twitter" )
	,"thumbnail" => array(
					'label' => esc_attr__( 'Thumbnail (250px x 250px)' , "ttg-core" ),
					'icon' => "qticon-twitter" )

	,"twitter" => array(
					'label' => esc_attr__( 'Twitter Url' , "ttg-core" ),
					'icon' => "qticon-twitter" )
	,"facebook" => array(
					'label' => esc_attr__( 'Facebook Url' , "ttg-core" ),
					'icon' => "qticon-facebook" ) 
	,"google" => array(
					'label' => esc_attr__( 'Google Url' , "ttg-core" ),
					'icon' => "qticon-google" )
	,"flickr" => array(
					'label' => esc_attr__( 'Flickr Url' , "ttg-core" ),
					'icon' => "qticon-flickr" )
	,"pinterest" => array(
					'label' => esc_attr__( 'Pinterest Url' , "ttg-core" ),
					'icon' => "qticon-pinterest" )
	,"amazon" => array(
					'label' => esc_attr__( 'Amazon Url' , "ttg-core" ),
					'icon' => "qticon-amazon" )
	,"github" => array(
					'label' => esc_attr__( 'Github Url' , "ttg-core" ),
					'icon' => "fa fa-github-alt" )
	,"soundcloud" => array(
					'label' => esc_attr__( 'Soundcloud Url' , "ttg-core" ),
					'icon' => "qticon-cloud" )
	,"vimeo" => array(
					'label' => esc_attr__( 'Vimeo Url' , "ttg-core" ),
					'icon' => "qticon-vimeo" )
	,"tumblr" => array(
					'label' => esc_attr__( 'Tumblr Url' , "ttg-core" ),
					'icon' => "qticon-tumblr" )
	,"youtube" => array(
					'label' => esc_attr__( 'Youtube Url' , "ttg-core" ),
					'icon' => "qticon-youtube" )
	,"wordpress" => array(
					'label' => esc_attr__( 'WordPress Url' , "ttg-core" ),
					'icon' => "qticon-wordpress" )
	,"wikipedia" => array(
					'label' => esc_attr__( 'Wikipedia Url' , "ttg-core" ),
					'icon' => "qticon-wikipedia" )
	,"instagram" => array(
					'label' => esc_attr__( 'Instagram Url' , "ttg-core" ),
					'icon' => "qticon-instagram" )
);

global $qt_user_social;
if ( ! function_exists( 'ttgcore_modify_contact_methods' ) ) {
function ttgcore_modify_contact_methods( $profile_fields ) {
	global $qt_user_social;
	foreach ( $qt_user_social as $q => $v ){
		$profile_fields[$q] = $v['label'];
	}
	return $profile_fields;
}}
add_filter('user_contactmethods', 'ttgcore_modify_contact_methods');

/*
*	Saving the user meta
*/
add_action( 'personal_options_update', 'ttgcore_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'ttgcore_save_extra_profile_fields' );
function ttgcore_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    global $qt_user_social;
	foreach ( $qt_user_social as $q => $v ){
		 update_user_meta( $user_id, $q , esc_url($_POST[$q]), esc_url(get_the_author_meta( $q , $user_id )) );
	}
}







