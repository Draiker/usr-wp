<?php
/**
 * Seriously Simple Podcasting compatibility
 * disable the SSP archive template from page dropdown
 * if the plugin is not active
 */
function wpcast_remove_ssp_page_template() {
	if ( ! defined( 'SSP_VERSION' ) ) {
	    global $pagenow;
	    if ( in_array( $pagenow, array( 'post-new.php', 'post.php') ) && get_post_type() == 'page' ) { ?>
	        <script type="text/javascript">
	            (function($){
	                $(document).ready(function(){
	                    $('#page_template option[value="taxonomy-series.php"]').remove();
	                })
	            })(jQuery)
	        </script>
	    <?php 
	    }
	}
}
add_action('admin_footer', 'wpcast_remove_ssp_page_template', 10);