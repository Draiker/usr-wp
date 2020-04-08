<?php
/**
 * [qt-featured-author id="0"]
 */

function wpcast_blocks_featured_author_block_init() {
	$dir = dirname( __FILE__ );

	$block_js = 'block/block.js';
	wp_register_script(
		'wpcast-blocks-featured-author', // File_ID_ref
		plugins_url( $block_js, __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
		filemtime( "$dir/$block_js" )
	);

	$editor_css = 'block/editor.css';
	wp_register_style('wpcast-blocks-featured-author-admin',plugins_url( $editor_css, __FILE__ ),array(),filemtime( "$dir/$editor_css" )    );

	register_block_type( 'wpcast-blocks/featured-author', 
		array( // same as in block.js registerBlockType
			'editor_script' => 'wpcast-blocks-featured-author', // File_ID_ref
			'editor_style'  => 'wpcast-blocks-featured-author-admin',
			'style'         => 'wpcast-blocks-featured-author',
			'render_callback' => 'wpcast_blocks_featured_author_callback',//'php_block_render', 
			'attributes'      => array(
				'id' => array (
					'type' => 'text',
				),
			),
		)

	);
}
add_action( 'init', 'wpcast_blocks_featured_author_block_init' );


// Shortcode wrapper
function wpcast_blocks_featured_author_callback( $attributes ){
	if(!function_exists( 'wpcast_template_featured_author' )){
		return esc_html__( 'Sorry, this block doesn\'t work with your theme', 'wpcast-blocks' );
	}
	ob_start();
	$output = wpcast_template_featured_author( $attributes );
	if ( '' === $output ) {
		$output =  esc_html__( 'Sorry, this block doesn\'t work with your theme', 'wpcast-blocks' );
	}
	return $output;
}














