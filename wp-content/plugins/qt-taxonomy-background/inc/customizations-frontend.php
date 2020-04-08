<?php  

// Generate frontend css classes for the colors
// 

if(!function_exists('qt_taxonomy_background__styles')){
	add_action('wp_head','qt_taxonomy_background__styles',1002);

	function qt_taxonomy_background__styles(){


		?>
		<!-- QT Taxonomy Backgorund plugin start ========= -->
		<style>

			<?php 
			ob_start();
			
			$args = array(
			  'public'   => true
			  
			); 
			$output = 'objects'; // or objects
			$operator = 'and'; // 'and' or 'or'
			$taxonomies = get_taxonomies( $args, $output, $operator ); 
			$exclude = array( 'post_tag', 'post_format', 'series' );
			foreach($taxonomies as $var => $taxonomy){
				if( in_array( $taxonomy->name, $exclude ) ) {
					continue;
				}
				$term_args = array(
					'taxonomy' => $taxonomy->name
				);
				$term_args = array(
					'hide_empty' => false, // also retrieve terms which are not used yet
					'meta_query' => array(
					   'relation' => 'AND',
						array(
							'key'     => 'qt_taxonomy_color',
							'compare' => 'EXISTS',
						),
					),
					'taxonomy'  => $taxonomy->name
				);
				$terms = get_terms( $term_args );
				foreach( $terms as $term ){
					$color = get_term_meta( $term->term_id, 'qt_taxonomy_color', true );
					?>[class$="-catid-<?php echo esc_html($term->term_id); ?>"]::before { background: <?php echo esc_html( $color ); ?>; } <?php
				}
			}
			$output = ob_get_clean();
			$output = str_replace(array("	","\n","  "), " ", $output);
			$output = str_replace("  ", " ", $output);
			$output = str_replace("  ", " ", $output);
			$output = str_replace(" { ", "{", $output);
			$output = str_replace("} .", "}.", $output);
			$output = str_replace("; }", ";}", $output);
			$output = str_replace(", .", ",.", $output);
			echo wp_kses_post( $output );
			?>
		</style>
		<!-- QT Taxonomy Backgorund plugin END ========= -->
		<?php
	}

}

