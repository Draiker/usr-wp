<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */
?>

<div id="wpcastPagination" class="wpcast-wp-pagination ">
	<?php
	/**
	 * ==================================
	 * classic pagination numbers
	 * ==================================
	 */
	?>
	<div class="wpcast-clearfix  wpcast-col wpcast-s12 wpcast-m12 wpcast-l12">
		<div class="wpcast-pagination">
				<?php
				$args = array(
					'type' => 'plain',
					'prev_next' => true,
					'before_page_number' => '<span class="wpcast-num wpcast-btn wpcast-btn__r">',
					'after_page_number'  => '</span>',
					'mid_size' => 2,
					'prev_text'          => '<span class="wpcast-btn wpcast-icon-l"><i class="material-icons">navigate_before</i>'.esc_html__('Previous', 'wpcast').'</span>',
					'next_text'          => '<span class="wpcast-btn wpcast-icon-r">'.esc_html__('Next', 'wpcast').'<i class="material-icons">navigate_next</i></span>',
				);
				echo paginate_links( $args ); 
				?>
		</div>
	</div>
</div>
