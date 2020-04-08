<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */
?>

<div id="wpcastHeaderBar" class="wpcast-headerbar">
	<div id="wpcastHeaderBarContent" class="wpcast-headerbar__content wpcast-paper">
		<?php  
		/**
		 * Secondary Header
		 * ============================= */
		if( get_theme_mod('wpcast_sec_head_on', '1') ){
			get_template_part( 'template-parts/header/secondary-header' );
		}


		/**
		 * Menu
		 * ============================= */
		get_template_part( 'template-parts/header/menu' );


		/**
		 * Player plugin output
		 =============================*/
		
		if(function_exists('qtmplayer_interface')){
			?>
			<div id="wpcast-Sticky" class="wpcast-primary wpcast-sticky">
				<div class="wpcast-sticky__content">
					<div class="wpcast-primary">
						<?php qtmplayer_interface(); ?>
					</div>
				</div>
			</div>
			<?php  
		}; 

		?>
	</div>
</div>

<?php  
/**
 * Off canvas
 * ============================= */
get_template_part( 'template-parts/header/offcanvas' );
?>

