<?php
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

add_shortcode( 'ttg_reaktions-rating', 'ttg_reaktions_rating');
add_shortcode( 'ttg_reaktions-rating-count', 'ttg_reaktions_ratingcount');
add_shortcode( 'ttg_reaktions-rating-raw', 'ttg_reaktions_ratingcount_raw');
add_shortcode( 'ttg_reaktions-rating-feedback', 'ttg_reaktions_rating_feedback');




function ttg_reaktions_rating_feedback(){
	ob_start();
	if(get_option( "ttg_reaktions_ratings", 1 )){
		?><span data-thanks="<?php echo esc_attr('Thanks', 'ttg-reaktions'); ?>" class="ttg-Ratings-Feedback ttg-reaktions ttg-reaktions-btn ttg-reaktions-readonly"><?php echo esc_attr__('Rate it', 'ttg-reaktions'); ?></span><?php
	}
	return ob_get_clean();
}



/**
 *
 * 
 * [ttg_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function ttg_reaktions_ratingcount_raw(){
	ob_start();
	if(get_option( "ttg_reaktions_ratings", 1 )){
		$number = (int)get_post_meta(get_the_id(), "ttg_rating_average", true);
		if($number > 0){
			?><i class="reakticons-star-two"></i> <?php echo esc_attr($number ); ?> <?php
		}
	}
	return ob_get_clean();
}


/**
 *
 * 
 * [ttg_reaktions_rating add star rating]
 *
 * 
 */
function ttg_reaktions_rating($class = false) {
	if(get_option( "ttg_reaktions_ratings", 1 )){
		$uniqueid = uniqid();
		ob_start();

		echo ttg_reaktions_rating_feedback();
		?>
			<form data-postid="<?php echo get_the_id(); ?>" class="ttg-reaktions ttg-reaktions-rating <?php  echo esc_attr($class); ?>">
				<div class="ttg-reaktions-stars">
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-1" value="1" id="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-1" /><label class="ttg-reaktions-star-1" for="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-1">1</label>
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-2" value="2" id="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-2" /><label class="ttg-reaktions-star-2" for="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-2">2</label>
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-3" value="3" id="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-3" /><label class="ttg-reaktions-star-3" for="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-3">3</label>
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-4" value="4" id="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-4" /><label class="ttg-reaktions-star-4" for="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-4">4</label>
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-5" value="5" id="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-5" /><label class="ttg-reaktions-star-5" for="<?php echo esc_attr($uniqueid); ?>ttg-reaktions-star-5">5</label>
					<span></span>
				</div>
			</form>
		<?php  
		return ob_get_clean();
	}
}




/**
 *
 * 
 * [ttg_reaktions_rating add star rating]
 *
 * 
 */
function ttg_reaktions_ratingcount($class = false) {
	if(get_option( "ttg_reaktions_ratings", 1 )){
		ob_start();
		?>
		<span class=" ttg-reaktions ttg-reaktions-btn ttg-reaktions-readonly <?php  echo esc_attr($class); ?>">
			<i class="reakticons-star-two"></i> <span class="ttg-Ratings-Avg"><?php echo round(get_post_meta(get_the_id(), "ttg_rating_average", true), 2); ?></span>
			<?php  
			$ratings = (int)get_post_meta(get_the_id(), "ttg_rating_amount", true);
			?>
			<span class="ttg-Ratings-Amount" 
			data-none="<?php echo esc_attr__('Ratings', 'ttg-reaktions' ); ?>" 
			data-novote="<?php echo esc_attr__('Already voted!', 'ttg-reaktions' ); ?>" 
			data-single="<?php echo esc_attr__('rating', 'ttg-reaktions' ); ?>" 
			data-multi="<?php echo esc_attr__('ratings', 'ttg-reaktions' ); ?>"
			data-before="<?php echo esc_attr__('On', 'ttg-reaktions' ); ?>" >
			<?php
				if($ratings > 0){
					echo sprintf( _n( 'On %s Rating', 'On %s Ratings', $ratings, 'ttg-reaktions' ), $ratings );
				} else {
					echo esc_attr__('Ratings', 'ttg-reaktions');
				}
			?>
			</span>
		</span>
		<?php
		return ob_get_clean();
	}
}

