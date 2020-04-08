<?php
/**
 * Author in single post
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/



if(get_theme_mod('wpcast_show_author', '1' ) ){
	set_query_var( 'wpcast_featuredauthor_id', get_the_author_meta('ID') );
	get_template_part( 'template-parts/author/featured-author' ); 
	remove_query_arg( 'wpcast_featuredauthor_id' );
}