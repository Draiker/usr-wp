<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

?>	
<div id="wpcastCopybar" class="wpcast-footer__copy wpcast-primary">
	<p>
		<?php echo html_entity_decode( wp_kses( get_theme_mod('wpcast_footer_text') , array('a')) ); ?>
	</p>
</div>