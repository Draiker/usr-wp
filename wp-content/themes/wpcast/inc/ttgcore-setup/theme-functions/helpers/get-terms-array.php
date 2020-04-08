<?php
if(!function_exists('wpcast_get_terms_array')) {
function wpcast_get_terms_array( ) {
	$cats = get_terms(array(
		'hide_empty'=>false,
	));
	$result = array();
	if(is_wp_error( $cats ) || 0 === $cats){
		$result = array();
	}
	$current_taxonomy = '';
	foreach ( $cats as $cat )	{
		if( $cat->taxonomy == 'nav_menu'){
			continue;
		}
		$result[] = array(
			'value' => $cat->taxonomy.':'.$cat->slug,
			'label' => '['. str_replace('_', ' ', $cat->taxonomy) .'] <strong>'.$cat->name.'</strong>',
		);
	}
	return $result;
}}
