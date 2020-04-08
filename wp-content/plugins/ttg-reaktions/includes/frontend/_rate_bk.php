<?php
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

add_shortcode( 'ttg_reaktions-rating', 'ttg_reaktions_rating');
add_shortcode( 'ttg_reaktions-rating-count', 'ttg_reaktions_ratingcount');
add_shortcode( 'ttg_reaktions-rating-raw', 'ttg_reaktions_ratingcount_raw');


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
	ob_start();
	if(get_option( "ttg_reaktions_ratings", 1 )){
		?>
			<form data-postid="<?php echo get_the_id(); ?>" class="ttg-reaktions ttg-reaktions-rating <?php  echo esc_attr($class); ?>">
				<span class=""
				<div class="ttg-reaktions-stars">
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-1" value="1" id="ttg-reaktions-star-1" /><label class="ttg-reaktions-star-1" for="ttg-reaktions-star-1">1</label>
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-2" value="2" id="ttg-reaktions-star-2" /><label class="ttg-reaktions-star-2" for="ttg-reaktions-star-2">2</label>
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-3" value="3" id="ttg-reaktions-star-3" /><label class="ttg-reaktions-star-3" for="ttg-reaktions-star-3">3</label>
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-4" value="4" id="ttg-reaktions-star-4" /><label class="ttg-reaktions-star-4" for="ttg-reaktions-star-4">4</label>
					<input type="radio" name="ttg-reaktions-star" class="ttg-reaktions-star-5" value="5" id="ttg-reaktions-star-5" /><label class="ttg-reaktions-star-5" for="ttg-reaktions-star-5">5</label>
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

		$avg = round(get_post_meta(get_the_id(), "ttg_rating_average", true), 2);
		if($avg == 0){ 
			$class .= 'ttg-noratings'; 
		}
		?>
		<span class="ttg-Ratings-Avg ttg-reaktions ttg-reaktions-btn ttg-reaktions-readonly <?php  echo esc_attr($class); ?>">
			<i class="reakticons-star-two"></i> <?php echo round(esc_attr($avg), 2); ?>
		</span>
		<?php  
	
		
		$ratings = get_post_meta(get_the_id(), "ttg_rating_amount", true);
		if(($ratings && $ratings > 0)){
			?>
			<span data-none="<?php echo esc_attr__('No ratings yet', 'ttg-reaktions' ); ?>" data-novote="<?php echo esc_attr__('Already voted!', 'ttg-reaktions' ); ?>" data-single="<?php echo esc_attr__('Rating', 'ttg-reaktions' ); ?>" data-multi="<?php echo esc_attr__('Ratings', 'ttg-reaktions' ); ?>" class="ttg-reaktions ttg-Ratings-Amount ttg-reaktions-btn ttg-reaktions-readonly <?php  echo esc_attr($class); ?>">
			<?php
				echo sprintf( _n( 'On %s Rating', 'On %s Ratings', $ratings, 'ttg-reaktions' ), $ratings );
			?>
			</span>
			<?php
		}
		return ob_get_clean();
	}
}

