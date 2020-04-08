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
<article <?php post_class('wpcast-post wpcast-post__inline '); ?>>
	<?php  
	if( has_post_thumbnail()){
	?>
	<a class="wpcast-thumb" href="<?php the_permalink(); ?>">
		<?php 
		the_post_thumbnail( 'wpcast-squared-s', array( 'class' => 'wpcast-post__thumb', 'alt' => esc_attr( get_the_title() ) ) ); 
		?>
	</a>
	<?php  
	}
	?>
	<h6><a class="wpcast-cutme-t-2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
	<p class="wpcast-meta wpcast-small">
		<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
	</p>
</article>