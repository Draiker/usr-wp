<?php  
/**
Package: Wpcast Widgets
Description: archives card list
Version: 0.0.0
Author: QantumThemes
Author URI: http://www.qantumthemes.xyz
 */
?>
<?php

add_action( 'widgets_init', 'wpcast_widgets_cards' );
function wpcast_widgets_cards() {
	register_widget( 'wpcast_widgets_cards' );
}
class wpcast_widgets_cards extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'cardswidget', 'description' => esc_attr__('List of posts using featured card', "wpcast-widgets") );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wpcast_widgets_cards' );
		parent::__construct( 'wpcast_widgets_cards', esc_attr__('Wpcast Archives Cards Widget', "wpcast-widgets"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		echo $before_widget;
		if(array_key_exists('title', $instance)) {
			if( $instance['title'] !== '' ){
				echo $before_title.apply_filters("widget_title", $instance['title']).$after_title; 
			}
		}
		if(!array_key_exists('posttype', $instance)) {
			$instance['posttype'] = 'post';
		}
		//Send our widget options to the query
		if($instance['posttype'] !== ''){
			if(!post_type_exists( $instance['posttype'] )) {
				echo esc_attr__("ALERT: This is a custom post type. Please install TTG Core plugin to correctly visualize the contents.", "wpcast-widgets");
				return;
			}
		}
		$queryArray =  array(
			'post_type' => $instance['posttype'],
			'posts_per_page' => array_key_exists('number',$instance)? $instance['number'] : 5 ,
			'ignore_sticky_posts' => 1,
			'order' => 'ASC'
		);
		if(array_key_exists('specificid', $instance)) {
			if($instance['specificid'] != ''){
				$posts = explode(',',$instance['specificid']);
				$finalarr = array();
				foreach($posts as $p){
					if(is_numeric($p)){
						$finalarr[] = $p;
					}
				};
				$queryArray['post__in'] = $finalarr;
			}
		}

		$queryArray['orderby'] = 'date';
		if(array_key_exists('order', $instance)) {
			$queryArray['orderby'] = $instance['order'];
		}
		if(array_key_exists('orderby', $instance)) {
			if($queryArray['orderby'] == 'date') {
				$queryArray['order'] = 'DESC';
			}
		}
		

		// ========== POSTS ONLY QUERY =========================
		if(array_key_exists('posttype', $instance)) {
			if ($instance['posttype'] === 'post') {
				$queryArray['orderby'] = 'date';
				$queryArray['order']   = 'DESC';
			}
		}
		// ========== END OF POSTS ONLY QUERY ==================
		 
		// =========== REAKTIONS QUERY =========================
		if(array_key_exists('order', $instance)) {
			if ($instance['order'] === 'views') {
				$queryArray['orderby'] = 'meta_value_num';
				$queryArray['order']   = 'DESC';
				$queryArray['meta_key'] = 'ttg_reaktions_views';
			}
			if ($instance['order'] === 'love') {
				$queryArray['orderby'] = 'meta_value_num';
				$queryArray['order']   = 'DESC';
				$queryArray['meta_key'] = 'ttg_reaktions_votes_count';
			}
			if ($instance['order'] === 'rating') {
				$queryArray['orderby'] = 'meta_value_num';
				$queryArray['order']   = 'DESC';
				$queryArray['meta_key'] = 'ttg_rating_average';
			}
		}
		// =========== REAKTIONS QUERY END =====================

		$reaktions = array("views", "loveit", "rating");
		foreach($reaktions as $r){
			${$r} = false;
			if(array_key_exists($r, $instance)){
				if($instance[$r] == "1"){ 
					${$r} = true;
				}
			}
		}

		$index = 1;
		$query = new WP_Query($queryArray);
		?>
		<div class="qt-archives-widget">

			<?php
			/**
			 *
			 * List template loop
			 * Run the control before the loop to save cpu
			 * 
			 */
			
			

			if(!array_key_exists('showthumbnail', $instance)) {
				$instance['showthumbnail'] = true;
			}


			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
				$post = $query->post;
				setup_postdata( $post );
				
				get_template_part('template-parts/post/post-card'); 
				$index++;
			endwhile; endif; 
			?>
		</div>
		<?php 
			if(array_key_exists('archivelink_url', $instance)) {
				if($instance['archivelink_url'] != ''){
					if($instance['archivelink_text']==''){$instance['archivelink_text'] = esc_attr__('See all',"wpcast-widgets");};
					echo '<a href="'.esc_url($instance['archivelink_url']).'" class="wpcast-btn wpcast-btn__s  wpcast-icon-r">'.esc_attr($instance['archivelink_text']).'<i class="material-icons">chevron_right</i></a>';
				}
			} 
		?>
		<?php
		wp_reset_postdata();
		echo $after_widget;
	}

	//Update the widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML 

		$attarray = array(
				'title',
				'number',
				'specificid',
				'order',
				'archivelink_text',
				'posttype',
				'archivelink_url',
		);

		if(!is_numeric($new_instance['number'])){
			$new_instance['number'] = 5;
		}

		$new_instance['archivelink_url'] = esc_url($new_instance['archivelink_url']);

		foreach ($attarray as $a){
			$instance[$a] = esc_attr(strip_tags( $new_instance[$a] ));
		}
		return $instance;
	}

	function form ( $instance ) {
		//Set up some default widget settings.
		$defaults = array( 'title' => "",
							'number'=> '5',
							'specificid'=> '',
							'order'=> 'menu_order',
							'posttype'=> 'post',
							'rating' => 0,
							'archivelink_text'=> esc_attr__('See all',"wpcast-widgets"),
							'archivelink_url' => ''
							);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<h2>General options</h2>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_attr__('Title:', "wpcast-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<?php  

		$args = array(
		   'public'   => true,
		   '_builtin' => false
		);
		$custom_types = get_post_types( $args ); 
		$post_types[] = 'post';
		$post_types = array_merge($post_types, $custom_types);
		if( count( $post_types ) > 1 ){
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'posttype' ); ?>"><?php echo esc_attr__('Post type', "wpcast-widgets"); ?></label><br>
			<?php  
			$args = array(
			   'public'   => true,
			   '_builtin' => false
			);
			$custom_types = get_post_types( $args ); 
			$post_types[] = 'post';
			$post_types = array_merge($post_types, $custom_types);
			?>
			<select id="<?php echo $this->get_field_id( 'posttype' ); ?>" name="<?php echo $this->get_field_name( 'posttype' ); ?>">
			<?php foreach ( $post_types as $post_type ) { ?>
					<option value="<?php echo esc_attr($post_type); ?>" <?php if($instance['posttype'] === $post_type): ?> selected="selected" <?php endif; ?>><?php echo esc_attr($post_type); ?></option>
			<?php } ?>
			</select>
		</p>
		<?php  
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'specificid' ); ?>"><?php echo esc_attr__('Add only specific ids (comma separated like: 23,46,94)', "wpcast-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'specificid' ); ?>" name="<?php echo $this->get_field_name( 'specificid' ); ?>" value="<?php echo $instance['specificid']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo esc_attr__('Quantity:', "wpcast-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php echo esc_attr__('Order', "wpcast-widgets"); ?></label><br />			
			<input type="radio" name="<?php echo $this->get_field_name( 'order' ); ?>" value="menu_order" <?php if($instance['order'] == 'menu_order'){ echo ' checked= "checked" '; } ?> /><?php echo esc_attr__("Page order","wpcast-widgets"); ?><br>
			<input type="radio" name="<?php echo $this->get_field_name( 'order' ); ?>" value="date" <?php if($instance['order'] == 'date'){ echo ' checked= "checked" '; } ?> /><?php echo esc_attr__("Date","wpcast-widgets"); ?><br>
			<!-- ====== REAKTIONS OPTIONS =========== -->
			<input type="radio" name="<?php echo $this->get_field_name( 'order' ); ?>" value="views" <?php if($instance['order'] == 'views'){ echo ' checked= "checked" '; } ?> /><?php echo esc_attr__("Views","wpcast-widgets"); ?><br>
			<input type="radio" name="<?php echo $this->get_field_name( 'order' ); ?>" value="love" <?php if($instance['order'] == 'love'){ echo ' checked= "checked" '; } ?> /><?php echo esc_attr__("Love","wpcast-widgets"); ?><br>
			<!-- <input type="radio" name="<?php echo $this->get_field_name( 'order' ); ?>" value="rating" <?php if($instance['order'] == 'rating'){ echo ' checked= "checked" '; } ?> /><?php echo esc_attr__("Rating","wpcast-widgets"); ?><br> -->
			<!-- ====== REAKTIONS OPTIONS END =========== -->
			<input type="radio" name="<?php echo $this->get_field_name( 'order' ); ?>" value="rand" <?php if($instance['order'] == 'Random'){ echo ' checked= "checked" '; } ?> /><?php echo esc_attr__("Random","wpcast-widgets"); ?>  
		</p>  
		<p>
			<label for="<?php echo $this->get_field_id( 'archivelink_text' ); ?>"><?php echo esc_attr__('Link to archive text:', "wpcast-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'archivelink_text' ); ?>" name="<?php echo $this->get_field_name( 'archivelink_text' ); ?>" value="<?php echo $instance['archivelink_text']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'archivelink_url' ); ?>"><?php echo esc_attr__('Link to archive URL:', "wpcast-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'archivelink_url' ); ?>" name="<?php echo $this->get_field_name( 'archivelink_url' ); ?>" value="<?php echo $instance['archivelink_url']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}
?>