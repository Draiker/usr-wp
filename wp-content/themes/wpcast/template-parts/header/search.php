<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 * Search
 */
?>

<nav id="wpcastSearchBar" class="wpcast-searchbar wpcast-paper">
	<div class="wpcast-searchbar__cont">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="wpcast-paper">
			<input name="s" type="text" placeholder="<?php esc_attr_e( 'Search', 'wpcast' ); ?>" id="wpcast-searchbar-input" value="<?php echo esc_attr( get_search_query() ); ?>" />
			<button type="submit" name="<?php esc_attr_e( "Submit", "wpcast" ); ?>" class="wpcast-btn wpcast-icon-l wpcast-hide-on-small-only wpcast-btn-primary" value="<?php esc_attr_e( "Search", "wpcast" ); ?>" ><i class="material-icons">search</i> <?php esc_html_e( "Search", "wpcast" ); ?></button>
		</form>

		<a class="wpcast-btn wpcast-btn__r"  data-wpcast-switch="open" data-wpcast-target="#wpcastSearchBar"> <i class="material-icons">close</i></a>
	</div>
</nav>
