<?php
/**
 * 
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('wpcast-post wpcast-post__std wpcast-paper wpcast-card'); ?>>

	<div class="wpcast-post__header wpcast-primary-light">
		<?php if( has_post_thumbnail( )){ ?>
			<div class="wpcast-bgimg"><?php the_post_thumbnail( 'large' ); ?></div>
		<?php } ?>
		<div class="wpcast-post__headercont">
			
			<?php  
				// Podcast serie goes here
			/**
			 * [$category Array of categories]
			 * @var [array]
			 * We want only the first category
			 */
			

			/// 
			/// 
			/// 
			/// cambiare qua prendere la serie per i podcast,
			/// fare tutto programma per vedere se uso plugin e che tassonomia è la serie
			/// 
			/// 
			/// 
			/*$category = get_the_category(); 
			$limit = 0;
			if( count($category) >= 1 ){
				?>
				<p class="wpcast-caption">
					<a href="<?php echo get_category_link($category[0]->term_id ); ?>"><?php echo esc_html($category[0]->cat_name); ?></a>
				</p>
				<?php
			}*/
			?>

			<?php  
			get_template_part( 'template-parts/post/item-metas' );
			?>


			<?php  
			/**
			 * [$category Array of categories]
			 * @var [array]
			 * We want only the first category
			 */
			$category = get_the_category(); 
			$limit = 0;
			if( count($category) >= 3 ){
				/**
				 * [$category Array of categories]
				 * @var [array]
				 * We want only the first category
				 */
				?><p class="wpcast-cats"><?php  
				$category = get_the_category(); 
				$limit = 3;
				foreach($category as $i => $cat){
					if($i > $limit){	
						continue;
					}
					?><a href="<?php echo get_category_link($cat->term_id ); ?>"><?php echo esc_html($cat->cat_name); ?></a><?php
				}
				?></p>
				<?php
			}
			?>
		</div>
	</div>

	<div class="wpcast-post__content">
		<h3 class="wpcast-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p class="wpcast-meta wpcast-small">
			<i class="material-icons">face</i> <?php the_author(); ?> <i class="material-icons">event</i> <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
		</p>
		<?php 
		$excerpt = get_the_excerpt();
		if ( $excerpt ){ 
			?>
			<p class="wpcast-small wpcast-post__exce"><?php echo get_the_excerpt(); ?></p>
			<?php  
		}
		?>
	</div>


</article>