<?php
/**
 * [qt-post-hero id="123" category="category_slug" category_exclude="slug-to-exclude" quantity="1" offset="5" orderby="date|rand"]
 */

function wpcast_blocks_post_hero_block_init() {
	$dir = dirname( __FILE__ );

	$block_js = 'block/block.js';
	wp_register_script(
		'wpcast-blocks-post-hero', // File_ID_ref
		plugins_url( $block_js, __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
		filemtime( "$dir/$block_js" )
	);

	$editor_css = 'block/editor.css';
	wp_register_style('wpcast-blocks-post-hero-admin',plugins_url( $editor_css, __FILE__ ),array(),filemtime( "$dir/$editor_css" )    );


	register_block_type( 'wpcast-blocks/post-hero', 
		array( // same as in block.js registerBlockType
			'editor_script' => 'wpcast-blocks-post-hero', // File_ID_ref
			'editor_style'  => 'wpcast-blocks-post-hero-admin',
			'style'         => 'wpcast-blocks-post-hero',
			'render_callback' => 'wpcast_blocks_post_hero_callback',//'php_block_render', 
			'attributes'      => array(
				'id' => array (
					'type' => 'text',
				),
				'category' => array (
					'type' => 'text', // slug
				),
				'category_exclude' => array (
					'type' => 'text', // slug
				),
				'quantity' => array (
					'type' => 'text',
				),
				'offset' => array (
					'type' => 'text',
				),
				'orderby' => array (
					'type' => 'text', // date // random
				)
			),
		)

	);
}
add_action( 'init', 'wpcast_blocks_post_hero_block_init' );


// Shortcode wrapper
function wpcast_blocks_post_hero_callback( $attributes ){
	if(!function_exists( 'wpcast_template_post_hero' )){
		return esc_html__( 'Sorry, this block doesn\'t work with your theme', 'wpcast-blocks' );
	}
	ob_start();
	$output = wpcast_template_post_hero( $attributes );
	if ( '' === $output ) {
		$output =  esc_html__( 'Sorry, this block doesn\'t work with your theme', 'wpcast-blocks' );
	}
	return $output;
}














