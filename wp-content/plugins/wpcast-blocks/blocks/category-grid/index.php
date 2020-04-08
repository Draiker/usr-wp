<?php
/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */

function wpcast_blocks_category_grid_block_init() {
	$dir = dirname( __FILE__ );

	$block_js = 'block/block.js';
	wp_register_script(
		'wpcast-blocks-category-grid', // File_ID_ref
		plugins_url( $block_js, __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
		filemtime( "$dir/$block_js" )
	);

	$editor_css = 'block/editor.css';
	wp_register_style('wpcast-blocks-category-grid-admin',plugins_url( $editor_css, __FILE__ ),array(),filemtime( "$dir/$editor_css" )    );

	register_block_type( 'wpcast-blocks/category-grid', 
		array( // same as in block.js registerBlockType
			'editor_script' => 'wpcast-blocks-category-grid', // File_ID_ref
			'editor_style'  => 'wpcast-blocks-category-grid-admin',
			'style'         => 'wpcast-blocks-category-grid',
			'render_callback' => 'wpcast_blocks_category_grid_callback',//'php_block_render', 
			'attributes'      => array(
				'label' => array (
					'type' => 'text',
				),
				'hide_empty' => array (
					'type' => 'text',
				),
				'include' => array (
					'type' => 'text',
				),
				'exclude' => array (
					'type' => 'text',
				),
				'parent' => array (
					'type' => 'text',
				),
				'child_of' => array (
					'type' => 'text',
				)
			),
		)

	);
}
add_action( 'init', 'wpcast_blocks_category_grid_block_init' );


// Shortcode wrapper
function wpcast_blocks_category_grid_callback( $attributes ){
	if(!function_exists( 'wpcast_template_category_grid' )){
		return esc_html__( 'Sorry, this block doesn\'t work with your theme', 'wpcast-blocks' );
	}
	ob_start();
	$output = wpcast_template_category_grid( $attributes );
	if ( '' === $output ) {
		$output =  esc_html__( 'Sorry, this block doesn\'t work with your theme', 'wpcast-blocks' );
	}
	return $output;
}














