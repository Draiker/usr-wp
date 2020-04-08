<?php  
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

include(plugin_dir_path( __FILE__ ) . '_love.php');
include(plugin_dir_path( __FILE__ ) . '_rate.php');
include(plugin_dir_path( __FILE__ ) . '_views.php');
include(plugin_dir_path( __FILE__ ) . '_share.php');
include(plugin_dir_path( __FILE__ ) . '_readingtime.php');
include(plugin_dir_path( __FILE__ ) . '_commentscount.php');
include(plugin_dir_path( __FILE__ ) . '_shareball.php');
include(plugin_dir_path( __FILE__ ) . '_sharebox.php');
// include(plugin_dir_path( __FILE__ ) . '_sharescount.php');


/**================================================================================================
 *
 *	Main functions to display contents and shortcodes
 * 
 ================================================================================================*/


add_shortcode( 'ttg_reaktions-full', 'ttg_reaktions_full');
function ttg_reaktions_full(){
	ob_start();
	?>
	<div class="ttg-reaktions-all">
		<div class="ttg-reaktions-col1">
			<?php 
			echo ttg_reaktions_loveit_link();
			echo ttg_reaktions_social();
			?>
		</div>
		<div class="ttg-reaktions-col2">
			<?php  
			echo ttg_reaktions_viewsdisplay();
			echo ttg_reaktions_ratingcount();

			if(wp_is_mobile()){
			?>
			<hr class="qt-spacer-s qt-clearfix show-on-small ">
			<?php
			}
			echo do_shortcode('[ttg_reaktions-rating]');			
			?>
		</div>
	</div>
	<?php  
	return ob_get_clean();
}




add_shortcode( 'ttg_reaktions-buttons', 'ttg_reaktions_buttons');
function ttg_reaktions_buttons(){
	ob_start();
	?>
	<div class="ttg-reaktions-buttons-row">
		<?php 
		echo ttg_reaktions_loveit_link();
		echo ttg_reaktions_social();
		?>
	</div>
	<?php  
	return ob_get_clean();
}








