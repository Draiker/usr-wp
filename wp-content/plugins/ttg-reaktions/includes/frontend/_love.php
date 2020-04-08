<?php

/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

// new shortcodes




// old shortcodes
add_shortcode( 'ttg_reaktions-loveit-link', 'ttg_reaktions_loveit_link' );
add_shortcode( 'ttg_reaktions-loveit-count', 'ttg_reaktions_loveit_count' );
add_shortcode( 'ttg_reaktions-loveit-raw', 'ttg_reaktions_loveit_count_raw' );


/**
 *
 * 
 * [ttg_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function ttg_reaktions_loveit_count_raw(){
	ob_start();
	if(get_option('ttg_reaktions_love', 1)){
		$number = (int)get_post_meta(get_the_id(), "ttg_reaktions_votes_count", true);
		if($number > 0){
			?><i class="reakticons-heart-full"></i> <?php echo esc_attr($number );
		}
	}
	return ob_get_clean();
}


/**
 *
 * 
 * [ttg_reaktions_loveit_link Creates LOVE button]
 * @return [html] [LOVE action button]
 *
 * 
 */

function ttg_reaktions_loveit_link( $class = false ){
	if(get_option('ttg_reaktions_love', 1)){
		$id = get_the_ID();
		ob_start();
		$vote_count = get_post_meta($id, "ttg_reaktions_votes_count", true);
		?>
		<a class="ttg_reaktions-link ttg-reaktions-btn ttg-reaktions-btn-love <?php if(ttg_reaktions_hasAlreadyVoted($id)) { ?>ttg-reaktions-btn-disabled <?php } ?><?php  echo esc_attr($class); ?>" data-post_id="<?php echo esc_attr($id); ?>" href="#">
	        <span class="qtli"><i class="reakticons-heart<?php if(ttg_reaktions_hasAlreadyVoted($id)) { ?>-full<?php } ?>"></i></span>
	        <span class="qtli count"><?php echo esc_attr($vote_count); ?></span>
	    </a>
		<?php
		return ob_get_clean();
	}
}


/**
 *
 * 
 * [ttg_reaktions_loveit_count Display number of LOVE]
 * @return [int] [Views count number]
 *
 * 
 */
function ttg_reaktions_loveit_count($class){
	if(get_option('ttg_reaktions_love', 1)){
		ob_start();
		$post_id =get_the_id();
		$number = get_post_meta($post_id, "ttg_reaktions_votes_count", true);
		if("" === $number) {
			$number = 0;
		}
		?>
		<span class="ttg-reaktions-btn ttg-reaktions-viewscounter ttg-reaktions-readonly <?php  echo esc_attr($class); ?>">
			<i class="reakticons-heart"></i> <?php echo esc_attr($number ); ?> <?php if($number !== '1') { echo esc_attr__("Likes", "ttg-reaktions" ); } else { echo esc_attr__("Like", "ttg-reaktions" ); } ?>
		</span>
		<?php
		return ob_get_clean();
	}
}


