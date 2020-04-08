<?php  
/*
Plugin Name: Wpcast Blocks 
Plugin URI: http://qantumthemes.com
Description: Adds custom blocks to the Gutenberg Editor
Version: 1.0.0
Author: QantumThemes
Author URI: http://themes2go.com
Text Domain: wpcast-blocks
Domain Path: /languages
*/

add_filter( 'block_categories', function( $categories, $post ) {
return array_merge(
	$categories,
	array(
		array(
			'slug' => 'wpcast-blocks',
			'title' => __( 'Wpcast Blocks', 'wpcast-blocks' ),
		),
	)
);
}, 10, 2 );
include(plugin_dir_path( __FILE__ ) . '/blocks/post-hero/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/authors-small/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/button/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/caption/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/category-grid/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/featured-author/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/post-list/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/post-list-horizontal/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/post-grid/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/post-cards/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/post-slider/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/series-grid-small/index.php');
include(plugin_dir_path( __FILE__ ) . '/blocks/series-grid/index.php');


function wpcast_blocks_powerpress_compatibility(){
	if( get_theme_mod( 'wpcast_powerpress_player_disable' ) == '1' && function_exists('powerpress_content') && defined('POWERPRESS_CONTENT_ACTION_PRIORITY') ){
		remove_filter('get_the_excerpt', 'powerpress_content', (POWERPRESS_CONTENT_ACTION_PRIORITY - 1) );
		remove_filter('the_content', 'powerpress_content', POWERPRESS_CONTENT_ACTION_PRIORITY);
	}
}

add_action( 'init', 'wpcast_blocks_powerpress_compatibility');