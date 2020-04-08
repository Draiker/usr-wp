<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */

?>	
		<?php  
		/**
		 * ======================================================
		 * Global hook used by our plugin to add special functions
		 * as ajax page loading or more
		 * ======================================================
		 */
		do_action( 'qantumthemes-after-maincontent' );
		?>
		<div id="wpcastFooter" class="wpcast-footer">
			<?php 

			/**
			 * ======================================================
			 * Load footer block with logo, menu and social
			 * ======================================================
			 */
			get_template_part( 'template-parts/footer/footer-menu' ); 
		
			/**
			 * ======================================================
			 * Load footer copyright bar. Can set in customizer
			 * ======================================================
			 */
			get_template_part( 'template-parts/footer/copyright-bar' ); 
			
			?>
		</div>
	</div><!-- end of .wpcast-globacontainer -->
	<?php wp_footer(); ?>
	</body>
</html>