<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */
?>
<div  class="wpcast-searchform">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="wpcast-form-wrapper">
		<div class="wpcast-fieldset">
			<input id="s" name="s" placeholder="<?php esc_attr_e( 'To search type and press enter', 'wpcast' ); ?>" type="text" required="required" value="<?php echo esc_attr( get_search_query() ); ?>" />
		</div>
		<button type="submit" name="<?php esc_attr_e( "Submit", "wpcast" ); ?>" class="wpcast-btn wpcast-btn__txt"><i class="material-icons">search</i></button>
	</form>
</div>