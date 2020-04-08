<?php
/**
 * @package WordPress
 * @subpackage qt-taxonomy-backgorund
 * @version 1.0.0
 */


if ( ! class_exists( 'QT_TAXONOMY_BACKGROUND' ) ) {
	class QT_TAXONOMY_BACKGROUND {

		public function __construct() {
			// nothing here
		}
		 
		 /*
			* Initialize the class and start calling our hooks and filters
			* @since 1.0.0
		 */
		public function init() {
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
				add_action( $taxonomy->name.'_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
				add_action( $taxonomy->name.'_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
				add_action( 'created_'.$taxonomy->name , array ( $this, 'save_category_image' ), 10, 2 );
				add_action( 'edited_'.$taxonomy->name, array ( $this, 'updated_category_image' ), 10, 2 );
			}
			add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
			add_action( 'admin_footer', array ( $this, 'add_script' ) );
		}

		public function load_media() {
		 wp_enqueue_media();
			 wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker');
			// wp_enqueue_script( 'wp-color-picker-script-handle', plugins_url('wp-color-picker-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		}
		 
		 /*
			* Add a form field in the new category page
			* @since 1.0.0
		 */
		 public function add_category_image ( $taxonomy ) { ?>
			<div class="form-field term-group">
				 <label for="qt_taxonomy_img_id"><?php esc_html_e('Image', 'ttg-xtend'); ?></label>
				 <input type="hidden" id="qt_taxonomy_img_id" name="qt_taxonomy_img_id" class="custom_media_url" value="">
				 <div id="category-image-wrapper"></div>
				 <p>
					 <input type="button" class="button button-secondary TTG_XTEND_media_button" id="TTG_XTEND_media_button" name="TTG_XTEND_media_button" value="<?php _e( 'Add Image', 'ttg-xtend' ); ?>" />
					 <input type="button" class="button button-secondary TTG_XTEND_media_remove" id="TTG_XTEND_media_remove" name="TTG_XTEND_media_remove" value="<?php _e( 'Remove Image', 'ttg-xtend' ); ?>" />
				</p>
			</div>

			<div class="form-field term-colorpicker-wrap">
				<label for="qt_taxonomy_color"><?php esc_html_e('Category Color', 'ttg-xtend'); ?></label>
				<input name="qt_taxonomy_color" value="#ffffff"  class="color-picker" id="qt_taxonomy_color" />
			</div>

		 <?php
		 }
		 
		 /*
			* Save the form field
			* @since 1.0.0
		 */
		 public function save_category_image ( $term_id, $tt_id ) {
			 if( isset( $_POST['qt_taxonomy_img_id'] ) && '' !== $_POST['qt_taxonomy_img_id'] ){
				 $image = $_POST['qt_taxonomy_img_id'];
				 add_term_meta( $term_id, 'qt_taxonomy_img_id', $image, true );
			 }
		 }
		 
		 /*
			* Edit the form field
			* @since 1.0.0
		 */
		 public function update_category_image ( $term, $taxonomy ) { ?>

		 	<?php 
			/**
			 * Image uploader
			 */
			$image_id = get_term_meta ( $term->term_id, 'qt_taxonomy_img_id', true ); 
			?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					 <label for="qt_taxonomy_img_id"><?php esc_html_e( 'Image', 'ttg-xtend' ); ?></label>
				</th>
				<td>
					<input type="hidden" id="qt_taxonomy_img_id" name="qt_taxonomy_img_id" value="<?php echo $image_id; ?>">
					<div id="category-image-wrapper">
						<?php if ( $image_id ) { ?>
							<?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
						<?php } ?>
					</div>
					<p>
						<input type="button" class="button button-secondary TTG_XTEND_media_button" id="TTG_XTEND_media_button" name="TTG_XTEND_media_button" value="<?php esc_attr_e( 'Add Image', 'ttg-xtend' ); ?>" />
						<input type="button" class="button button-secondary TTG_XTEND_media_remove" id="TTG_XTEND_media_remove" name="TTG_XTEND_media_remove" value="<?php esc_attr_e( 'Remove Image', 'ttg-xtend' ); ?>" />
					</p>
				</td>
			</tr>

			<?php 
			/**
			 * Color picker
			 * [$color saved color]
			 * @var [string]
			 */
			$color = get_term_meta( $term->term_id, 'qt_taxonomy_color', true );
    		$color = ( ! empty( $color ) ) ? "{$color}" : '#ffffff';
			?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					<label for="qt_taxonomy_color"><?php esc_html_e('Category Color', 'ttg-xtend'); ?></label>
				</th>
				<td>
					<input name="qt_taxonomy_color" value="<?php echo esc_attr( $color ); ?>"  class="color-picker" id="$color" />
				</td>
			</tr>
		 <?php
		 }

		/*
		 * Update the form field value
		 * @since 1.0.0
		 */
		 public function updated_category_image ( $term_id, $tt_id ) {


			 if( isset( $_POST['qt_taxonomy_img_id'] ) && '' !== $_POST['qt_taxonomy_img_id'] ){
				 $image = $_POST['qt_taxonomy_img_id'];
				 update_term_meta ( $term_id, 'qt_taxonomy_img_id', esc_attr( $image ) );
			 } else {
				 update_term_meta ( $term_id, 'qt_taxonomy_img_id', '' );
			 }


			 if( isset( $_POST['qt_taxonomy_color'] ) && '' !== $_POST['qt_taxonomy_color'] ){
			 	// wp_die('Has color'.$_POST['qt_taxonomy_color']);
				 $color = $_POST['qt_taxonomy_color'];
				 update_term_meta ( $term_id, 'qt_taxonomy_color',  $color  );
			 } else {
			 	wp_die('No color');
				 update_term_meta ( $term_id, 'qt_taxonomy_color', '' );
			 }
		 }

		/*
		 * Add script
		 * @since 1.0.0
		 */
		 public function add_script() { ?>
			 <script>
				 jQuery(document).ready( function($) {
					 function qt_taxonomy_media_upload(button_class) {
						 var _custom_media = true,
						 _orig_send_attachment = wp.media.editor.send.attachment;
						 $('body').on('click', button_class, function(e) {
							 var button_id = '#'+$(this).attr('id');
							 var send_attachment_bkp = wp.media.editor.send.attachment;
							 var button = $(button_id);
							 _custom_media = true;
							 wp.media.editor.send.attachment = function(props, attachment){
								 if ( _custom_media ) {
									 $('#qt_taxonomy_img_id').val(attachment.id);
									 $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
									 $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
								 } else {
									 return _orig_send_attachment.apply( button_id, [props, attachment] );
								 }
								}
						 wp.media.editor.open(button);
						 return false;
					 });
				 }
				 qt_taxonomy_media_upload('.TTG_XTEND_media_button.button'); 
				 $('body').on('click','.TTG_XTEND_media_remove',function(){
					 $('#qt_taxonomy_img_id').val('');
					 $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
				 });
				 // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
				 $(document).ajaxComplete(function(event, xhr, settings) {
					if(typeof(settings.data) === 'undefined'){
						return;
					}
					if( typeof(settings.data) !== 'undefined' ){
						if( typeof(settings.data.split) == 'function' ){
							 var queryStringArr = settings.data.split('&');
							 if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
								 var xml = xhr.responseXML;
								 $response = $(xml).find('term_id').text();
								 if($response!=""){
									 // Clear the thumb image
									 $('#category-image-wrapper').html('');
								 }
							 }
						}
					}
				 });


				// color picker
				jQuery(document).ready(function($){
					$('.color-picker').each(function(){
						$(this).wpColorPicker();
						});
				});
			 });
		 </script>
		 <?php }

	}
	 

	function qt_taxonomy_background_init(){
		$QT_TAXONOMY_BACKGROUND = new QT_TAXONOMY_BACKGROUND();
		$QT_TAXONOMY_BACKGROUND -> init();
	}
	add_action('admin_menu', 'qt_taxonomy_background_init', 9999);
 
}