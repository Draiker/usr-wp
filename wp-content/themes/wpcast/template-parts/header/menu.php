<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */
?>
<div id="wpcastMenu" class="wpcast-menu wpcast-paper">
	<div class="wpcast-menu__cont">
		<h3 class="wpcast-menu__logo wpcast-left">
			<a class="wpcast-logolink" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				echo wpcast_show_logo('_header_mob');
				echo wpcast_show_logo('_header');
				?>
			</a>
		</h3>


		<?php if ( has_nav_menu( 'wpcast_menu_primary' ) ) { ?>
			<nav class="wpcast-menu-horizontal">
				<ul class="wpcast-menubar">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'wpcast_menu_primary',
					'depth' => 3,
					'container' => false,
					'items_wrap' => '%3$s'
				));
				?>
				</ul>
			</nav>
		<?php } ?>

		<?php  ?>



		<span class="wpcast-btn wpcast-btn__r" data-wpcast-switch="open" data-wpcast-target="#wpcastSearchBar"><i class='material-icons'>search</i></span>
		
		<?php 
		/**
		 * ===========================================
		 * Off canvas menu button
		 * IMPORTANT: we display this in desktop only if there is an offcanvas menu or widgets
		 * ===========================================
		 */


		$btn_classes = array();
		if ( !has_nav_menu( 'wpcast_menu_desktop_off' ) &&  !is_active_sidebar( 'wpcast-offcanvas-sidebar' )  ) {
			// No reason to display the button in desktop
			$btn_classes[] = 'wpcast-hide-on-large-only';
		}
		if ( !has_nav_menu( 'wpcast_menu_primary' ) && !has_nav_menu( 'wpcast_menu_secondary' ) &&  !is_active_sidebar( 'wpcast-offcanvas-sidebar' )  ) {
			// No reason to display the button in desktop
			$btn_classes[] = 'wpcast-hide-on-large-and-down';
		}
			?>
			<span class="wpcast-btn wpcast-btn__r <?php echo esc_attr( implode(' ', $btn_classes ) ); ?>" >
				<i class="material-icons" data-wpcast-switch="wpcast-overlayopen" data-wpcast-target="#wpcastBody">menu</i>
			</span>
			<?php 
		/**
		 * ============================================
		 * END OF Off canvas menu button
		 * ============================================
		 */
		?>


		<?php  
		/**
		 * Call to action
		 */
		$cta_on = get_theme_mod( 'wpcast_cta_on' );
		if( $cta_on ){
			$cta = get_theme_mod( 'wpcast_cta_text', 'Subscribe' );
			$icon = get_theme_mod( 'wpcast_cta_i', 'rss_feed');

			?>
			<a id="<?php  echo esc_attr( get_theme_mod( 'wpcast_cta_id' , 'wpcastCta' ) ); ?>" target="_blank" class="wpcast-btn wpcast-btn-primary <?php if( $icon ){ ?>wpcast-icon-l<?php } ?> <?php  echo esc_attr( get_theme_mod( 'wpcast_cta_class' ) ); ?>"  href="<?php echo esc_attr( get_theme_mod( 'wpcast_cta_ur' , get_feed_link( ) ) ); ?>">
				<?php if( $icon ){ ?><i class="material-icons"><?php echo esc_attr( $icon ); ?></i><?php } ?>
				<?php echo esc_html( $cta ); ?>
			</a>
			<?php
		}
		?>
	</div>

	<?php  
	/**
	 * Search bar
	 * ============================= */
	get_template_part( 'template-parts/header/search' );
	?>

</div>