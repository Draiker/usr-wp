<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 * ======================================================
 * Post categories template output
 * ------------------------------------------------------
 * Display post categories
 * ======================================================
 */

if(!function_exists('wpcast_postcategories')){
function wpcast_postcategories( $quantity = 1){
	$category = get_the_category(); 
	if( count($category) > 0 ){
		$category = get_the_category(); 
		$limit = $quantity - 1 ;
		foreach($category as $i => $cat){
			if($i > $limit){	
				continue;
			}
			?><a href="<?php echo get_category_link($cat->term_id ); ?>" class="wpcast-catid-<?php echo esc_attr($cat->term_id ); ?>"><?php echo esc_html($cat->cat_name); ?></a><?php
		}
	}
}}
