<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

/**==========================================================================================
 *
 *
 *	QantumThemes Support Warranty Notice:
 *	-----------------------------------------------
 * 	Theme's support doesn't cover any code customizations. 
 * 	You are free to edit any theme's code at your own risk.
 *  For any customization please use the provided child theme instead of editing core files.
 *  https://codex.wordpress.org/Child_Themes
 *
 * 
 * 	FUNCTIONS OVERRIDE:
 * 	-----------------------------------------------
 * 	Every function is wrapped in "function_exists" condition. 
 * 	In this way if you don't like something you can bring it yo your child theme's functions.php
 * 	and customize it.
 *
 *
 ==========================================================================================*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// Theme version used for enqueuing css and js
require_once get_theme_file_path( '/inc/theme-base-functions/theme-version.php' );

// TGM Plugins Activation
require_once get_theme_file_path( '/inc/tgm-plugin-activation/wpcast-plugins-activation.php' );

// Gutenberg styling
require_once get_theme_file_path( '/inc/gutenberg/index.php' );

// Set content width
require_once get_theme_file_path( '/inc/theme-base-functions/content-width.php' );

// Configurations for TTG Core plugin (styling settings, custom options)
require_once get_theme_file_path( '/inc/ttgcore-setup/ttg-core-configuration.php' );

// Enqueue JavaScript and CSS
require_once get_theme_file_path( '/inc/theme-base-functions/styles-inclusion.php' );

// Register sidebars
require_once get_theme_file_path( '/inc/theme-base-functions/register-sidebars.php' );

// Setup theme, set menu locations, sidebars
require_once get_theme_file_path( '/inc/theme-base-functions/setup-theme.php' );

// Theme options (thumbnail and image sizes)
require_once get_theme_file_path( '/inc/theme-base-functions/setup-options.php' );

// Display logo or site title
require_once get_theme_file_path( '/inc/theme-base-functions/show-logo.php' );

// Get current page number universally
require_once get_theme_file_path( '/inc/theme-base-functions/get-current-page.php' );

// Shortcode safe execution wrapper
require_once get_theme_file_path( '/inc/theme-base-functions/shortcodes-safe-execution.php' );

// Sane content wrapper
require_once get_theme_file_path( '/inc/theme-base-functions/sane-content.php' );

// Provides different excerpt lengths to be used with custom post items
require_once get_theme_file_path( '/inc/theme-base-functions/excerpt-length.php' );

// Display post categories
require_once get_theme_file_path( '/inc/theme-base-functions/postcategories.php' );

// Set custom number of posts for the pagination
require_once get_theme_file_path( '/inc/theme-base-functions/custom-number-of-posts.php' );

// Set the pagination offset for series as the first post is with custom formatting
require_once get_theme_file_path( '/inc/theme-base-functions/series-offset-pagination.php' );

// Outputs the correct feed link
require_once get_theme_file_path( '/inc/theme-base-functions/feed-link.php' );

// Comments and pingback formatting
require_once get_theme_file_path( '/inc/theme-base-functions/comments-pingback.php' );

// Shorten excerpt
require_once get_theme_file_path( '/inc/theme-base-functions/shorten-excerpt.php' );

// Password form custom formatting
require_once get_theme_file_path( '/inc/theme-base-functions/password-form.php' );

// Tags output formatting
require_once get_theme_file_path( '/inc/theme-base-functions/tags-formatting.php' );

// Customization styles
require_once get_theme_file_path( '/inc/theme-base-functions/customizations.php' );

// Customization styles
require_once get_theme_file_path( '/inc/theme-base-functions/sort-categories.php' );

// Seriously Simple Podcasting plugin compatibility check
require_once get_theme_file_path( '/inc/ssp/ssp-settings.php' );

// WpBakery Page Builder settings
// Important: this theme may deactivate some shortcodes when ajax page load is active, as they can't be reinitialized on page change.
// If you need absolutely those shortcodes, just deactivate QT Ajax Page Load (music will stop on page change)
require_once get_theme_file_path( '/vc_templates/wpcast-pagebuilder-setup.php' );

// One Click Installer
require_once get_theme_file_path( '/inc/ocdi/ocdi-setup.php' );




// End of functions.php
// ============================================================================================================

