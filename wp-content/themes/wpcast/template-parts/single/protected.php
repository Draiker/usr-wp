<?php
/**
 * Protected post
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/
?>
<div class="wpcast-section">
	<div class="wpcast-container">
		<div class="wpcast-entrycontent">
			<div class="wpcast-card wpcast-pad wpcast-paper">
				<div class="wpcast-single__pwform">
					<h6 class="wpcast-caption"><?php esc_html_e( "This post is protected, please insert the password", 'wpcast' ); ?></h6>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

