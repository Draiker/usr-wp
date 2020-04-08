
<?php  
/**
 * Off canvas
 */
?>
<nav id="wpcastOverlay" class="wpcast-overlay wpcast-paper">
	<div class="wpcast-overlay__closebar"><span class="wpcast-btn wpcast-btn__r"  data-wpcast-switch="wpcast-overlayopen" data-wpcast-target="#wpcastBody"> <i class="material-icons">close</i></span></div>

	<?php  
	/**
	 * =======================================================
	 * MOBILE ONLY
	 * =======================================================
	 */
	?>
	<div class="wpcast-hide-on-large-only">
		<?php

		/**
		 * Primary menu - mobile sidebar
		 */
		if ( has_nav_menu( 'wpcast_menu_primary' ) ) { 
			?>
			<ul class="wpcast-menu-tree">
				<?php
				wp_nav_menu( array (
					'theme_location' => 'wpcast_menu_primary',
					'depth' => 3,
					'container' => false,
					'items_wrap' => '%3$s'
				) );
				?>
			</ul>
			<?php 
		} 

		/**
		 * Secondary menu - mobile sidebar
		 */
		if ( has_nav_menu( 'wpcast_menu_secondary' ) ) { 
			?>
			<ul class="wpcast-menu-tree wpcast-menu-tree__secondary">
				<?php  
					wp_nav_menu( array(
						'theme_location' => 'wpcast_menu_secondary',
						'depth' => 1,
						'container' => false,
						'items_wrap' => '%3$s'
					) );
				?>
			</ul>
			<?php 
		} 
		?>
	</div>
	<?php  
	/**
	 * =======================================================
	 * MOBILE ONLY END
	 * =======================================================
	 */
	?>

	<?php  
	/**
	 * =======================================================
	 * DESKTOP ONLY
	 * =======================================================
	 */
	?>
	<div class="wpcast-hide-on-large-and-down">
		<?php 
		/**
		 * Primary menu - mobile sidebar
		 */
		if ( has_nav_menu( 'wpcast_menu_desktop_off' ) ) { 
			?>
			<ul class="wpcast-menu-tree">
				<?php
				wp_nav_menu( array (
					'theme_location' => 'wpcast_menu_desktop_off',
					'depth' => 3,
					'container' => false,
					'items_wrap' => '%3$s'
				) );
				?>
			</ul>
			<?php 
		} 
		?>
	</div>
	<?php  
	/**
	 * =======================================================
	 * DESKTOP ONLY END
	 * =======================================================
	 */
	?>

	<?php  
	/**
	 * =======================================================
	 * OFF CANVAS SIDEBAR
	 * =======================================================
	 */
	if( is_active_sidebar( 'wpcast-offcanvas-sidebar' ) ){
		?>
		<div id="wpcastSidebarOffcanvas" role="complementary" class="wpcast-sidebar wpcast-sidebar__secondary wpcast-sidebar__offcanvas">
			<ul class="wpcast-row">
				<?php dynamic_sidebar( 'wpcast-offcanvas-sidebar' ); ?>
			</ul>
		</div>
		<?php 
	}
	/**
	 * =======================================================
	 * OFF CANVAS SIDEBAR END
	 * =======================================================
	 */
	?>



</nav>