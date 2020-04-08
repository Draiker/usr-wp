<?php
/**
 * 
 * Template part for displaying posts with wide design
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

// add_filter( 'the_excerpt', 	'wpcast_the_excerpt_scremove_now', 998 );
add_filter( 'excerpt_length', 'wpcast_excerpt_length_100', 999 );

?>
<article id="post-wide-<?php the_ID(); ?>" <?php post_class('wpcast-post wpcast-post__wide'); ?>>
	<div class="wpcast-post__header wpcast-primary-light wpcast-card  wpcast-negative">
		<div class="wpcast-bgimg">
			<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'wpcast-squared-m', array( 'class' => 'wpcast-post__thumb') ); } ?>
		</div>
		<div class="wpcast-post__headercont">
			<?php
			get_template_part( 'template-parts/post/seriename' ); 
			get_template_part( 'template-parts/shared/actions' ); 
			get_template_part( 'template-parts/post/item-metas' ); 
			get_template_part( 'template-parts/post/category' ); 
			get_template_part( 'template-parts/post/issticky' );
			?>
		</div>
	</div>
	<div class="wpcast-post__content">
		<h4 class="wpcast-post__title wpcast-cutme-t-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<p class="wpcast-meta wpcast-small">
			<?php get_template_part( 'template-parts/shared/author-date' );  ?>		
		</p>
		<div class="wpcast-post__ex wpcast-small">
			<?php  
			the_excerpt(); 
			?>
		</div>
		<p class="wpcast-readm wpcast-small"><a href="<?php the_permalink( ); ?>" ><?php esc_html_e("Read more", 'wpcast'); ?> <i class='material-icons'>trending_flat</i></a></p>
	</div>
</article>
<?php  
add_filter( 'excerpt_length', 'wpcast_excerpt_length', 999 );