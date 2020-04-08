<?php
/*
TTG Xtend authorimage Custom background
Description: Add a cutsom picture for a authorimage or custom taxonomy in OnAir2
*/
if ( ! class_exists( 'TTG_AUTHORBOX_IMAGEUPLOADER' ) ) {
	class TTG_AUTHORBOX_IMAGEUPLOADER {

		public function __construct() {
			//
		}
		 
		/*
		* Initialize the class and start calling our hooks and filters
		* @since 1.0.0
		*/
		public function init() {
			add_action( 'show_user_profile', array ( $this, 'add_user_image' ) );
			add_action( 'edit_user_profile', array ( $this, 'add_user_image' ) );
			add_action( 'personal_options_update', array ( $this, 'save_authorimage_image' ) );
			add_action( 'edit_user_profile_update', array ( $this, 'save_authorimage_image' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
			add_action( 'admin_footer', array ( $this, 'add_script' ) );
		}

		public function load_media() {
			wp_enqueue_media();
		}
		 
		/*
		* Add a image field in the user profile page
		*/
		public function add_user_image ( $user ) { 
			$image_id = get_usermeta ( $user->ID, 'ttg_authorbox_imgid', true );
			?>
			 <table class="form-table">
				<tbody>
					<tr class="user-sessions-wrap hide-if-no-js">
						<th><label for="ttg_authorbox_imgid"><?php esc_html_e('Image (user page header and icon if no gravatar) 1600x1400px', 'ttg-authorbox'); ?></label></th>
						<td aria-live="assertive">
							<input type="hidden" id="ttg_authorbox_imgid" name="ttg_authorbox_imgid" class="custom_media_url" value="<?php echo esc_attr( get_the_author_meta( 'ttg_authorbox_imgid', $user->ID  ) ); ?>">
							<div id="authorimage-image-wrapper">
								<?php if ( $image_id ) { ?>
									<?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
								<?php } ?>
							 </div>
							<p>
								<input type="button" class="button button-secondary ttg_authorbox_media_button" id="ttg_authorbox_media_button" name="ttg_authorbox_media_button" value="<?php esc_attr_e( 'Add Image', 'ttg-authorbox' ); ?>" />
								<input type="button" class="button button-secondary ttg_authorbox_media_remove" id="ttg_authorbox_media_remove" name="ttg_authorbox_media_remove" value="<?php esc_attr_e( 'Remove Image', 'ttg-authorbox' ); ?>" />
							</p>
						</td>
					</tr>
				<tbody>
			</table>
			<?php
		}
		
		public function save_authorimage_image( $user_id ) {
			if ( !current_user_can( 'edit_user', $user_id ) )
				return false;
			update_usermeta( $user_id, 'ttg_authorbox_imgid', $_POST['ttg_authorbox_imgid'] );
		}

		/*
		 * Add script
		 * @since 1.0.0
		 */
		public function add_script() { 
			?>
			 <script>
				 jQuery(document).ready( function($) {
					 function ttg_authorbox_media_upload(button_class) {
						 var _custom_media = true,
						 _orig_send_attachment = wp.media.editor.send.attachment;
						 $('body').on('click', button_class, function(e) {
							 var button_id = '#'+$(this).attr('id');
							 var send_attachment_bkp = wp.media.editor.send.attachment;
							 var button = $(button_id);
							 _custom_media = true;
							 wp.media.editor.send.attachment = function(props, attachment){
								 if ( _custom_media ) {
									 $('#ttg_authorbox_imgid').val(attachment.id);
									 $('#authorimage-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
									 $('#authorimage-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
								 } else {
									 return _orig_send_attachment.apply( button_id, [props, attachment] );
								 }
								}
						 wp.media.editor.open(button);
						 return false;
					 });
				 }
				 ttg_authorbox_media_upload('.ttg_authorbox_media_button.button'); 
				 $('body').on('click','.ttg_authorbox_media_remove',function(){
					 $('#ttg_authorbox_imgid').val('');
					 $('#authorimage-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
				 });
				 // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-authorimage-ajax-response
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
									$('#authorimage-image-wrapper').html('');
								}
							 }
						}
					}
				 });
			 });
			</script>
			<?php 
			
		}

	}
	$TTG_AUTHORBOX_IMAGEUPLOADER = new TTG_AUTHORBOX_IMAGEUPLOADER();
	$TTG_AUTHORBOX_IMAGEUPLOADER -> init();
}