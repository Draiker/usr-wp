<?php
/**
 * 
 * Template part for displaying posts with Hero design (title in image)
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/


?>
<article id="post-hero-<?php the_ID(); ?>" <?php post_class('wpcast-post wpcast-post__hero wpcast-card'); ?>>
	<div class="wpcast-post__header wpcast-darkbg  wpcast-negative">
		<div class="wpcast-bgimg">
			<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'large', array( 'class' => 'wpcast-post__thumb') ); } ?>
		</div>
		<div class="wpcast-post__headercont">
			<?php 
			get_template_part( 'template-parts/post/seriename' ); 
			get_template_part( 'template-parts/shared/actions' ); 
			get_template_part( 'template-parts/post/item-metas' ); 
			?>
			<div class="wpcast-post__hero__caption">
				
				<h3 class="wpcast-post__title wpcast-cutme-t-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="wpcast-meta wpcast-small">
					<?php get_template_part( 'template-parts/shared/author-date' );  ?>		
				</p>
				<?php  
				get_template_part( 'template-parts/post/category' ); 
				?>

			</div>
		</div>
	</div>
</article>