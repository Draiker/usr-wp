<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 * ======================================================
 * Display logo or site name.
 * Native WP function is super buggy and doesn't support
 * live refreshing, while ours does.
 * ======================================================
 */
if(!function_exists('wpcast_show_logo')){
function wpcast_show_logo( $alternative = ''){
	$logo = get_theme_mod("wpcast_logo".$alternative, '');
	ob_start();
	if($logo != ''){
		?>
		<img src="<?php echo esc_url( $logo ); ?>" class="wpcast-logo<?php echo esc_attr( $alternative ); ?>" alt="<?php echo esc_attr( bloginfo('name') ); ?>">
		<?php
	}else{
		?>
		<span class="wpcast-sitename wpcast-logo<?php echo esc_attr( $alternative ); ?>"><?php bloginfo('name'); ?></span>
		<?php
	}
	return ob_get_clean();
}}
