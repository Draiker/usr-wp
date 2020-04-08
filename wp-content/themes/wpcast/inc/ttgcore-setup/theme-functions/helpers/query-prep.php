<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Prepare query for functions
*/

/**
 * 1. Query preparation
 * ================================================
 * If offset is set, paged is ignored (https://codex.wordpress.org/Class_Reference/WP_Query)
 * so we are preparing the query with correct paged number, but it is not affecting the results now
 * instead we also make a custom offset adding offset parameter with page * results number
 */
if (intval($paged) > 1){
	$offset = intval($offset) + ( intval( $items_per_page) * intval( $paged ) );
}
$args = array(
	'post_type' 			=>  $post_type,
	'posts_per_page' 		=> (int)$items_per_page,
	'post_status' 			=> 'publish',
	'paged' 				=> $paged,
	'suppress_filters' 		=> false,
	'offset' 				=> (int)$offset,
	'ignore_sticky_posts' 	=> 1,
	'orderby' 				=> trim( esc_attr($orderby) ),
	'order' 				=> trim( esc_attr($order) ),
	'meta_key'				=> $meta_key,
	'post__not_in'			=> explode(',', trim($exclude) ),
);
// ========== TAXONOMY FILTERING =================
if( $tax_filter  ){
	$tax_filter_array = explode(',', trim($tax_filter) );
	$tax_atts = array();
	$tax_query = array(
		'relation' => 'AND'
	);
	foreach( $tax_filter_array as $var => $val){
		$tax = explode(':', $val);
		if( array_key_exists(1, $tax)){
			$tax_atts[ trim( $tax[0] ) ] [] = trim( $tax[1] );
		}
	}
	foreach( $tax_atts as $taxname => $termslist ){
		$tax_query[] = array(
			'taxonomy' 	=> trim( $taxname ),
			'field' 	=> 'slug',
			'terms'		=> implode( ',', $termslist ),
			'operator'	=> 'IN'
		);
	}
	$args[ 'tax_query'] = $tax_query;
}

// ========== QUERY BY ID =================
if( $include_by_id ){
	$idarr = explode(",",$include_by_id);
	if(count($idarr) > 0){
		$quantity = count($idarr);
		$args = array(
			'post__in'=> $idarr,
			'post_type' =>  'any',
			'orderby' => 'post__in',
			'posts_per_page' => intval($quantity),
			'ignore_sticky_posts' => 1
		);  
	}
}

// ========== CUSTOM QUERY =================
if( $custom_query ){
	$args = array();
	parse_str( $custom_query, $args );
	$args['ignore_sticky_posts']= 1;
	$args['suppress_filters']	= false;
	$args['paged']				= $paged;
	$args['offset'] 			= (int)$offset;
	if( $style !== 'all' ){
		$args['posts_per_page'] = (int)$items_per_page;
	}
}