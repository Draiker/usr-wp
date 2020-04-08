<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */
?>
<div id="wpcastSecondaryHeader" class="wpcast-secondaryhead wpcast-primary">
	<div class="wpcast-secondaryhead__cont">
		<?php 

		/**
		 * ======================================================
		 * Secondary menu
		 * ======================================================
		 */
		
		if ( has_nav_menu( 'wpcast_menu_secondary' ) ) { 
			?>
			<ul class="wpcast-menubar wpcast-menubar__secondary">
				<?php  
					wp_nav_menu( array(
						'theme_location' => 'wpcast_menu_secondary',
						'depth' => 1,
						'container' => false,
						'link_before' => '<i class="dripicons-chevron-right"></i>',
						'items_wrap' => '%3$s'
					) );
				?>
			</ul>
			<?php 
		} 
		?>

		<?php 

		/**
		 * ======================================================
		 * Social icons
		 * ------------------------------------------------------
		 * Display list of social icon links from customizer
		 * ======================================================
		 */
		
		if (function_exists( 'wpcast_qt_socicons_array' )){
			$social = wpcast_qt_socicons_array();
			krsort($social);
			$icons_amount = 0;
			foreach($social as $var => $val){
				$link = get_theme_mod( 'wpcast_social_'.$var );
				if($link){
					$icons_amount = $icons_amount + 1;
				}
			}
			/**
			 * Print the P only if there are social icons from the customizer
			 */
			if ( $icons_amount > 0) {
				?>
				<div class="wpcast-social wpcast-right">
					<?php  
					foreach($social as $var => $val){
						$link = get_theme_mod( 'wpcast_social_'.$var );
						if($link){
							?>
							<a href="<?php echo esc_url($link); ?>" target="_blank"><i class="qt-socicon-<?php echo esc_attr($var); ?> qt-socialicon"></i></a>
							<?php
						}
					}
					?>
				</div>
				<?php
			}
		} 
		?>

	</div>
</div>