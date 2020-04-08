<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

if ( is_category() ) : single_cat_title();
elseif (is_page() || is_singular() ) : the_title();
elseif ( is_search() ) : printf( esc_html(__( 'Search Results for: %s', "wpcast" )), '<span>' . esc_html(get_search_query()) . '</span>' );
elseif ( is_tag() ) : single_tag_title();
elseif ( is_author() ) :
	the_author_meta('nickname');
	rewind_posts();
elseif ( is_day() ) : printf( esc_html__( 'Day: %s', "wpcast" ), '<span>' . esc_html(get_the_date()) . '</span>' );
elseif ( is_month() ) : printf( esc_html__( 'Month: %s', "wpcast" ), '<span>' . esc_html(get_the_date( 'F Y' )) . '</span>' );
elseif ( is_year() ) :  printf( esc_html__( 'Year: %s', "wpcast" ), '<span>' . esc_html(get_the_date( 'Y' )) . '</span>' );
elseif ( is_tax( 'post_format', 'post-format-aside' ) ) : esc_html_e( 'Asides', "wpcast" );
elseif ( is_tax( 'post_format', 'post-format-image' ) ) : esc_html_e( 'Images', "wpcast");
elseif ( is_tax( 'post_format', 'post-format-video' ) ) : esc_html_e( 'Videos', "wpcast" );
elseif ( is_tax( 'post_format', 'post-format-quote' ) ) : esc_html_e( 'Quotes', "wpcast" );
elseif ( is_tax( 'post_format', 'post-format-link' ) ) : esc_html_e( 'Links', "wpcast" );
elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) : esc_html_e( 'Galleries', "wpcast" );
elseif ( is_tax( 'post_format', 'post-format-audio' ) ) : esc_html_e( 'Sounds', "wpcast" );
else: esc_html_e( 'Blog', "wpcast" );
endif;