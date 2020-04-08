<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

/**
 * ======================================================
 * === Used in the vc_templates filed ===
 * ------------------------------------------------------
 * Instead of allowing $content we use this function for the content of external plugins such
 *	as Page Builder (Visual Composer) because it needs to be outputted like it is, as may contain js and other stuff, but is already sanitarized and
 *	can't be sanitized again, but with this function we are sure that we are not allowing
 *	unsanitarized contents.	
 * ======================================================
 */
if(!function_exists('wpcast_sanitize_content')){
function wpcast_sanitize_content($c) {
	return $c;
}}