<?php
/**
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<?php wp_head(); ?>
	</head>
	<body id="wpcastBody" <?php body_class('wpcast-body'); ?>>
		<div id="wpcastGlobal" class="wpcast-global">
			
			<?php  
			/**
			 * ======================================================
			 * Load menu bar
			 * ======================================================
			 */
			get_template_part( 'template-parts/header/header' );

			?>

			<?php  
			/**
			 * ======================================================
			 * Global hook used by our plugin to add special functions
			 * as ajax page loading or more
			 * ======================================================
			 */
			do_action( 'qantumthemes-before-maincontent' );
			?>