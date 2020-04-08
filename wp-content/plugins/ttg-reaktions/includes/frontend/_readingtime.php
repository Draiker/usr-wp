<?php
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

add_shortcode( 'ttg_reaktions-readingtime', 'ttg_reaktions_readingtime');
add_shortcode( 'ttg_reaktions-readingtime-raw', 'ttg_reaktions_readingtime_raw');




/**
 * 
 * Reading time calculation
 * =============================================
 */
if(!function_exists('ttg_reaktions_read_num')) {
function ttg_reaktions_read_num($id = null){
	$id = get_the_id();
	$content = get_post_field('post_content', $id);
	$word = str_word_count(strip_tags($content));

	//words read per minute
	$wpm = 240;
	//words read per second
	$wps = $wpm/60;
	$secs_to_read = ceil($word/$wps);
	return gmdate("i's''", $secs_to_read);
}}


/**
 *
 * 
 * [ttg_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function ttg_reaktions_readingtime_raw(){
	ob_start();

	if(get_option('ttg_reaktions_readingtime', 1)){
		$number = ttg_reaktions_read_num();
		?><i class="reakticons-clock"></i> <?php echo esc_attr($number ); ?> <?php esc_html_e('Read', 'ttg-reaktions');
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
function ttg_reaktions_readingtime($class = false){
	if(get_option('ttg_reaktions_readingtime', 1)){
		$rtime = ttg_reaktions_read_num();
		if(($rtime && $rtime > 0)){
			?>
			<span class="ttg-reaktions-btn ttg-reaktions-readingtimeer ttg-reaktions-readonly <?php  echo esc_attr($class); ?>">
				<i class="reakticons-clock"></i> <?php echo esc_attr($number );?>
			</span>
			<?php
		} 
	}
}


