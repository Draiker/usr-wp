<?php
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * Creates admin settings page
 */




/**
 * Create options page
 */
add_action('admin_menu', 'ttg_reaktions_create_optionspage');
if(!function_exists('ttg_reaktions_create_optionspage')){
	function ttg_reaktions_create_optionspage() {
		add_options_page('T2G ReAktions', 'T2G ReAktions', 'manage_options', 'ttg_reaktions_settings', 'ttg_reaktions_options');
	}
}

/**
 *  Main options page content
 */
if(!function_exists('ttg_reaktions_options')){
	function ttg_reaktions_options() {
		?>
		<h2>Themes2Go ReAktions Settings</h2>
		<?php  
		/**
		 *  We check if the use is qualified enough
		 */
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		/**
		 *  Saving options
		 */
		
		$chackboxes = array(
			"ttg_reaktions_facebook" => __("Enable Facebook share", "ttg-reaktions" ),
			"ttg_reaktions_twitter" => __("Enable Twitter share", "ttg-reaktions" ),
			// "ttg_reaktions_googleplus" => __("Enable Google share", "ttg-reaktions" ),
			"ttg_reaktions_pinterest" => __("Enable Pinterest share", "ttg-reaktions" ),
			"ttg_reaktions_tumblr" => __("Enable Tumblr share", "ttg-reaktions" ),
			"ttg_reaktions_whatsapp" => __("Enable WhatsApp share", "ttg-reaktions" ),
			"ttg_reaktions_email" => __("Enable Email share", "ttg-reaktions" ),
			"ttg_reaktions_linkedin" => __("Enable Linkedin share", "ttg-reaktions" ),
			"ttg_reaktions_love" => __("Enable love action", "ttg-reaktions" ),
			"ttg_reaktions_ratings" => __("Enable stars rating", "ttg-reaktions" ),
			"ttg_reaktions_views" => __("Enable views count", "ttg-reaktions" ),
			"ttg_reaktions_readingtime" => __("Enable reading time", "ttg-reaktions" ),
			"ttg_reaktions_commentscount" => __("Enable comments count", "ttg-reaktions" )
		);

		$textfields = array(
			"ttg_reaktions_timeout_revote" => __("Time before adding new love (minutes)", "ttg-reaktions" ),
		);


		if ( ! empty( $_POST ) ) {
			if(!check_admin_referer( 'ttg_reaktions_save', 'ttg_reaktions_nonce' )){
				echo 'Invalid request';
			} else {

				foreach($textfields as $varname => $label){
					if(isset($_POST[$varname])){
						update_option($varname, wp_kses($_POST[$varname], array() ));
					}
				}

				foreach($chackboxes as $varname => $label){
					if(isset($_POST[$varname])){
						if($_POST[$varname] == 'on'){
							update_option($varname, 1);
						} 
					} else {
						update_option($varname, 0 );
					}
				}
			}
		}

		/**
		 *  Options page content
		 */
		?>
		<div class="ttg_reaktions-framework ttg_reaktions-optionspage">
			<p class="right blue-grey-text lighten-3">V. <?php echo esc_attr(ttg_reaktions_plugin_get_version()); ?></p>
			<h2 class="ttg_reaktions-modaltitle"><?php echo esc_attr__("Settings", "ttg-reaktions"); ?></h2>
			<div class="row">
				<form method="post" class="col s12" action="<?php echo esc_url($_SERVER["REQUEST_URI"]); ?>">
					<?php
					foreach($chackboxes as $varname => $label){
					?>
						<p class="row">
							<input id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>"  type="checkbox" <?php if (get_option( $varname, 1)){ ?> checked <?php } ?>>
							<label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($label); ?></label>
						</p>
					<?php } ?>
					<?php
					foreach($textfields as $varname => $label){
					?>
						<p class="row">
							<label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($label); ?></label>
							<input id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>"  type="text" value="<?php echo esc_attr(get_option( $varname, 120)); ?>">
						</p>
					<?php } ?>
					<?php wp_nonce_field( "ttg_reaktions_save", "ttg_reaktions_nonce", true, true ); ?>
					<input type="submit" name="submit" value="Save"  class="button button-primary" />
				</form>
			</div>
			<div class="row">
			<h2>Shortcodes</h2>
			<pre>
 *	[ttg_reaktions_social Creates social sharing functions] -> returns HTML
 *	[ttg_reaktions-loveit-link --- ttg_reaktions_loveit_link Creates LOVE button] -> returns HTML
 *	[ttg_reaktions-loveit-count --- ttg_reaktions_loveit_count show number of loveit]
 *	[ttg_reaktions-rating --- 'ttg_reaktions_rating() Display the rating]
 *	[ttg_reaktions-views --- ttg_reaktions_viewsdisplay() Display number of views] -> returns HTML
 *	[ttg_reaktions-readingtime --- ttg_reaktions_readingtime() Display nestimated reading time in min-sec] -> returns HTML
 *	[ttg_reaktions-full --- ttg_reaktions_full() All the stuff]
 *
 * 	Helpers:
 *	[ttg_reaktions_viewsread Display number of views without] -> returns INTEGER
 *	[ttg_reaktions_loveit_count Display number of LOVE] -> returns INTEGER
			 </pre>
			 </div>
		</div>
		<?php 
	}
}