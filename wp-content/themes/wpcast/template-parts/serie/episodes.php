<?php
/**
 * 
 * List episodes within taxonomy
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

$args = array(
	'post_type' => 'post',
	'tax_query' => array(
	    array(
	        'taxonomy' => $wpcast_query_tax,
	        'field'    =>'id',
	        'terms'    => array(  $wpcast_query_id  ), //this is by slug
	    ),
	),
);
/**
 * [$wp_query execution of the query]
 * @var WP_Query
 */
$wp_query_e = new WP_Query( $args );
if ( $wp_query_e->have_posts() ) : 

	$total = $wp_query_e->found_posts;
	?>
		<div class="wpcast-episodes">
			<h6 class="wpcast-caption wpcast-caption__s"><?php esc_html_e( 'Episodes', 'wpcast' ); ?></h6>
			<?php
			$index = 1;
			$max = 7;
			while ( $wp_query_e->have_posts() && $index < $max ) : $wp_query_e->the_post();
				$post = $wp_query_e->post;
				setup_postdata( $post );
				?>
				
					<div class="wpcast-episodes__r">
					<?php

					/**
					 * 
					 * If i have the function of the player, this becomes an action button to play a podcast
					 * Requires QT Music Player Plugin
					 * 
					 */
					
					$player = '';
					if( function_exists( 'qtmplayer_play_circle' )) {
						$atts = array(
							'id' 		=> 	$post->ID,
							'classes' 	=>	'wpcast-episodes__p'
						);
						// This is the interactive circle player
						// made by the qtmPlayer plugin
						$player = qtmplayer_play_circle( $atts );
						

					} 

					if( $player !== '' ){
						echo qtmplayer_play_circle( $atts );
					} else {
						?>
						<a href="<?php the_permalink(); ?>" class="wpcast-episodes__p"><i class="material-icons">play_arrow</i></a>
						<?php
					}

					
					// ========================================================
					?>
					
						
						<a href="<?php the_permalink(); ?>" class="wpcast-episodes__l"><?php the_title();?></a>
						
					</div>
				<?php
				wp_reset_postdata();
				$index++;
			endwhile; 
			

			// How many more?
			if( $total > $max ) {
				?><p><?php  
				echo '+ '.esc_html( $total - $max ).' '; esc_html_e( 'more', 'wpcast' ); 
				?></p><?php  
			}

			?>

		</div>
	<?php  
endif;
