<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */


/*
 * 
 * Add theme functions to set the environment for external plugins
 * 
 */

// Helpers
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/helpers/get-terms-array.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/helpers/vc-query-fields.php' );

// Functions
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-authors-small.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-button.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-category-grid.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-caption.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-featured-author.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-post-hero.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-post-list.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-post-list-horizontal.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-post-list-wide.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-post-grid.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-post-slider.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-post-cards.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-series-grid-small.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-series-grid.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-spacer.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-socialicons.php' );
require_once get_theme_file_path( '/inc/ttgcore-setup/theme-functions/theme-function-gallery.php' );