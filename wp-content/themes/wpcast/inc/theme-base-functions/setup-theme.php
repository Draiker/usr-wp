<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 * ======================================================
 * Setup
 * ------------------------------------------------------
 * Menus, sidebar and wp options upon theme activation
 * ======================================================
 */

if ( ! function_exists( 'wpcast_setup' ) ) {
	add_action( 'after_setup_theme', 'wpcast_setup' );
	function wpcast_setup() {
		load_theme_textdomain( "wpcast", get_theme_file_path( '/languages' ) );
		
		// Adding feed links in header
		add_theme_support( 'automatic-feed-links' );
		
		// Featured images capability
		add_theme_support( 'post-thumbnails' );

		// WP Handles the title tag
		add_theme_support( 'title-tag' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		/**
		* Add support for Gutenberg.
		*
		* @link //wordpress.org/gutenberg/handbook/reference/theme-support/
		*/
		add_theme_support( 'gutenberg', array(
			'wide-images' => true,
		) );

		// Adding editor style
		add_theme_support( 'editor-styles' );

		// Supporting any post format
		add_theme_support( 'post-formats', array( 'audio' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script', 
			'style'
		) );

		/* = We have to add the required images sizes */
		set_post_thumbnail_size( 100, 100, true );
		add_image_size( 'wpcast-squared-s', 100, 100, true );
		add_image_size( 'wpcast-squared-m', 370, 370, true );
		add_image_size( 'wpcast-card', 370, 450, true );

		/* = Register the menu after_menu_locations_table */
		register_nav_menus( array(
			'wpcast_menu_primary' => esc_html__( 'Primary Menu', "wpcast" ),
		));
		register_nav_menus( array(
			'wpcast_menu_secondary' => esc_html__( 'Secondary Menu', "wpcast" ),
		));
		register_nav_menus( array(
			'wpcast_menu_desktop_off' 	=> esc_html__( 'Desktop off-canvas', "wpcast" ),
		));
		register_nav_menus( array(
			'wpcast_menu_footer' => esc_html__( 'Footer Menu', "wpcast" ),
		));
		register_nav_menus( array(
			'wpcast_menu_notfound' => esc_html__( '404 Page Menu', "wpcast" ),
		));

		// Define and register starter content to showcase the theme on new sites.
		$starter_content = array(
			'widgets' => array(
				// Place three core-defined widgets in the sidebar area.
				'wpcast-right-sidebar' => array(
					'search',
					'categories', 
					'tag_cloud'
				)
			),
		);

		/**
		 * Filters WpCast array of starter content.
		 *
		 * @since WpCast 1.0
		 *
		 * @param array $starter_content Array of starter content.
		 */
		$starter_content = apply_filters( 'wpcast_starter_content', $starter_content );

		add_theme_support( 'starter-content', $starter_content );
	}
}
