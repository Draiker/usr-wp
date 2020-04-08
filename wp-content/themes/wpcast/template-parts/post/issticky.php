<?php
/**
 * 
 * Add mark if is sticky
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

if( is_sticky()) {
	?>
	<span class="wpcast-post__sticky wpcast-accent"><i class="material-icons">star</i></span>
	<?php
}