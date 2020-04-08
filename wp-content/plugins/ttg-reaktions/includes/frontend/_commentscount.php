<?php
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

add_shortcode( 'ttg_reaktions-commentscount', 'ttg_reaktions_commentscount');
add_shortcode( 'ttg_reaktions-commentscount-raw', 'ttg_reaktions_commentscount_raw');




/**
 * 
 * Reading time calculation
 * =============================================
 */
if(!function_exists('ttg_reaktions_comnumber')) {
function ttg_reaktions_comnumber($id = null){
	$id = get_the_id();
	$comments_count = wp_count_comments( $id );
	$comments_count = $comments_count->approved;
	return $comments_count;
}}


/**
 *
 * 
 * [ttg_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function ttg_reaktions_commentscount_raw(){
	ob_start();
	if(get_option('ttg_reaktions_commentscount', 1)){
		$number = ttg_reaktions_comnumber();
		if($number > 0){
			?><i class="reakticons-comment"></i> <?php echo esc_attr($number );
		}
	} 
	return ob_get_clean();
}


/**
 *
 * 
 * [ttg_reaktions_viewsdisplay Display number of views]
 * @return [html] [Views count]
 *
 * 
 */
function ttg_reaktions_commentscount($class = false){
	if(get_option('ttg_reaktions_views', 1)){
		$rtime = ttg_reaktions_comnumber();
		if(($rtime && $rtime > 0)){
			?>
			<span class="ttg-reaktions-btn ttg-reaktions-commentscounter ttg-reaktions-readonly <?php  echo esc_attr($class); ?>">
				<i class="reakticons-comment"></i> <?php echo esc_attr($number );?>
			</span>
			<?php
		} 
	}
}


