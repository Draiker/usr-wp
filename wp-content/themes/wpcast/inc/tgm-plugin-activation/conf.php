<?php  
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Set page builder as theme extension
 */
add_action( 'vc_before_init', 'qtt_vcSetAsTheme' );
function qtt_vcSetAsTheme() {
  vc_set_as_theme();
}
function wpcast_additional_plugins_url(){
	return 'http://qantumthemes.xyz/t2gconnector-comm/wpcast/tgm-json/';
}
function wpcast_tgm_iid_url(){
	return 'http://qantumthemes.xyz/t2gconnector-comm/wpcast/iid/';
}
function wpcast_connector_url(){
	return 'http://qantumthemes.xyz/t2gconnector-comm/connector-proxy/';
}
function wpcast_connector_documentation_url(){
	return 'https://wpcast.qantumthemes.xyz/manual/';
}
function wpcast_support_message(){
	return 'Please contact us via <a href="https://wpcast.qantumthemes.xyz/manual/knowledge-base/support/" target="_blank">HelpDesk</a> https://wpcast.qantumthemes.xyz/manual/knowledge-base/support/';
}
function wpcast_tgmpa_page(){
	return 'wpcast-install-plugins';
}

/**
 * This is the list of plugins used by TGM
 * It can be extended by our repository list which can be fetched dynamically.
 */
function wpcast_default_plugins_list(){
	return array(
		array(
            'name'				=> 'Give – Donation Plugin and Fundraising Platform',
            'slug'				=> 'give',
		),
		array(
            'name'				=> 'Easy SwipeBox - mobile-friendly Lightbox',
            'slug'				=> 'easy-swipebox',
		),
		array(
            'name'				=> 'MailChimp for WordPress', 
            'slug'				=> 'mailchimp-for-wp'
		),
		array(
            'name'				=> 'MailChimp for WordPress', 
            'slug'				=> 'mailchimp-for-wp'
		),
		array(
			'name'				=> 'Contact Form 7',
			'slug'				=> 'contact-form-7',
		),
		array(
            'name'				=> 'Category Order and Taxonomy Terms Order',
            'slug'				=> 'taxonomy-terms-order',
		),
		array(
            'name'				=> 'Category Order and Taxonomy Terms Order',
            'slug'				=> 'taxonomy-terms-order',
		),
	);
}