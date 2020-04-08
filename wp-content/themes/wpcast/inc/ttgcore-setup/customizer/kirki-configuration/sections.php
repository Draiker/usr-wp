<?php  
/**
 * Create sections using the WordPress Customizer API.
 * @package Kirki
 */
if(!function_exists('wpcast_kirki_sections')){
function wpcast_kirki_sections( $wp_customize ) {

	/**
	 * ============================================================
	 * Player settings with sub panel 
	 * ============================================================
	 */
	$wp_customize->add_panel( 'wpcast_theme_settings', array(
		'title'       => esc_html__( 'Theme customization', "wpcast" ),
		'priority'    => 60
	));

		/**
		 * sections of the panel
		 * ============================================================
		 */

		$wp_customize->add_section( 'wpcast_colors_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Colors', "wpcast" ),
			'priority'    => 40
		));



		$wp_customize->add_section( 'wpcast_header_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Header', "wpcast" ),
			'priority'    => 40
		));


		$wp_customize->add_section( 'wpcast_header_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Header', "wpcast" ),
			'priority'    => 40
		));
		$wp_customize->add_section( 'wpcast_secondary_header_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Secondary Header', "wpcast" ),
			'priority'    => 40
		));
		$wp_customize->add_section( 'wpcast_cta_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Call to action', "wpcast" ),
			'priority'    => 40
		));

		// $wp_customize->add_section( 'wpcast_colors_section', array(
		// 	'panel'          => 'wpcast_theme_settings',
		// 	'title'       => esc_html__( 'Theme colors', "wpcast" ),
		// 	'priority'    => 41,
		// 	'description' => esc_html__( 'Colors of your website', "wpcast" ),
		// ));
		$wp_customize->add_section( 'wpcast_blog_settings', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Blog settings', "wpcast" ),
			'priority'    => 41
		));
		$wp_customize->add_section( 'wpcast_social_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Social networks', "wpcast" ),
			'priority'    => 101,
			'description' => esc_html__( 'Social network profiles', "wpcast" ),
		));
		$wp_customize->add_section( 'wpcast_footer_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Footer Customization', "wpcast" ),
			'priority'    => 102,
			'description' => esc_html__( 'Footer text and functions', "wpcast" ),
		));
		$wp_customize->add_section( 'wpcast_typo_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Typography', "wpcast" ),
			'priority'    => 102,
			'description' => esc_html__( 'Set font families and settings', "wpcast" ),
		));

		$wp_customize->add_section( 'wpcast_podcasting_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'Podcasting', "wpcast" ),
			'priority'    => 102,
		));

		if( function_exists('powerpress_content') ){
		$wp_customize->add_section( 'wpcast_powerpress_section', array(
			'panel'          => 'wpcast_theme_settings',
			'title'       => esc_html__( 'PowerPress Settings', "wpcast" ),
			'priority'    => 102,
			'description' => esc_html__( 'Customize PowerPress output', "wpcast" ),
		));
		}
		
}}
add_action( 'customize_register', 'wpcast_kirki_sections' );
