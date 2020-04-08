<?php
/**
 * @package WordPress
 * @subpackage ttgcore
 * @subpackage wpcast
 * @version 1.0.0
 *
 * ======================================================================
 * SETTINGS FOR THE TTGCORE PLUGIN
 * _____________________________________________________________________
 * This file adds configurations for the TTGcore plugin for custom 
 * posty types and/or taxonomies
 * ======================================================================
 */
if( !function_exists('qt_series_custom_tax') ){
	function qt_series_custom_tax(){
		$labels = array(
			'name' => esc_html__( 'QT Series',"qt-series" ),
			'singular_name' => esc_html__( 'QT Series',"qt-series" ),
			'search_items' =>  esc_html__( 'Search by serie',"qt-series" ),
			'popular_items' => esc_html__( 'Popular series',"qt-series" ),
			'all_items' => esc_html__( 'All series',"qt-series" ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => esc_html__( 'Edit serie',"qt-series" ), 
			'update_item' => esc_html__( 'Update serie',"qt-series" ),
			'add_new_item' => esc_html__( 'Add new serie',"qt-series" ),
			'new_item_name' => esc_html__( 'New serie name',"qt-series" ),
			'separate_items_with_commas' => esc_html__( 'Separate series with commas',"qt-series" ),
			'add_or_remove_items' => esc_html__( 'Add or remove series',"qt-series" ),
			'choose_from_most_used' => esc_html__( 'Choose from the most used series',"qt-series" ),
			'menu_name' => esc_html__( 'QT Serie',"qt-series" )
		); 
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => qt_series_custom_series_slug() )
		);
		register_taxonomy( qt_series_custom_series_name(),'post', $args	);

		// Adding column to the post list columns
		$functionNameX = qt_series_custom_series_name().'_columns';
		$functionNameX = function($taxonomies) {
			$taxonomies[] = qt_series_custom_series_name();
			return $taxonomies;
		};
		add_filter( 'manage_taxonomies_for_post_columns', $functionNameX );


	}
}
add_action('init', 'qt_series_custom_tax');


// Flush rewrite rules to have new permalinks
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'qt_series_flush_rewrites' );
function qt_series_flush_rewrites() {
	qt_series_custom_tax(); // always do it after calling the custom tax
	flush_rewrite_rules();
}
