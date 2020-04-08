<?php
/**
 * @package wpcast
 * @version 1.0.0
 */

if(!function_exists('wpcast_hex2rgba')){
function wpcast_hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	if(empty($color)) {
		return $default; 
	}
	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}
	if (strlen($color) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
			return $default;
	}
	$rgb =  array_map('hexdec', $hex);
	if($opacity == false && $opacity != 0){
		$opacity = 1;
	}
	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	return $output;
}}


if(!function_exists('wpcast_theme_customizations')){
	add_action('wp_head','wpcast_theme_customizations',1000);
	function wpcast_theme_customizations(){
		$rgba_hover = wpcast_hex2rgba(  get_theme_mod( 'wpcast_accent_h', '#00d7df' ) , 0.5 );
		?>
		<!-- THEME CUSTOMIZATIONS start ========= -->
		<style>
			body, blockquote::before, .qt-ajax-pageload::after { background-color: <?php echo esc_attr( get_theme_mod( 'wpcast_bg', '#f6f6f6' )); ?>; color: <?php echo esc_attr( get_theme_mod( 'wpcast_color', '#777777' )); ?>; }
			.wpcast-comments-section .comment-respond { background-color: <?php echo esc_attr( get_theme_mod( 'wpcast_bg', '#f9f9f9' )); ?>; }
			a { color: <?php echo esc_attr( get_theme_mod( 'wpcast_accent', '#00a8c6' )); ?>; }
			.wp-block-separator { border-color: <?php echo esc_attr( wpcast_hex2rgba( get_theme_mod( 'wpcast_color', '#777777' ) , 0.66 )); ?> ; }
			.wpcast-entrycontent p.has-drop-cap, .wpcast-entrycontent blockquote, .wpcast-entrycontent .wp-block-quote, blockquote, blockquote::before, .wpcast-single .wpcast-entrycontent .wp-block-quote, .wpcast-btn { border-color: <?php echo esc_attr( wpcast_hex2rgba( get_theme_mod( 'wpcast_color', '#777777' ) , 0.2 )); ?>; }
			h1, h2, h3, h4, h5, h6 { color: <?php echo esc_attr( get_theme_mod( 'wpcast_color_cap', '#343434' )); ?>; }
			.wpcast-caption__s, .wpcast-caption__xs { color: <?php echo esc_attr( wpcast_hex2rgba( get_theme_mod( 'wpcast_color', '#777777' ) , 0.66 )); ?> }
			.wpcast-paper, .wpcast-authorbox, .wpcast-menubar ul, .wpcast-paper blockquote::before { background-color: <?php echo esc_attr( get_theme_mod( 'wpcast_paper', '#ffffff' )); ?>; }
			.wpcast-primary { background-color: <?php echo esc_attr( get_theme_mod( 'wpcast_primary', '#111618' )); ?>; }
			.wpcast-primary-light .wpcast-caption { color:  <?php echo esc_attr( wpcast_hex2rgba( get_theme_mod( 'wpcast_primary_t', '#ffffff' ) , 0.7 )); ?> }
			.wpcast-primary .wpcast-btn, .wpcast-primary-light .wpcast-caption__s, .wpcast-primary-light .wpcast-btn { border-color: <?php echo esc_attr( wpcast_hex2rgba( get_theme_mod( 'wpcast_primary_t', '#ffffff' ) , 0.2 )); ?> }
			.wpcast-primary, .wpcast-primary h1, .wpcast-primary h2, .wpcast-primary h3, .wpcast-primary h4, .wpcast-primary h5, .wpcast-primary h6,
			.wpcast-primary-light h1, .wpcast-primary-light h2, .wpcast-primary-light h3, .wpcast-primary-light h4, .wpcast-primary-light h5, .wpcast-primary-light h6  { color: <?php echo esc_attr( get_theme_mod( 'wpcast_primary_t', '#ffffff' )); ?>; }
			.wpcast-primary-light { background-color: <?php echo esc_attr( get_theme_mod( 'wpcast_primary_light', '#353535' )); ?>; color: <?php echo esc_attr( get_theme_mod( 'wpcast_primary_t', '#ffffff' )); ?>; }
			[class*="-catid-"]::before, .ttg-reaktions-accent, .wpcast-accent, .wpcast-btn-primary, .give-btn, .wpcast-scard:hover .wpcast-btn__ghost, .wpcast-menubar li::before, button.wpcast-btn-primary, .qt-ajax-pageload-blobs .blob { background-color: <?php echo esc_attr( get_theme_mod( 'wpcast_accent', '#00a8c6' )); ?>; color: <?php echo esc_attr( get_theme_mod( 'wpcast_accent_t', '#ffffff' )); ?>; }
			.wpcast-btn__white { color: <?php echo esc_attr( get_theme_mod( 'wpcast_accent', '#00a8c6' )); ?>; }
			.wpcast-form-wrapper input[type="text"]:focus, .wpcast-form-wrapper input[type="email"]:focus, .wpcast-form-wrapper input[type="password"]:focus, .wpcast-form-wrapper textarea:focus, .wpcast-menu-horizontal .wpcast-menubar > li ul, .wpcast-footer__copy, .wpcast-decor, .wpcast-caption::after, .wpcast-post__title, .wpcast-scard__t { border-color: <?php echo esc_attr( get_theme_mod( 'wpcast_accent', '#00a8c6' )); ?>; }
			.wpcast-grad-layer { background: <?php echo esc_attr( get_theme_mod( 'wpcast_accent', '#00a8c6' )); ?>; /* Old browsers */ /* FF3.6-15 */ /* Chrome10-25,Safari5.1-6 */ background: linear-gradient(45deg, <?php echo esc_attr( get_theme_mod( 'wpcast_accent', '#00a8c6' )); ?> 0%, <?php echo esc_attr( get_theme_mod( 'wpcast_accent_h', '#00d7df' )); ?> 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=<?php echo esc_attr( get_theme_mod( 'wpcast_accent', '#00a8c6' )); ?>, endColorstr='<?php echo esc_attr( get_theme_mod( 'wpcast_accent_h', '#00d7df' )); ?>',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */ }
			.wpcast-negative .wpcast-caption, .qt-negative h1, .qt-negative h2, .qt-negative h3, .qt-negative h4, .qt-negative h5, .qt-negative h6 { color: #fff; }
			@media only screen and (min-width: 1201px) { 
				a:hover { color: <?php echo esc_attr( get_theme_mod( 'wpcast_accent_h', '#00d7df' )); ?>; }
				.wpcast-btn, .wpcast-post__title a {
				  	background-image: linear-gradient(to right, <?php echo esc_attr( $rgba_hover );  ?> 100%, <?php echo esc_attr( get_theme_mod( 'wpcast_bg', '#f6f6f6' )); ?> 100%); 
				}
				.wpcast-menu-horizontal .wpcast-menubar > li ul li a { 
					background-image: linear-gradient(to right,  <?php echo esc_attr( get_theme_mod( 'wpcast_accent', '#00a8c6' )); ?> 100%, <?php echo esc_attr( get_theme_mod( 'wpcast_accent_t', '#ffffff' )); ?> 100%); 
				}
				.wpcast-btn {
					background-image: linear-gradient(to right, <?php echo esc_attr( get_theme_mod( 'wpcast_accent_h', '#00d7df' )); ?> 100%, <?php echo esc_attr( get_theme_mod( 'wpcast_bg', '#f6f6f6' )); ?> 100%);
				}
				.wpcast-btn:hover {
					border-color: <?php echo esc_attr( get_theme_mod( 'wpcast_accent_h', '#00d7df' )); ?>; 
					color: <?php echo esc_attr( get_theme_mod( 'wpcast_accent_t', '#ffffff' )); ?>; 
				}
			}
			<?php 

			/**
			 * =================================================================================
			 * Text rendering headings
			 * =================================================================================
			 */
			
			// Headings
			// =================================================================================
			$wpcast_typography_headings_r = get_theme_mod( 'wpcast_typography_headings_r', 'geometricPrecision' );
			if( $wpcast_typography_headings_r ){
				?>
				h1, h2, h3, h4, h5, h6 {
					text-rendering: <?php echo esc_attr( $wpcast_typography_headings_r ); ?>;
				}
				<?php 
			}

			//Text rendering menu, meta and buttons
			//=================================================================================
			$wpcast_typography_menu_r = get_theme_mod( 'wpcast_typography_menu_r', 'geometricPrecision' );
			if( $wpcast_typography_menu_r ){
				?>
				.wpcast-btn, .wpcast-itemmetas, .wpcast-caption, .wpcast-menu, .wpcast-secondaryhead, .wpcast-cats, .wpcast-menu-tree , button, input[type="button"], input[type="submit"], .button , .wpcast-meta {
					text-rendering: <?php echo esc_attr( $wpcast_typography_menu_r ); ?>;
				}
				<?php 
			}

			//Text rendering menu, meta and buttons
			//=================================================================================
			$wpcast_typography_text_r = get_theme_mod( 'wpcast_typography_text_r', 'geometricPrecision' );
			if( $wpcast_typography_text_r ){
				?>
				html body {
					text-rendering: <?php echo esc_attr( $wpcast_typography_text_r ); ?>;
				}
				<?php 
			}

			/**
			 * =================================================================================
			 * Footer customization
			 * =================================================================================
			 */

			// Footer background and text
			// =================================================================================
			$wpcast_footer_bg = get_theme_mod('wpcast_footer_bg');
			$wpcast_footer_t = get_theme_mod('wpcast_footer_t');
			
			if ( $wpcast_footer_bg || $wpcast_footer_t ) {
				?>
				#wpcastFooterMenu { 
					<?php if ( $wpcast_footer_bg ) { ?> background: <?php echo esc_attr( $wpcast_footer_bg ); ?>; <?php	} ?>
					<?php if ( $wpcast_footer_t ) { ?> color: <?php echo esc_attr( $wpcast_footer_t ); ?>; <?php	} ?>
				}
				<?php
			}

			// Footer Links
			// =================================================================================
			$wpcast_footer_l = get_theme_mod('wpcast_footer_l');
			if ( $wpcast_footer_l  ) { 
				?>
				#wpcastFooterMenu a {
					<?php if ( $wpcast_footer_l ) { ?> color: <?php echo esc_attr( $wpcast_footer_l ); ?>; <?php	} ?>
				}
				<?php
			}

			$wpcast_footer_lh = get_theme_mod('wpcast_footer_lh');
			if ( $wpcast_footer_lh  ) { 
				?>
				#wpcastFooterMenu a:hover {
					<?php if ( $wpcast_footer_lh ) { ?> color: <?php echo esc_attr( $wpcast_footer_lh ); ?>; <?php	} ?>
				}
				<?php
			}

			/**
			 * =================================================================================
			 * Copyright bar customization
			 * =================================================================================
			 */

			// Copyright bar background and text
			// =================================================================================
			$wpcast_copy_bg = get_theme_mod('wpcast_copy_bg');
			$wpcast_copy_t = get_theme_mod('wpcast_copy_t');
			$wpcast_copy_decor = get_theme_mod('wpcast_copy_decor');
			
			if ( $wpcast_copy_bg || $wpcast_copy_t ) {
				?>
				#wpcastCopybar { 
					<?php if ( $wpcast_copy_bg ) { ?> background: <?php echo esc_attr( $wpcast_copy_bg ); ?>; <?php	} ?>
					<?php if ( $wpcast_copy_t ) { ?> color: <?php echo esc_attr( $wpcast_copy_t ); ?>; <?php	} ?>
					<?php if ( $wpcast_copy_decor ) { ?> border-color: <?php echo esc_attr( $wpcast_copy_decor ); ?>; <?php	} ?>
				}
				<?php
			}

			// Footer Links
			// =================================================================================
			$wpcast_copy_l = get_theme_mod('wpcast_copy_l');
			if ( $wpcast_copy_l  ) { 
				?>
				#wpcastCopybar a {
					<?php if ( $wpcast_copy_l ) { ?> color: <?php echo esc_attr( $wpcast_copy_l ); ?>; <?php	} ?>
				}
				<?php
			}

			$wpcast_copy_lh = get_theme_mod('wpcast_copy_lh');
			if ( $wpcast_copy_lh  ) { 
				?>
				#wpcastCopybar a:hover {
					<?php if ( $wpcast_copy_lh ) { ?> color: <?php echo esc_attr( $wpcast_copy_lh ); ?>; <?php	} ?>
				}
				<?php
			}
			?>
		</style>
		<!-- THEME CUSTOMIZATIONS END ========= -->
		<?php 
	}
}






