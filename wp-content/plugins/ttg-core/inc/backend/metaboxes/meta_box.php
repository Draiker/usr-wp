<?php

if(!defined("QTMETABOXES_VERSION")){
	define("QTMETABOXES_VERSION", "20171206");
}


/*

2018 06 08
* selected fix line 196 array format

2017 12 06 
* removed font awesome 
* removed  icon choice field

2017 11 29 * CSS update 

2017 11 09 * Added autocompile for music files in metaboxes-script.js

2017 11 02 * Ipdated file uploader now using new WordPress uploader

2017 10 21 * Added timecue input type

2017 10 21 * updated meta_box.php:190 ($post_type > $posttype)

2017 04 28 *  added check on array integrity line 863 if(array_key_exists('type', $field)) {

2017 04 25 *  added support for page template to fully hide/show a fields container adding 6th parameter to ttgcore_metabox. The parameter is the page template name (page-template.php)

2016 12 15 * added tax_select_disassociated in metaboxes

CUSTOMIZED LAST TIME 2016 003 13
* added icon modal with material icons and fontawesome icons

CUSTOMIZED LAST TIME 2016 003 10
* added page template attribute and control to display fields only when certain templates are selecte, like 'pagetemplate' => 'page-tripleview.php'
CUSTOMIZED LAST TIME 2016 01 24
* added category field with dropdown
* added gelolocation for coordinates field type 
* added tax_select_disassociated
*/

// metaboxes directory constant
if(!defined("CUSTOM_METABOXES_DIR")){
define( 'CUSTOM_METABOXES_DIR', plugins_url( '' , __FILE__ ) );
}

/**
 * recives data about a form field and spits out the proper html
 *
 * @param   array                   $field          array with various bits of information about the field
 * @param   string|int|bool|array   $meta           the saved data for this field
 * @param   array                   $repeatable     if is this for a repeatable field, contains parant id and the current integar
 *
 * @return  string                                  html for the field
 */

function custom_meta_box_field( $field, $meta = null, $repeatable = null ) {
	if ( ! ( $field || is_array( $field ) ) )
	return;
		
	$class = isset( $field['class'] ) ? $field['class'] : '';
	$template = isset( $field['template'] ) ? $field['template'] : null;
	$pagetemplate = isset( $field['pagetemplate'] ) ? $field['pagetemplate'] : null;
	$type = isset( $field['type'] ) ? $field['type'] : null;
	$label = isset( $field['label'] ) ? $field['label'] : null;
	$desc = isset( $field['desc'] ) ?  $field['desc'] : null;
	$place = isset( $field['place'] ) ? $field['place'] : null;
	$size = isset( $field['size'] ) ? $field['size'] : null;
	$posttype = isset( $field['posttype'] ) ? $field['posttype'] : null;
	$taxtype = isset( $field['taxtype'] ) ? $field['taxtype'] : null;
	$options = isset( $field['options'] ) ? $field['options'] : null;
	$repeatable_fields = isset( $field['repeatable_fields'] ) ? $field['repeatable_fields'] : null;
	
	// the id and name for each field
	$id = $name = isset( $field['id'] ) ? $field['id'] : null;

	if ( $repeatable ) {
		$name = $repeatable[0].'['.$repeatable[1].']['.$id .']';
		$id = $repeatable[0].'_'.$repeatable[1].'_'.$id;
	}


	switch( $type ) {
		// basic
		case 'text':
		case 'tel':
		case 'email':
		default:
			echo '<input type="'.esc_attr($type).'" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.esc_attr( $meta ).'" class="regular-text" size="30" />
					<span class="description">'.esc_attr($desc).'</span>';
		break;
		case 'chapter':
			//echo '<h3>'.esc_attr( $label ).'</h3>';
		break;
		case 'time':
			echo '<input type="'.esc_attr($type).'" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.esc_attr( $meta ).'" class="qwTimePicker" size="10" />
					<span class="description">'.esc_attr($desc).'</span>';
		break;
		case 'timecue':
			echo '<input type="time" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.esc_attr( $meta ).'" class="qwTimePicker" size="10" step="1" />
					<span class="description">'.esc_attr($desc).'</span>';
		break;
		case 'url':
			echo '<input type="'.esc_attr($type).'" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.esc_attr( $meta ).'" class="regular-text" size="30" />
					<span class="description">'.esc_attr($desc).'</span>';
		break;
		case 'number':
			echo '<input type="'.esc_attr($type).'" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.intval( $meta ).'" class="regular-text" size="10" />
					<span class="description">'.esc_attr($desc).'</span>';
		break;
		// textarea
		case 'textarea':
			echo '<textarea name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" cols="60" rows="4">'.esc_textarea( $meta ).'</textarea>
					<br /><span class="description">'.esc_attr($desc).'</span>';
		break;
		// editor
		case 'editor':
		 $settings = array();
			echo wp_editor( $meta, $id, $settings ).'<br />'. esc_attr($desc);
		break;
		// checkbox
		case 'checkbox':
			echo '<input type="checkbox" class="'.esc_attr( $class ).'" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" '.esc_attr(checked( $meta, true, false )).' value="1" />
					<span for="'.esc_attr( $id ).'">'. esc_attr($desc). '</span>';
		break;
		// select, chosen
		case 'select':
		case 'chosen':

			echo '<select name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'"' , $type == 'chosen' ? ' class="chosen"' : '' , isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '' , '>
					<option value="">Select One</option>'; // Select One
			foreach ( $options as $option ){
				$toreveal='';
				if(array_key_exists('revealfields', $option)){
					if(is_array($option['revealfields'])){
						$n=0;
						foreach ($option['revealfields'] as $t){
							
							$toreveal.=trim($t)."[+]";
						}
					}
				}

				$tohide='';
				if(array_key_exists('hidefields', $option)){
					if(is_array($option['hidefields'])){
						$n=0;
						foreach ($option['hidefields'] as $t){
							
							if($n<count($option['hidefields']) && $n > 0){
								$tohide .= "[+]";
							}

							$tohide.=trim($t);
							$n++;

						}
					}
				}
				echo '<option'.selected( $meta, $option['value'], false ).' value="'.esc_attr($option['value']).'" data-toreveal ="'.esc_attr($toreveal).'" data-tohide ="'.esc_attr($tohide).'" >'.esc_attr($option['label']).'</option>';

			}
			echo '</select><br />'.wp_kses_post($desc);


		break;
		// radio
		case 'radio':
			echo '<ul class="meta_box_items">';
			foreach ( $options as $option )
				echo '<li><input type="radio" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'-'.esc_attr($option['value']).'" value="'.esc_attr($option['value']).'" '.esc_attr(checked( $meta, $option['value'], false )).' />
						<label for="'.esc_attr( $id ).'-'.esc_attr($option['value']).'">'.esc_attr($option['label']).'</label></li>';
			echo '</ul><span class="description">'.esc_attr($desc).'</span>';
		break;
		// checkbox_group
		case 'checkbox_group':
			echo '<ul class="meta_box_items">';
			foreach ( $options as $option )
				echo '<li><input type="checkbox" value="'.esc_attr($option['value']).'" name="'.esc_attr( $name ).'[]" id="'.esc_attr( $id ).'-'.esc_attr($option['value']).'"' , is_array( $meta ) && in_array( $option['value'], $meta ) ? ' checked="checked"' : '' , ' /> 
						<label for="'.esc_attr( $id ).'-'.esc_attr($option['value']).'">'.esc_attr($option['label']).'</label></li>';
			echo '</ul><span class="description">'.esc_attr($desc).'</span>';
		break;
		// color
		case 'color':
			$meta = $meta ? $meta : '#';
			echo '<input type="text" class="meta_box_color" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.esc_attr($meta).'" size="10" />
				<br /><span class="description">'.esc_attr($desc).'</span>';
			
		break;
		// post_select, post_chosen
		case 'post_select':
		case 'post_list':
		case 'post_chosen':
			echo '<select data-placeholder="Select One" name="'.esc_attr( $name ).'[]" id="'.esc_attr( $id ).'"' , $type == 'post_chosen' ? ' class="chosen"' : '' , isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '' , '>
					<option value=""></option>'; // Select One
			$posts = get_posts( array( 'post_type' => $posttype, 'posts_per_page' => -1, 'orderby' => 'name', 'order' => 'ASC' ) );
			if (is_array($posts)){
				foreach ( $posts as $item ) {
					$selected = false;
					if (is_array($meta)) {
						$selected = in_array( $item->ID, $meta );
					}

					echo '<option value="'.esc_attr($item->ID).'"'.esc_attr( selected( $selected ) ).'>'.esc_attr($item->post_title).'</option>';
				}
			}
			$post_type_object = get_post_type_object( $posttype );
			echo '</select> ';
		break;


		case 'category':
			

			$wp_dropdown_categories = wp_dropdown_categories( array( 'post_type' => $posttype, 
				'posts_per_page' => -1, 
				'orderby' => 'name', 
				'order' => 'ASC' , 
				'echo' => 0 , 
				'name' => esc_attr( $name ),
				'id' => esc_attr( $id ),
				'hide_if_empty' => true,
				'value_field' => 'term_id',
				'selected' => esc_attr($meta)

				) );

			echo $wp_dropdown_categories;
			echo '<span class="description">'.esc_attr($desc).'</span>';
		break;


		// post_checkboxes
		case 'post_checkboxes':
			$posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1 ) );
			echo '<ul class="meta_box_items">';
			foreach ( $posts as $item ) 
				echo '<li><input type="checkbox" value="'.esc_attr($item->ID).'" name="'.esc_attr( $name ).'[]" id="'.esc_attr( $id ).'-'.esc_attr($item->ID).'"' , is_array( $meta ) && in_array( $item->ID, $meta ) ? ' checked="checked"' : '' , ' />
						<label for="'.esc_attr( $id ).'-'.esc_attr($item->ID).'">'.esc_attr($item->post_title).'</label></li>';
			$post_type_object = get_post_type_object( $post_type );
			echo '</ul> <span class="description">'.esc_attr($desc).'</span> &nbsp;<span class="description"></span>';
		break;
		// post_drop_sort
		case 'post_drop_sort':
			//areas
			$post_type_object = get_post_type_object( $post_type );
			echo '<p><span class="description">'.esc_attr($desc).'</span> &nbsp;<span class="description"><a href="'.admin_url( 'edit.php?post_type='.esc_attr($post_type).'">Manage '.esc_attr($post_type_object->label) ).'</a></span></p><div class="post_drop_sort_areas">';
			foreach ( $areas as $area ) {
				echo '<ul id="area-'.esc_attr($area['id']) .'" class="sort_list">
						<li class="post_drop_sort_area_name">'.esc_attr($area['label']).'</li>';
						if ( is_array( $meta ) ) {
							$items = explode( ',', $meta[$area['id']] );
							foreach ( $items as $item ) {
								
								echo '<li id="'.esc_attr($item).'">'.esc_attr( get_the_title( $item )).'</li>';
							}
						}
				echo '</ul>
					<input type="hidden" name="'.esc_attr( $name ).'['.esc_attr($area['id']).']" 
					class="store-area-'.esc_attr($area['id']).'" 
					value="' , $meta ? esc_attr($meta[$area['id']]) : '' , '" />';
			}
			echo '</div>';
			// source
			$exclude = null;
			if ( !empty( $meta ) ) {
				$exclude = implode( ',', $meta ); // because each ID is in a unique key
				$exclude = explode( ',', $exclude ); // put all the ID's back into a single array
			}
			$posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'post__not_in' => $exclude ) );
			echo '<ul class="post_drop_sort_source sort_list">
					<li class="post_drop_sort_area_name">Available '.esc_attr($label).'</li>';
			foreach ( $posts as $item ) {
				$output = $display == 'thumbnail' ? get_the_post_thumbnail( $item->ID, array( 204, 30 ) ) : get_the_title( $item->ID ); 
				echo '<li id="'.esc_attr($item->ID).'">'.esc_attr(get_the_title( $item->ID )).'</li>';
			}
			echo '</ul>';
		break;
		// tax_select
		// 
		// =======================================================================================
		case 'tax_select':
			echo '<select name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'">
					<option value=""> - </option>'; // Select One

						$terms = get_terms( $id, 'get=all' );
						$post_terms = wp_get_object_terms( get_the_ID(), $id );
						$selected= $post_terms ? $terms[0]->slug : null;

						foreach ( $terms as $term ) {
							echo '<option value="'.esc_attr($term->slug).'"'.esc_attr(selected( $meta, $term->slug, false )).'>'.esc_attr($term->name).'</option>'; 
						}
						
			echo '</select>';

			// Editing link:
			$taxonomy = get_taxonomy( $id );
			echo '</select> &nbsp;<span class="description"><a href="'. esc_url( home_url() ).'/wp-admin/edit-tags.php?taxonomy='.esc_attr($id).'">Manage '.esc_attr($taxonomy->label).'</a></span>
			<br /><span class="description">'.esc_attr($desc).'</span>';
		break;



		// tax_select_disassociated
		// 
		// by Themes2Go - Qantumthemes
		// add a taxonomy select not associated with the post, like to choose other posttype to embed
		// 
		// =======================================================================================
		case 'tax_select_disassociated':
			// echo $taxtype ;
			if($taxtype != ''){
				echo '<select name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'">
						<option value=""> - </option>
						<option value="all">'.esc_attr__("All (no filters)", "ttg-core").'</option>'; 
						$terms = get_terms( $taxtype, 'get=all' );
						if(is_array($terms)){
							foreach ( $terms as $term ) {
								echo '<option value="'.esc_attr($term->slug).'"'.esc_attr(selected( $meta, $term->slug, false )).'>'.esc_attr($term->name).'</option>'; 
							}
						}
				echo '</select>';
			} else {
				echo esc_attr__('Taxtype undefined', "ttg-core");
			}
			
			// Editing link:
			$taxonomy = get_taxonomy( $taxtype );
			echo '</select> &nbsp;<span class="description"><a href="'.  esc_url( home_url() ).'/wp-admin/edit-tags.php?taxonomy='.esc_attr($taxtype).'">Manage the '.esc_attr($taxonomy->label).'</a></span><br /><span class="description">'.esc_attr($desc).'</span>';
		break;




		// tax_checkboxes
		case 'tax_checkboxes':
			$terms = get_terms( $id, 'get=all' );
			$post_terms = wp_get_object_terms( get_the_ID(), $id );
			$checked = $post_terms ? $terms[0]->slug : null;
			foreach ( $terms as $term)
				echo '<input type="checkbox" value="'.esc_attr($term->slug).'" name="'.esc_attr($id).'[]" id="'.esc_attr($term->slug).'"'.esc_attr(checked( $checked, $term->slug, false )).' /> <label for="'.esc_attr($term->slug).'">'.esc_attr($term->name).'</label><br />';
			$taxonomy = get_taxonomy( $id);
			echo '<span class="description">'.esc_attr($field['desc']).' <a href="'. esc_url( home_url() ).'/wp-admin/edit-tags.php?taxonomy='.esc_attr($id).'&post_type='.esc_attr($page).'">Manage '.esc_attr($taxonomy->label).'</a></span>';
		break;
		// date
		case 'date':
			echo '<input type="text" class="datepicker" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.esc_attr($meta).'" size="30" />
					<br /><span class="description">'.esc_attr($desc).'</span>';
		break;
		// slider
		case 'slider':
		$value = $meta != '' ? intval( $meta ) : '0';
			echo '<div id="'.esc_attr( $id ).'-slider"></div>
					<input type="text" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.esc_attr($value).'" size="5" />
					<br /><span class="description">'.esc_attr($desc).'</span>';
		break;
		// image
		case 'image':
			$image = CUSTOM_METABOXES_DIR.'/images/image.png';  
			echo '<span class="meta_box_default_image" style="display:none">'.esc_attr($image).'</span>';
			if ( $meta ) {
				$image = wp_get_attachment_image_src( intval( $meta ), 'medium' );
				$image = $image[0];
			}               
			echo    '<input name="'.esc_attr( $name ).'" type="hidden" class="meta_box_upload_image" value="'.intval( $meta ).'" id="'.esc_attr( $id ).'" />
						<img src="'.esc_url(esc_attr( $image )).'" class="meta_box_preview_image" alt="" />
							<a href="#" class="meta_box_upload_image_button button" rel="'.get_the_ID().'">Choose Image</a>
							<small>&nbsp;<a href="#" class="meta_box_clear_image_button">Remove Image</a></small>
							<br clear="all" /><span class="description">'.esc_attr($desc).'</span>';
		break;
		// file
		case 'file':        
			echo    '<input type="text" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.esc_attr( $meta ).'" class="regular-text meta_box_upload_file_new" size="30" />

					
						<a href="#" class="meta_box_upload_file_new_button button" rel="'.get_the_ID().'">Choose File</a>


						<small>&nbsp;<a href="#" class="meta_box_clear_file_button">Remove File</a></small>
						<br clear="all" /><span class="description">'.esc_attr($desc).'</span>';


			/*$iconClass = 'meta_box_file';
			if ( $meta ) $iconClass .= ' checked';
			echo    '<input name="'.esc_attr( $name ).'" type="text" class="meta_box_upload_file regular-text" value="'.esc_url( $meta ).'" />
						<span class="'.esc_attr($iconClass).'"></span>
						<span class="meta_box_filename">'.esc_url( $meta ).'</span>
							<input class="meta_box_upload_file_button button" type="button" rel="'.get_the_ID().'" value="Add" />
							<small>&nbsp;<a href="#" class="meta_box_clear_file_button">Remove File</a></small>
							<br clear="all" /><span class="description">'.esc_attr($desc).'</span>';*/
		break;






		/* By Qantumthemes // Themes2Go
		======================================================*/


		case 'pageselect':
			if($posttype == null){$posttype = 'page';}
			$posttype =  $posttype ;

			if ( !post_type_exists( $posttype ) ) {
				echo 'Error: this post type doesn\'t exists';
			}
			$args = array(
				'echo'              => 1,
				'post_type'         => esc_attr($posttype),
				'name'              => esc_attr( $name ),
				'show_option_none'  => 'Select'
			);
			if(isset( $meta )){
				$args['selected'] = esc_attr( $meta );
			}
			wp_dropdown_pages($args);
		break;


		/* Coordinates By Themes2Go Qantumthemes 
		======================================================*/


		case 'coordinates':
		?>
			<div class="qw-map-field">
				<div class="qw-mapform">
					Address to geocode: <br>
					<input class="qt-address" id="address-<?php echo esc_attr( $id ); ?>" type="textbox" value="">
					<input class="submit btn button geocodefunction" data-target="<?php echo esc_attr( $id ); ?>" type="button" value="Geocode this address">
					<div id="results-<?php echo esc_attr( $id ); ?>"></div>
				</div>
				<?php
				echo '<input type="'.esc_attr($type).'" name="'.esc_attr( $name ).'" id="'.esc_attr( $id ).'" value="'.esc_attr( $meta ).'" class="regular-text" size="30" />
					<span class="description">'.esc_attr($desc).'</span>';
				?>
				<div class="qw-map-container" id="map-<?php echo esc_attr( $id ); ?>"></div>

			</div><?php  
			
		break;


		/* repeatable
		======================================================*/

		case 'repeatable':
			echo '<table id="'.esc_attr( $id ).'-repeatable" class="meta_box_repeatable open" cellspacing="0">
				<thead>
					<tr>
						<th><span class="sort_label"></span></th>
						<th>Fields</th>
						<th><a class="meta_box_repeatable_add" href="#"></a></th>
					</tr>
				</thead>
				<tbody>';
			$i = 0;
			// create an empty array
			if ( $meta == '' || $meta == array() ) {
				$keys = wp_list_pluck( $repeatable_fields, 'id' );
				$meta = array ( array_fill_keys( $keys, null ) );
			}
			$meta = array_values( $meta );
			foreach( $meta as $row ) {
				echo '<tr class="qw_hiddenable qw_repeatable_row">
						<td>
							<span class="dashicons dashicons-sort hndle repeatable-button"></span>
							<span class="dashicons dashicons-visibility qw_hider repeatable-button"></span>
						</td>
						
						<td class="qw_tohide">';


				foreach ( $repeatable_fields as $repeatable_field ) {
					if ( ! array_key_exists( $repeatable_field['id'], $meta[$i] ) )
						$meta[$i][$repeatable_field['id']] = null;
					echo '<label>'.esc_attr($repeatable_field['label']).'</label><p>';


					custom_meta_box_field( $repeatable_field, $meta[$i][$repeatable_field['id']], array( $id, $i ) );

					echo '</p>';
				} // end each field
				echo '</td><td><a class="meta_box_repeatable_remove" href="#"></a></td></tr>';
				$i++;
			} // end each row
			echo '</tbody>';
			echo '
				<tfoot>
					<tr>
						<th><span class="sort_label"></span></th>
						<th>Fields</th>
						<th><a class="meta_box_repeatable_add" href="#"></a></th>
					</tr>
				</tfoot>';
			echo '</table>
				<span class="description">'.esc_attr($desc).'</span>';
		break;
	} //end switch
		
}


/**
 * Finds any item in any level of an array
 *
 * @param   string  $needle     field type to look for
 * @param   array   $haystack   an array to search the type in
 *
 * @return  bool                whether or not the type is in the provided array
 */
function meta_box_find_field_type( $needle, $haystack ) {
	foreach ( $haystack as $h )
		if ( isset( $h['type'] ) && $h['type'] == 'repeatable' )
			return meta_box_find_field_type( $needle, $h['repeatable_fields'] );
		elseif ( ( isset( $h['type'] ) && $h['type'] == $needle ) || ( isset( $h['repeatable_type'] ) && $h['repeatable_type'] == $needle ) )
			return true;
	return false;
}

/**
 * Find repeatable
 *
 * This function does almost the same exact thing that the above function 
 * does, except we're exclusively looking for the repeatable field. The 
 * reason is that we need a way to look for other fields nested within a 
 * repeatable, but also need a way to stop at repeatable being true. 
 * Hopefully I'll find a better way to do this later.
 *
 * @param   string  $needle     field type to look for
 * @param   array   $haystack   an array to search the type in
 *
 * @return  bool                whether or not the type is in the provided array
 */
function meta_box_find_repeatable( $needle, $haystack ) {
	foreach ( $haystack as $h )
		if ( isset( $h['type'] ) && $h['type'] == 'repeatable' )
			return true;
		else
			return false;
}

/**
 * sanitize boolean inputs
 */
function meta_box_santitize_boolean( $string ) {
	if ( ! isset( $string ) || $string != 1 || $string != true )
		return false;
	else
		return true;
}

/**
 * outputs properly sanitized data
 *
 * @param   string  $string     the string to run through a validation function
 * @param   string  $function   the validation function
 *
 * @return                      a validated string
 */
function meta_box_sanitize( $string, $function = 'sanitize_text_field' ) {
	switch ( $function ) {
		case 'intval':
			return intval( $string );
		case 'absint':
			return absint( $string );
		case 'wp_kses_post':
			return wp_kses_post( $string );
		case 'wp_kses_data':
			return wp_kses_data( $string );
		case 'esc_url_raw':
			return esc_url_raw( $string );
		case 'is_email':
			return is_email( $string );
		case 'sanitize_title':
			return sanitize_title( $string );
		case 'santitize_boolean':
			return santitize_boolean( $string );
		case 'sanitize_text_field':
		default:
			return $string;
			//return sanitize_text_field( $string );
	}
}

/**
 * Map a multideminsional array
 *
 * @param   string  $func       the function to map
 * @param   array   $meta       a multidimensional array
 * @param   array   $sanitizer  a matching multidimensional array of sanitizers
 *
 * @return  array               new array, fully mapped with the provided arrays
 */
function meta_box_array_map_r( $func, $meta, $sanitizer ) {
		
	$newMeta = array();
	$meta = array_values( $meta );
	
	foreach( $meta as $key => $array ) {
		if ( $array == '' )
			continue;
		/**
		 * some values are stored as array, we only want multidimensional ones
		 */
		if ( ! is_array( $array ) ) {
			return array_map( $func, $meta, (array)$sanitizer );
			break;
		}
		/**
		 * the sanitizer will have all of the fields, but the item may only 
		 * have valeus for a few, remove the ones we don't have from the santizer
		 */
		$keys = array_keys( $array );
		$newSanitizer = $sanitizer;
		if ( is_array( $sanitizer ) ) {
			foreach( $newSanitizer as $sanitizerKey => $value )
				if ( ! in_array( $sanitizerKey, $keys ) )
					unset( $newSanitizer[$sanitizerKey] );
		}
		/**
		 * run the function as deep as the array goes
		 */
		foreach( $array as $arrayKey => $arrayValue )
			if ( is_array( $arrayValue ) ){
				if(array_key_exists($arrayKey, $array)){
				//  $array[$arrayKey] = meta_box_array_map_r( $func, $arrayValue, $newSanitizer[$arrayKey] );
				}
			}
		
		$array = array_map( $func, $array, $newSanitizer );
		$newMeta[$key] = array_combine( $keys, array_values( $array ) );
	}
	return $newMeta;
}

/**
 * takes in a few peices of data and creates a custom meta box
 *
 * @param   string          $id         meta box id
 * @param   string          $title      title
 * @param   array           $fields     array of each field the box should include
 * @param   string|array    $page       post type to add meta box to
 */

class Custom_Add_Meta_Box {
	
	var $id;
	var $title;
	var $fields;
	var $page;
	
	public function __construct( $id, $title, $fields, $page, $js, $template = null ) {
		$this->id = $id;
		$this->title = $title;
		$this->fields = $fields;
		$this->page = $page;
		$this->js = $js;
		$this->template = $template;



		if( ! is_array( $this->page ) )
			$this->page = array( $this->page );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );     
		add_action( 'admin_footer',  array( $this, 'admin_head' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_box' ) );
		add_action( 'save_post',  array( $this, 'save_box' ));
	}





	/**
	 * adds scripts to the head for special fields with extra js requirements
	 */
	function admin_head() {
		if ( in_array( get_post_type(), $this->page ) && ( meta_box_find_field_type( 'date', $this->fields ) || meta_box_find_field_type( 'slider', $this->fields ) ) ) {
		
			echo '<script type="text/javascript">
						jQuery(function($) {';
			
			foreach ( $this->fields as $field ) {
				switch( $field['type'] ) {
					// date
					case 'date' :
						echo '
							if(jQuery("#'.esc_js(esc_attr($field['id'])).'").length > 0){
							jQuery("#'.esc_js(esc_attr($field['id'])).'").datepicker({
								dateFormat: \'yy-mm-dd\'
							});}';
					break;
					// slider
					case 'slider' :
					$value = get_post_meta( get_the_ID(), $field['id'], true );
					if ( $value == '' )
						$value = $field['min'];
					echo '
							$( "#'.esc_attr($field['id']).'-slider" ).slider({
								value: '.esc_js(esc_attr($value)).',
								min: '.esc_js(esc_attr($field['min'])).',
								max: '.esc_js(esc_attr($field['max'])).',
								step: '.esc_js(esc_attr($field['step'])).',
								slide: function( event, ui ) {
									$( "#'.esc_js(esc_attr($field['id'])).'" ).val( ui.value );
								}
							});';
					break;
				}
			}
			
			echo '});
				</script>';
		
		}
	}



	
	/**
	 * enqueue necessary scripts and styles
	 */
	function admin_enqueue_scripts() {
		global $pagenow;
		if ( in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) && in_array( get_post_type(), $this->page ) ) {
			// js
			$deps = array( 'jquery' );

			


			if ( meta_box_find_field_type( 'date', $this->fields ) )
				$deps[] = 'jquery-ui-datepicker';
			if ( meta_box_find_field_type( 'slider', $this->fields ) )
				$deps[] = 'jquery-ui-slider';
			if ( meta_box_find_field_type( 'color', $this->fields ) )
				$deps[] = 'farbtastic';
				$deps[] = 'wp-color-picker';
			if ( in_array( true, array(
				meta_box_find_field_type( 'chosen', $this->fields ),
				meta_box_find_field_type( 'post_chosen', $this->fields )
			) ) ) {
				wp_register_script( 'chosen', CUSTOM_METABOXES_DIR.'/js/chosen.js', array( 'jquery' ) );
				$deps[] = 'chosen';
				wp_enqueue_style( 'chosen', CUSTOM_METABOXES_DIR.'/css/chosen.css' );
			}
			

			$deps[] = 'jquery';
				wp_enqueue_script( 'meta_box', CUSTOM_METABOXES_DIR.'/js/metaboxes-scripts.js', $deps );

			if ( in_array( true, array(  meta_box_find_field_type( 'coordinates', $this->fields ) ) ) ) {
		
				$mapsurl = 'https://maps.googleapis.com/maps/api/js';
				$key = get_theme_mod("qt_maps_api", false);
				if($key != '') {
					$mapsurl = add_query_arg("key", esc_attr(trim($key)), $mapsurl);
				}
				wp_enqueue_script('qt-google-maps',$mapsurl, $deps, false, true);
			}


			
			// Creates the footer things like icon menu
			//qw_admin_footer_function();

			
			// css
			$deps = array();
			wp_register_style( 'jqueryui', CUSTOM_METABOXES_DIR.'/css/jqueryui.css' );
			if ( meta_box_find_field_type( 'date', $this->fields ) || meta_box_find_field_type( 'slider', $this->fields ) )
				$deps[] = 'jqueryui';
			if ( meta_box_find_field_type( 'color', $this->fields ) )
				$deps[] = 'farbtastic';
			wp_enqueue_style( 'meta_box', CUSTOM_METABOXES_DIR.'/css/meta_box.css', $deps );
			 wp_enqueue_style( 'wp-color-picker' );
		}
	}




	
	


	
	/**
	 * adds the meta box for every post type in $page
	 */
	function add_box() {
		/*
		20170425 *  added support for page template to fully hide/show a fields container adding 6th parameter to ttgcore_metabox. The parameter is the page template name (page-template.php)
		*/
		$targetTemplate = $this->template;
		$currentTemplate =  basename( get_page_template() );
		if($targetTemplate != null){
			if($currentTemplate != $targetTemplate){
				return ;
			}
		}
		foreach ( $this->page as $page ) {
			add_meta_box( $this->id, $this->title, array( $this, 'meta_box_callback' ), $page, 'normal', 'high' );
		}
	}

	
	/**
	 * outputs the meta box
	 */
	function meta_box_callback() {
		// Use nonce for verification
		wp_nonce_field( 'custom_meta_box_nonce_action', 'custom_meta_box_nonce_field' );

		// Begin the field table and loop
		echo '<table class="form-table meta_box">';
		foreach ( $this->fields as $field) {
			if(!is_array($field)){
				continue;
			}
			if(!array_key_exists('pagetemplate', $field)) {
					$field['pagetemplate']= '';
			}
			$template = get_page_template_slug( get_the_ID() );
			if($field['pagetemplate'] == $template || $field['pagetemplate'] == '') {
				if ( $field['type'] == 'section' ) {
					echo '<tr>
							<td colspan="2" class="qt-admin_sectiontitle">
								<h2 class="qt-admin_sectiontitle">'.esc_attr($field['label']).'</h2>
							</td>
						</tr>';
				}
				else {
					$class='';
					$boxid='';
					if(!array_key_exists('class', $field)){
						$field['class'] = '';
					}
					if(!array_key_exists('containerid', $field)){
						$field['containerid'] = '';
					}
					echo '<tr class="'.esc_attr($field['class']).' metabox-controlfield" id="'.esc_attr($field['containerid']).'">';
					if($field['type'] == 'chapter'){
						echo '<td colspan="2"><h2>'.esc_attr($field['label']).'</h2><td>';
					} else {
						
						echo '<th style="width:20%">';
							echo '<label for="'.esc_attr($field['id']).'">'.esc_attr($field['label']).'</label>';
						echo'</th>
								<td>';
								$meta = get_post_meta( get_the_ID(), $field['id'], true);
								echo custom_meta_box_field( $field, $meta );
						echo    '<td>';
					}
					echo '</tr>';
					
				}
			}
		} // end foreach
		echo '</table>'; // end table
	}
	
	/**
	 * saves the captured data
	 */
	function save_box( $post_id ) {
		$post_type = get_post_type();
		
		// verify nonce
		if ( ! isset( $_POST['custom_meta_box_nonce_field'] ) )
			return $post_id;
		if ( ! ( in_array( $post_type, $this->page ) || wp_verify_nonce( $_POST['custom_meta_box_nonce_field'],  'custom_meta_box_nonce_action' ) ) ) 
			return $post_id;
		// check autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		// check permissions
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		
		// loop through fields and save the data
		foreach ( $this->fields as $field ) {
			/**
			 * Since 20170428 check to exclude extra settings
			 */
			if(!array_key_exists('type', $field)) {
				continue;
			}
			if( $field['type'] == 'section' ) {
				$sanitizer = null;
				continue;
			}
			if( in_array( $field['type'], array( 'tax_select', 'tax_checkboxes' ) ) ) {
				// save taxonomies
				if ( isset( $_POST[$field['id']] ) )
					$term = $_POST[$field['id']];
				wp_set_object_terms( $post_id, $term, $field['id'] );
			}
			if( in_array( $field['type'], array( 'tax_select_disassociated') ) ) {
				// save taxonomies
				if ( isset( $_POST[$field['id']] ) ) {
					update_post_meta( $post_id, $field['id'], $_POST[$field['id']] );
				}
			}
			else {
				// save the rest
				$new = false;
				$old = get_post_meta( $post_id, $field['id'], true );
				if ( isset( $_POST[$field['id']] ) )
					$new = $_POST[$field['id']];

				if($field['type'] == 'repeatable' && is_array($new)) $new = array_values($new);
				
				if ( isset( $new ) && $new != $old ) {
					$sanitizer = isset( $field['sanitizer'] ) ? $field['sanitizer'] : 'sanitize_text_field';
					if ( is_array( $new ) )
						$new = meta_box_array_map_r( 'meta_box_sanitize', $new, $sanitizer );
					else
						$new = meta_box_sanitize( $new, $sanitizer );
					update_post_meta( $post_id, $field['id'], $new );
				} elseif ( isset( $new ) && '' == $new && $old ) {
					delete_post_meta( $post_id, $field['id'], $old );
				}
			}
		} // end foreach
	}
	
}






