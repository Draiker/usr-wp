<?php  
/**
 * @package ttg-reaktions
 * @author Themes2Go
 * 
 */

add_shortcode( 'ttg_reaktions-social', 'ttg_reaktions_social');

/**
 *
 * 
 * [ttg_reaktions_social Creates social sharing functions]
 * @return [html] [social sharing buttons]
 *
 * 
 */

function ttg_reaktions_encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}


function ttg_reaktions_social( $class = false ){
	$pageurl = ttg_reaktions_encodeURIComponent(get_permalink( get_the_ID() ) );
	$socials = array(
		"facebook" 		=>  'https://www.facebook.com/sharer/sharer.php?u='.$pageurl,
		"twitter" 		=>  'https://twitter.com/share?url='.$pageurl,
		"googleplus" 	=>  'https://plus.google.com/share?url='.$pageurl,
		"pinterest" 	=>  'https://pinterest.com/pin/create/bookmarklet/?url='.$pageurl
	);
	ob_start();
	foreach ($socials as $var => $url){
		if(get_option( "ttg_reaktions_".$var, 1 )){
			?>
			<a href="<?php echo esc_url($url); ?>" class="qt-popupwindow ttg-reaktions-btn ttg-btn-share ttg-btn-shareaction ttg-btn-<?php echo $var ?> <?php  echo esc_attr($class); ?> tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo esc_attr__("Share on", "ttg-reaktions" ); ?> <?php echo $var ?>" ><span class="reakticons-<?php echo $var ?>"></span></a>
			<?php
		}
	}
	return ob_get_clean();
}



function ttg_reaktions_social_sc(){
	ob_start();
	?>
	<div class="ttg-reaktions-all">

	<?php echo ttg_reaktions_social(); ?>

	</div>
	<?php  
	return ob_get_clean();
}



