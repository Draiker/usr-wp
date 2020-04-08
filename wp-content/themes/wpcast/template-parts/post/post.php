<?php
/**
 * 
 * Template part for displaying posts default style
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/


?>
<article id="post-id-<?php the_ID(); ?>" <?php post_class('wpcast-post wpcast-post__std wpcast-paper wpcast-card'); ?>>
	
	<?php 
	if( has_post_thumbnail( ) ){
		?>
		<div class="wpcast-post__header wpcast-primary-light  wpcast-negative">
			<?php the_post_thumbnail( 'large', array( 'class' => 'wpcast-post__thumb') ); ?>
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
		<?php 
	} 
	?>

	<div class="wpcast-post__content">
		<?php 
		/**
		 * Alternative block for posts without featured image
		 */
		if( false == has_post_thumbnail( ) ){ 
			get_template_part( 'template-parts/post/category' ); 
		} 
		?>
		
		<h4 class="wpcast-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		
		<p class="wpcast-meta wpcast-small">
			<?php get_template_part( 'template-parts/shared/author-date' );  ?>
		</p>

		<div class="wpcast-small">
			<?php the_excerpt(); ?>
		</div>

	</div>

</article>