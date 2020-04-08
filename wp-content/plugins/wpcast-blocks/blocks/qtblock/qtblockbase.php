<?php
/**
 * Plugin Name: qtBlockBase
 *

/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package qtblocks
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function qtblock_block_init() {
    $dir = dirname( __FILE__ );

    $block_js = 'qtblock/block.js';
    wp_register_script(
        'qtblock-block-editor',
        plugins_url( $block_js, __FILE__ ),
        array(
            'wp-blocks',
            'wp-i18n',
            'wp-element',
        ),
        filemtime( "$dir/$block_js" )
    );

    $editor_css = 'qtblock/editor.css';
    wp_register_style(
        'qtblock-block-editor',
        plugins_url( $editor_css, __FILE__ ),
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'qtblock/style.css';
    wp_register_style(
        'qtblock-block',
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'qtblocks/qtblock', array(
        'editor_script' => 'qtblock-block-editor',
        'editor_style'  => 'qtblock-block-editor',
        'style'         => 'qtblock-block',
    ) );
}
add_action( 'init', 'qtblock_block_init' );