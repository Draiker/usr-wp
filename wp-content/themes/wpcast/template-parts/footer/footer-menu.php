<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

?>	

<div id="wpcastFooterMenu" class="wpcast-footer__section wpcast-section wpcast-primary-light">
	<div class="wpcast-footer__content">


		<?php  
		/**
		 * ======================================================
		 * Fooer logo
		 * ------------------------------------------------------
		 * Display logo or site title
		 * ======================================================
		 */
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wpcast-footer__logo">
			<h4><?php echo wpcast_show_logo('_footer'); ?></h4>
		</a>


		<?php  
		/**
		 * ======================================================
		 * Footer menu
		 * ------------------------------------------------------
		 * Display menu for specific footer location
		 * ======================================================
		 */
		?>
		<ul class="wpcast-menubar">
			<?php 
			/**
			*  Footer left
			*  =============================================
			*/
			if ( has_nav_menu( 'wpcast_menu_footer' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'wpcast_menu_footer',
					'depth' => 1,
					'container' => false,
					'items_wrap' => '%3$s'
				));
			}
			?>
		</ul>


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
			
			if ( $icons_amount > 0) {
				?>
				<div class="wpcast-social">
					<?php  
					foreach($social as $var => $val){
						$link = get_theme_mod( 'wpcast_social_'.$var );
						if($link){
							?>
							<a href="<?php echo esc_url($link); ?>" class="wpcast-btn wpcast-btn__r wpcast-btn__white" target="_blank"><i class="qt-socicon-<?php echo esc_attr($var); ?> qt-socialicon"></i></a>
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

	<?php 
	/**
	 * ======================================================
	 * Background image
	 * ======================================================
	 */
	$bgimg = get_theme_mod( 'wpcast_footer_bgimg', false );
	if( $bgimg ){
		?> 
			<div class="wpcast-bgimg"><img src="<?php echo esc_url( $bgimg ); ?>" alt="<?php esc_attr_e('Background', 'wpcast'); ?>"></div> 
		<?php
	}


	/**
	 * ======================================================
	 * Background tone color
	 * ======================================================
	 */
	if( get_theme_mod( 'wpcast_overlay_tone', '1' ) ){
		?> 
			<div class="wpcast-grad-layer"></div>
		<?php
	}

	
	?>
	

</div>