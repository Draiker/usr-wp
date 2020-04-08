<?php
/**
 * [qt-post-slider id="123" category="category_slug" category_exclude="slug-to-exclude" quantity="1" offset="5" orderby="date|rand"]
 */

function wpcast_blocks_post_slider_block_init() {
	$dir = dirname( __FILE__ );

	$block_js = 'block/block.js';
	wp_register_script(
		'wpcast-blocks-post-slider', // File_ID_ref
		plugins_url( $block_js, __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
		filemtime( "$dir/$block_js" )
	);

	$editor_css = 'block/editor.css';
	wp_register_style('wpcast-blocks-post-slider-admin',plugins_url( $editor_css, __FILE__ ),array(),filemtime( "$dir/$editor_css" )    );


	register_block_type( 'wpcast-blocks/post-slider', 
		array( // same as in block.js registerBlockType
			'editor_script' => 'wpcast-blocks-post-slider', // File_ID_ref
			'editor_style'  => 'wpcast-blocks-post-slider-admin',
			'style'         => 'wpcast-blocks-post-slider',
			'render_callback' => 'wpcast_blocks_post_slider_callback',//'php_block_render', 
			'attributes'      => array(
				'post_type' => array (
					'type' => 'text',
				),
				'include_by_id' => array (
					'type' => 'text', // slug
				),
				'custom_query' => array (
					'type' => 'text', // slug
				),
				'tax_filter' => array (
					'type' => 'text',
				),
				'post_tag' => array (
					'type' => 'text',
				),
				'items_per_page' => array (
					'type' => 'text',
				),
				'post_tag' => array (
					'type' => 'text',
				),
				'items_per_page' => array (
					'type' => 'text',
				),
				'orderby' => array (
					'type' => 'text',
				),
				'order' => array (
					'type' => 'text',
				),
				'meta_key' => array (
					'type' => 'text',
				),
				'offset' => array (
					'type' => 'text',
				),
				'exclude' => array (
					'type' => 'text',
				),
			),
		)

	);
}
add_action( 'init', 'wpcast_blocks_post_slider_block_init' );


// Shortcode wrapper
function wpcast_blocks_post_slider_callback( $attributes ){

	if(!function_exists( 'wpcast_template_post_slider' )){
		return esc_html__( 'Sorry, this block doesn\'t work with your theme', 'wpcast-blocks' );
	}
	remove_filter( 'the_content', 'wpautop' );
	ob_start();
	$output = wpcast_template_post_slider( $attributes );
	$output = str_replace( array("	","\n","  "), " ", $output); // the AutoP breaks the content form gutenberg server side render
	$output = str_replace(array("<br>","<p>","</p>"), "", $output);

	if ( '' === $output ) {
		$output =  esc_html__( 'Sorry, this block doesn\'t work with your theme', 'wpcast-blocks' );
	}
	add_filter( 'the_content', 'wpautop' , 12);
	return $output;
}














