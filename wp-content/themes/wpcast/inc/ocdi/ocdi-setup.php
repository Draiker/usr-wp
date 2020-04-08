<?php
/**
 * 
 * @package WordPress
 * @subpackage One Click Demo Import
 * @subpackage wpcast
 * @version 1.0.0
 * Settings for the demo import
 * https://wordpress.org/plugins/one-click-demo-import/
 * 
*/

add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );



/**
 * Disable thumbnail generation during import or it takes ages
 */
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

/**
 * Customize the popup width
 */
function qantumthemes_ocdi_confirmation_dialog_options ( $options ) {
    return array_merge( $options, array(
        'width'       => 400,
        'dialogClass' => 'wp-dialog',
        'resizable'   => false,
        'height'      => 'auto',
        'modal'       => true,
    ) );
}
add_filter( 'pt-ocdi/confirmation_dialog_options', 'qantumthemes_ocdi_confirmation_dialog_options', 10, 1 );


function wpcast_ocdi_import_files() {
	$url = 'http://qantumthemes.xyz/public_plugins/wpcast/demodata-wpcast-20190709/';
	return array(
		array(
			'import_file_name'           => 'Classic',
			'categories'                 => array( 'Multi author', 'Default' ),
			'import_file_url'            => $url.'demo1/wpcastdemo.wordpress.2019-02-04.xml',
			'import_widget_file_url'     => $url.'demo1/wpcast.qantumthemes.xyz-demo-widgets.wie',
			'import_customizer_file_url' => $url.'demo1/wpcast-child-export.json',
			'import_notice'              => esc_html__( 'IMPORTANT NOTICE BEFORE PROCEEDING: Please be sure you actived the Wpcast Child theme for an optimal result, or the customizations won\'t be imported. Also, please, make sure all the required plugins are activated. All demo content will be imported under the current user.', 'wpcast' ),
			'preview_url'                => 'https://wpcast.qantumthemes.xyz/demo/',
			'import_preview_image_url'	 => $url.'demo1/preview.jpg',
		),
		array(
			'import_file_name'           => 'Travel',
			'categories'                 => array( 'Single author', 'Travel', 'Maps' ),
			'import_file_url'            => $url.'demo2/demo2-wpcast.WordPress.2019-07-09.xml',
			'import_widget_file_url'     => $url.'demo2/wpcast.qantumthemes.xyz-demo2-widgets.wie',
			'import_customizer_file_url' => $url.'demo2/demo2-wpcast-child-export.json',
			'import_notice'              => esc_html__( 'IMPORTANT NOTICE BEFORE PROCEEDING: Please be sure you actived the Wpcast Child theme for an optimal result, or the customizations won\'t be imported. Also, please, make sure all the required plugins are activated. All demo content will be imported under the current user.', 'wpcast' ),
			'preview_url'                => 'https://wpcast.qantumthemes.xyz/demo2/',
			'import_preview_image_url'	 => $url.'demo2/preview.jpg',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'wpcast_ocdi_import_files' );



/**
 * After import
 * IMPORTANT!
 * ==============================================
 * PASS VARIABLE selected_import
 * ============================================
 */
function wpcast_ocdi_after_import_setup( $selected_import ) {


	/**
	 * Enable Places for posts
	 */
	update_option('qtmaps_typeselect_post', '1');

	// use the name of the selected import
	$demo_name =  $selected_import['import_file_name'];

	if ( 'Classic' === $demo_name ) {
		$primary_menu 		= get_term_by( 'name', 'Primary', 'nav_menu' );
		$secondary_menu 	= get_term_by( 'name', 'Secondary', 'nav_menu' );
		$footer_menu 		= get_term_by( 'name', 'Footer', 'nav_menu' );
		$notfound_menu 		= get_term_by( 'name', '404', 'nav_menu' );
		$front_page_id 		= get_page_by_title( 'Home' );
	}


	if ( 'Travel' === $demo_name ) {
		$primary_menu 		= get_term_by( 'name', 'Primary', 'nav_menu' );
		$secondary_menu 	= get_term_by( 'name', 'Secondary', 'nav_menu' );
		$footer_menu 		= get_term_by( 'name', 'Footer', 'nav_menu' );
		$notfound_menu 		= get_term_by( 'name', '404', 'nav_menu' );
		$front_page_id 		= get_page_by_title( 'Home' );
	}


	/**
	 * 
	 * Set the home
	 * 
	 */
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );

	/**
	 * 
	 * Set the menus
	 * 
	 */
	$menus = array();
	
	if( isset( $primary_menu ) ){
		$menus['wpcast_menu_primary'] = $primary_menu->term_id;
	}

	if( isset( $secondary_menu ) ){
		$menus['wpcast_menu_secondary'] = $secondary_menu->term_id;
	}

	if( isset( $footer_menu ) ){
		$menus['wpcast_menu_footer'] = $footer_menu->term_id;
	}

	if( isset( $offcanvas_menu ) ){
		$menus['wpcast_menu_offcanvas'] = $offcanvas_menu->term_id;
	}

	if( isset( $notfound_menu ) ){
		$menus['wpcast_menu_notfound'] = $notfound_menu->term_id;
	}

	if( count( $menus ) >= 1 ){ // If my array has items, set them
		set_theme_mod( 'nav_menu_locations', $menus );
	}

	
}
add_action( 'pt-ocdi/after_import', 'wpcast_ocdi_after_import_setup' );