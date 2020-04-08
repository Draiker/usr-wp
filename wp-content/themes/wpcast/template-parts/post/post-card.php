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
<article <?php post_class('wpcast-post wpcast-post__card wpcast-card wpcast-darkbg wpcast-negative'); ?>>
	<div class="wpcast-bgimg">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'wpcast-squared-m', array( 'class' => 'wpcast-post__thumb') ); } ?>
	</div>
	<div class="wpcast-post__headercont">
		<?php  get_template_part( 'template-parts/post/seriename' );  ?>
		<div class="wpcast-post__card__cap">
			<?php  
			get_template_part( 'template-parts/post/category' ); 
			?>
			<h5 class="wpcast-post__title wpcast-cutme-t-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<p class="wpcast-meta wpcast-small">
				<?php get_template_part( 'template-parts/shared/author-date' );  ?>		
			</p>
		</div>
	</div>
</article>