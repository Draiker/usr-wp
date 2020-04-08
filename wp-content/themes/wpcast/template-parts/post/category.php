<?php
/**
 * 
 * Display only the first category
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

if(!isset( $quantity )){ // allow override from calling loop via set_query_var
	$quantity = 1;
}
?>
<p class="wpcast-cats">
	<?php  
	wpcast_postcategories( $quantity );
	?>
</p>
