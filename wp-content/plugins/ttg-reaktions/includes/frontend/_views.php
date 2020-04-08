<?php
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

add_shortcode( 'ttg_reaktions-views', 'ttg_reaktions_viewsdisplay');
add_shortcode( 'ttg_reaktions-views-raw', 'ttg_reaktions_viewscount_raw');

/**
 *
 * 
 * [ttg_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function ttg_reaktions_viewscount_raw(){
	ob_start();
	if(get_option('ttg_reaktions_views', 1)){
		$number = (int)get_post_meta(get_the_id(), "ttg_reaktions_views", true);
		if($number > 0){
			?><i class="reakticons-eye"></i> <?php echo esc_attr($number );
		}
	} 
	return ob_get_clean();
}

/**
 *
 * 
 * [ttg_reaktions_viewscount Display number of views without HTML]
 * @return [int] [Views count number]
 *
 * 
 */
function ttg_reaktions_viewsread(){
	$id = get_the_ID();
	return get_post_meta(get_the_ID(), "ttg_reaktions_views", true);
}

/**
 *
 * 
 * [ttg_reaktions_viewsdisplay Display number of views]
 * @return [html] [Views count]
 *
 * 
 */
function ttg_reaktions_viewsdisplay($class = false){
	if(get_option('ttg_reaktions_views', 1)){
		$views = ttg_reaktions_viewsread();
		if(($views && $views > 0)){
			?>
			<span class="ttg-reaktions-btn ttg-reaktions-viewscounter ttg-reaktions-readonly <?php  echo esc_attr($class); ?>"><i class="reakticons-eye"></i>
				<span class="ttg-Reaktions-Views-Amount" data-single="<?php echo esc_attr__("View", 'ttg-reaktions' ); ?>" data-multi="<?php echo esc_attr__("Views", 'ttg-reaktions' ); ?>">
					<?php echo sprintf( _n( '%s View', '%s Views', $views, 'ttg-reaktions' ), $views ); ?>
				</span>
			</span>
			<?php
		} 
	}
}


/**================================================================================================
 *
 *	Call functions update
 * 
 ================================================================================================*/

/**
 *
 * 
 * [ttg_reaktions_viewscount Updates number of views, needs to be hooked to enqueue_script]
 *
 * 
 */
add_action( 'wp_footer', 'ttg_reaktions_viewscount' );

/**
 *
 * 
 * [ttg_reaktions_viewscount Updates number of views without PHP to avoid cache]
 * @return [int] [Views count number]
 *
 * 
 */
function ttg_reaktions_viewscount($content){ // views update
	if(get_option('ttg_reaktions_views', 1)){
		if(!is_admin() ){
			if(is_singular() || is_home() || is_page()  || is_single() ){
				$id = get_the_ID();
				if(is_numeric($id)){
					$content = $content.$ajax_refresh_tag = '<a class="ttg-reactions-viewconuterajax" data-id="'.esc_js( $id ).'"></a>';
				}
			}
		}
	}
	echo $content;
}


