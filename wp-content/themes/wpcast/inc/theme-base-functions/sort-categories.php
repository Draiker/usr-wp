<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/
/**
 * ======================================================
 * Get categories by latest posts
 * ------------------------------------------------------
 * https://stackoverflow.com/questions/43100515/get-categories-order-by-last-post
 * ======================================================
 */
function wpcast_get_sorted_categories( $order_by = 'id', $args = array() ){
    global $wpdb;

    $category = get_categories( $args );

    $order = [
        'id' => 'post.ID',
        'date' => 'post.post_date',
        'modified' => 'post.post_modified',
    ];

    $order_by = $order[ $order_by ];

    $q = $wpdb->get_results("SELECT tax.term_id FROM `{$wpdb->prefix}term_taxonomy` tax
    INNER JOIN `{$wpdb->prefix}term_relationships` rel ON rel.term_taxonomy_id = tax.term_id
    INNER JOIN `{$wpdb->prefix}posts` post ON rel.object_id = post.ID WHERE tax.taxonomy = 'category' AND post.post_type = 'post' AND post.post_status = 'publish' ORDER BY {$order_by} DESC");

    $sort = array_flip( array_unique( wp_list_pluck( $q, 'term_id' ) ) );

    usort( $category, function( $a, $b ) use ( $sort, $category ) {
        if( isset( $sort[ $a->term_id ], $sort[ $b->term_id ] ) && $sort[ $a->term_id ] != $sort[ $b->term_id ] )
            $res = ($sort[ $a->term_id ] > $sort[ $b->term_id ]) ? 1 : -1;
        else if( !isset( $sort[ $a->term_id ] ) && isset( $sort[ $b->term_id ] ) )
            $res = 1;
        else if( isset( $sort[ $a->term_id ] ) && !isset( $sort[ $b->term_id ] ) )
            $res = -1;
        else
            $res = 0;

        return $res;
    } );

    return $category;
}
