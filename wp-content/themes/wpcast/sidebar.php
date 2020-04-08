<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */


if( is_active_sidebar( 'wpcast-right-sidebar' ) ){
	?>
	<div id="wpcastSidebar" role="complementary" class="wpcast-sidebar wpcast-sidebar__main wpcast-sidebar__rgt">
		<ul class="wpcast-row">
			<?php dynamic_sidebar( 'wpcast-right-sidebar' ); ?>
		</ul>
	</div>
	<?php 
}