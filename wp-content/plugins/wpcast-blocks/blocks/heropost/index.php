<?php
/**
 * Plugin Name: heropostBase
 *

/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package heroposts
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function wpcast_blocks_heropost_block_init() {
    $dir = dirname( __FILE__ );

    $block_js = 'block/block.js';
    wp_register_script(
        'wpcast-blocks-heropost', // File_ID_ref
        plugins_url( $block_js, __FILE__ ),
        array(
            'wp-blocks',
            'wp-i18n',
            'wp-element',
        ),
        filemtime( "$dir/$block_js" )
    );

    $editor_css = 'block/editor.css';
    wp_register_style('wpcast-blocks-heropost-admin',plugins_url( $editor_css, __FILE__ ),array(),filemtime( "$dir/$editor_css" )    );

    register_block_type( 'wpcast-blocks/heropost', array( // same as in block.js registerBlockType
        'editor_script' => 'wpcast-blocks-heropost', // File_ID_ref
        'editor_style'  => 'wpcast-blocks-heropost-admin',
        'style'         => 'wpcast-blocks-heropost',
        'render_callback' => 'wpcast_blocks_heropost_callback',
    ) );
}
add_action( 'init', 'wpcast_blocks_heropost_block_init' );



function wpcast_blocks_heropost_callback( $attributes, $content ){
    $recent_posts = wp_get_recent_posts( array(
        'numberposts' => 1,
        'post_status' => 'publish',
    ) );
    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
    }

    
    ob_start();
    $post = $recent_posts[ 0 ];
    $post_id = $post['ID'];
    setup_postdata( $post );
    get_template_part( 'template-parts/post/post-hero' );
    wp_reset_postdata();
    $output = ob_get_clean();

    if ( '' === $output ) {
        $output = (string) $content;
    }
    return $output;
}














