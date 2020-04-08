<?php  
/**
 * Create customizer fields for the kirki framework.
 * @package Kirki
 */


/* = Main colors
=============================================*/
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_bg',
	'label'       => esc_html__( 'Page background', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#f9f9f9',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_paper',
	'label'       => esc_html__( 'Paper background', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#ffffff',
	'priority'    => 0
));

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_color',
	'label'       => esc_html__( 'Text color', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#777777',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_accent',
	'label'       => esc_html__( 'Accent color', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#00a8c6',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_accent_h',
	'label'       => esc_html__( 'Accent hover', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#00d7df',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_accent_t',
	'label'       => esc_html__( 'Accent text', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#ffffff',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_color_cap',
	'label'       => esc_html__( 'Captions', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#343434',
	'priority'    => 0
));
// Primary
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_primary',
	'label'       => esc_html__( 'Primary background', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#111618',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_primary_t',
	'label'       => esc_html__( 'Primary text', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#ffffff',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_primary_light',
	'label'       => esc_html__( 'Primary light background', "wpcast" ),
	'section'     => 'wpcast_colors_section',
	'default'	  => '#353535',
	'priority'    => 0
));





/* = Call to action section
=============================================*/
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'switch',
	'settings'    => 'wpcast_cta_on',
	'label'       => esc_html__( 'Enable button', "wpcast" ),
	'section'     => 'wpcast_cta_section',
	'description' => esc_html__( 'Display attractive call to action in header bar', "wpcast" ),
	'priority'    => 10,
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'text',
	'settings'    => 'wpcast_cta_text',
	'label'       => esc_html__( 'Button text (required)', "wpcast" ),
	'description' => esc_html__( 'Add button to header', "wpcast" ),
	'section'     => 'wpcast_cta_section',
	'default'	  =>  'Subscribe',
	'priority'    => 10
));

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'text',
	'settings'    => 'wpcast_cta_ur',
	'label'       => esc_html__( 'URL (required)', "wpcast" ),
	'description' => esc_html__( 'Default:', "wpcast" ).' '.get_feed_link( ),
	'section'     => 'wpcast_cta_section',
	'default'     => get_feed_link(  ),
	'priority'    => 10
));

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'text',
	'settings'    => 'wpcast_cta_class',
	'label'       => esc_html__( 'CSS Class', "wpcast" ),
	'description' => esc_html__( 'Add style class to button', "wpcast" ),
	'section'     => 'wpcast_cta_section',
	'priority'    => 10
));

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'text',
	'settings'    => 'wpcast_cta_id',
	'label'       => esc_html__( 'Element ID', "wpcast" ),
	'description' => esc_html__( 'ID to connect any external javascript if required', "wpcast" ),
	'section'     => 'wpcast_cta_section',
	'default'	  => 'wpcastCta',
	'priority'    => 10
));

if( !function_exists( 'wpcast_icon_dropdown' )){
	if( !function_exists( 'wpcast_iconlist' )){
		function wpcast_iconlist(){
			$icons = array( '3d_rotation e84d', 'ac_unit eb3b','access_alarm e190','access_alarms e191','access_time e192','accessibility e84e','accessible e914','account_balance e84f','account_balance_wallet e850','account_box e851','account_circle e853','adb e60e','add e145','add_a_photo e439','add_alarm e193','add_alert e003','add_box e146','add_circle e147','add_circle_outline e148','add_location e567','add_shopping_cart e854','add_to_photos e39d','add_to_queue e05c','adjust e39e','airline_seat_flat e630','airline_seat_flat_angled e631','airline_seat_individual_suite e632','airline_seat_legroom_extra e633','airline_seat_legroom_normal e634','airline_seat_legroom_reduced e635','airline_seat_recline_extra e636','airline_seat_recline_normal e637','airplanemode_active e195','airplanemode_inactive e194','airplay e055','airport_shuttle eb3c','alarm e855','alarm_add e856','alarm_off e857','alarm_on e858','album e019','all_inclusive eb3d','all_out e90b','android e859','announcement e85a','apps e5c3','archive e149','arrow_back e5c4','arrow_downward e5db','arrow_drop_down e5c5','arrow_drop_down_circle e5c6','arrow_drop_up e5c7','arrow_forward e5c8','arrow_upward e5d8','art_track e060','aspect_ratio e85b','assessment e85c','assignment e85d','assignment_ind e85e','assignment_late e85f','assignment_return e860','assignment_returned e861','assignment_turned_in e862','assistant e39f','assistant_photo e3a0','attach_file e226','attach_money e227','attachment e2bc','audiotrack e3a1','autorenew e863','av_timer e01b','backspace e14a','backup e864','battery_alert e19c','battery_charging_full e1a3','battery_full e1a4','battery_std e1a5','battery_unknown e1a6','beach_access eb3e','beenhere e52d','block e14b','bluetooth e1a7','bluetooth_audio e60f','bluetooth_connected e1a8','bluetooth_disabled e1a9','bluetooth_searching e1aa','blur_circular e3a2','blur_linear e3a3','blur_off e3a4','blur_on e3a5','book e865','bookmark e866','bookmark_border e867','border_all e228','border_bottom e229','border_clear e22a','border_color e22b','border_horizontal e22c','border_inner e22d','border_left e22e','border_outer e22f','border_right e230','border_style e231','border_top e232','border_vertical e233','branding_watermark e06b','brightness_1 e3a6','brightness_2 e3a7','brightness_3 e3a8','brightness_4 e3a9','brightness_5 e3aa','brightness_6 e3ab','brightness_7 e3ac','brightness_auto e1ab','brightness_high e1ac','brightness_low e1ad','brightness_medium e1ae','broken_image e3ad','brush e3ae','bubble_chart e6dd','bug_report e868','build e869','burst_mode e43c','business e0af','business_center eb3f','cached e86a','cake e7e9','call e0b0','call_end e0b1','call_made e0b2','call_merge e0b3','call_missed e0b4','call_missed_outgoing e0e4','call_received e0b5','call_split e0b6','call_to_action e06c','camera e3af','camera_alt e3b0','camera_enhance e8fc','camera_front e3b1','camera_rear e3b2','camera_roll e3b3','cancel e5c9','card_giftcard e8f6','card_membership e8f7','card_travel e8f8','casino eb40','cast e307','cast_connected e308','center_focus_strong e3b4','center_focus_weak e3b5','change_history e86b','chat e0b7','chat_bubble e0ca','chat_bubble_outline e0cb','check e5ca','check_box e834','check_box_outline_blank e835','check_circle e86c','chevron_left e5cb','chevron_right e5cc','child_care eb41','child_friendly eb42','chrome_reader_mode e86d','class e86e','clear e14c','clear_all e0b8','close e5cd','closed_caption e01c','cloud e2bd','cloud_circle e2be','cloud_done e2bf','cloud_download e2c0','cloud_off e2c1','cloud_queue e2c2','cloud_upload e2c3','code e86f','collections e3b6','collections_bookmark e431','color_lens e3b7','colorize e3b8','comment e0b9','compare e3b9','compare_arrows e915','computer e30a','confirmation_number e638','contact_mail e0d0','contact_phone e0cf','contacts e0ba','content_copy e14d','content_cut e14e','content_paste e14f','control_point e3ba','control_point_duplicate e3bb','copyright e90c','create e150','create_new_folder e2cc','credit_card e870','crop e3be','crop_16_9 e3bc','crop_3_2 e3bd','crop_5_4 e3bf','crop_7_5 e3c0','crop_din e3c1','crop_free e3c2','crop_landscape e3c3','crop_original e3c4','crop_portrait e3c5','crop_rotate e437','crop_square e3c6','dashboard e871','data_usage e1af','date_range e916','dehaze e3c7','delete e872','delete_forever e92b','delete_sweep e16c','description e873','desktop_mac e30b','desktop_windows e30c','details e3c8','developer_board e30d','developer_mode e1b0','device_hub e335','devices e1b1','devices_other e337','dialer_sip e0bb','dialpad e0bc','directions e52e','directions_bike e52f','directions_boat e532','directions_bus e530','directions_car e531','directions_railway e534','directions_run e566','directions_subway e533','directions_transit e535','directions_walk e536','disc_full e610','dns e875','do_not_disturb e612','do_not_disturb_alt e611','do_not_disturb_off e643','do_not_disturb_on e644','dock e30e','domain e7ee','done e876','done_all e877','donut_large e917','donut_small e918','drafts e151','drag_handle e25d','drive_eta e613','dvr e1b2','edit e3c9','edit_location e568','eject e8fb','email e0be','enhanced_encryption e63f','equalizer e01d','error e000','error_outline e001','euro_symbol e926','ev_station e56d','event e878','event_available e614','event_busy e615','event_note e616','event_seat e903','exit_to_app e879','expand_less e5ce','expand_more e5cf','explicit e01e','explore e87a','exposure e3ca','exposure_neg_1 e3cb','exposure_neg_2 e3cc','exposure_plus_1 e3cd','exposure_plus_2 e3ce','exposure_zero e3cf','extension e87b','face e87c','fast_forward e01f','fast_rewind e020','favorite e87d','favorite_border e87e','featured_play_list e06d','featured_video e06e','feedback e87f','fiber_dvr e05d','fiber_manual_record e061','fiber_new e05e','fiber_pin e06a','fiber_smart_record e062','file_download e2c4','file_upload e2c6','filter e3d3','filter_1 e3d0','filter_2 e3d1','filter_3 e3d2','filter_4 e3d4','filter_5 e3d5','filter_6 e3d6','filter_7 e3d7','filter_8 e3d8','filter_9 e3d9','filter_9_plus e3da','filter_b_and_w e3db','filter_center_focus e3dc','filter_drama e3dd','filter_frames e3de','filter_hdr e3df','filter_list e152','filter_none e3e0','filter_tilt_shift e3e2','filter_vintage e3e3','find_in_page e880','find_replace e881','fingerprint e90d','first_page e5dc','fitness_center eb43','flag e153','flare e3e4','flash_auto e3e5','flash_off e3e6','flash_on e3e7','flight e539','flight_land e904','flight_takeoff e905','flip e3e8','flip_to_back e882','flip_to_front e883','folder e2c7','folder_open e2c8','folder_shared e2c9','folder_special e617','font_download e167','format_align_center e234','format_align_justify e235','format_align_left e236','format_align_right e237','format_bold e238','format_clear e239','format_color_fill e23a','format_color_reset e23b','format_color_text e23c','format_indent_decrease e23d','format_indent_increase e23e','format_italic e23f','format_line_spacing e240','format_list_bulleted e241','format_list_numbered e242','format_paint e243','format_quote e244','format_shapes e25e','format_size e245','format_strikethrough e246','format_textdirection_l_to_r e247','format_textdirection_r_to_l e248','format_underlined e249','forum e0bf','forward e154','forward_10 e056','forward_30 e057','forward_5 e058','free_breakfast eb44','fullscreen e5d0','fullscreen_exit e5d1','functions e24a','g_translate e927','gamepad e30f','games e021','gavel e90e','gesture e155','get_app e884','gif e908','golf_course eb45','gps_fixed e1b3','gps_not_fixed e1b4','gps_off e1b5','grade e885','gradient e3e9','grain e3ea','graphic_eq e1b8','grid_off e3eb','grid_on e3ec','group e7ef','group_add e7f0','group_work e886','hd e052','hdr_off e3ed','hdr_on e3ee','hdr_strong e3f1','hdr_weak e3f2','headset e310','headset_mic e311','healing e3f3','hearing e023','help e887','help_outline e8fd','high_quality e024','highlight e25f','highlight_off e888','history e889','home e88a','hot_tub eb46','hotel e53a','hourglass_empty e88b','hourglass_full e88c','http e902','https e88d','image e3f4','image_aspect_ratio e3f5','import_contacts e0e0','import_export e0c3','important_devices e912','inbox e156','indeterminate_check_box e909','info e88e','info_outline e88f','input e890','insert_chart e24b','insert_comment e24c','insert_drive_file e24d','insert_emoticon e24e','insert_invitation e24f','insert_link e250','insert_photo e251','invert_colors e891','invert_colors_off e0c4','iso e3f6','keyboard e312','keyboard_arrow_down e313','keyboard_arrow_left e314','keyboard_arrow_right e315','keyboard_arrow_up e316','keyboard_backspace e317','keyboard_capslock e318','keyboard_hide e31a','keyboard_return e31b','keyboard_tab e31c','keyboard_voice e31d','kitchen eb47','label e892','label_outline e893','landscape e3f7','language e894','laptop e31e','laptop_chromebook e31f','laptop_mac e320','laptop_windows e321','last_page e5dd','launch e895','layers e53b','layers_clear e53c','leak_add e3f8','leak_remove e3f9','lens e3fa','library_add e02e','library_books e02f','library_music e030','lightbulb_outline e90f','line_style e919','line_weight e91a','linear_scale e260','link e157','linked_camera e438','list e896','live_help e0c6','live_tv e639','local_activity e53f','local_airport e53d','local_atm e53e','local_bar e540','local_cafe e541','local_car_wash e542','local_convenience_store e543','local_dining e556','local_drink e544','local_florist e545','local_gas_station e546','local_grocery_store e547','local_hospital e548','local_hotel e549','local_laundry_service e54a','local_library e54b','local_mall e54c','local_movies e54d','local_offer e54e','local_parking e54f','local_pharmacy e550','local_phone e551','local_pizza e552','local_play e553','local_post_office e554','local_printshop e555','local_see e557','local_shipping e558','local_taxi e559','location_city e7f1','location_disabled e1b6','location_off e0c7','location_on e0c8','location_searching e1b7','lock e897','lock_open e898','lock_outline e899','looks e3fc','looks_3 e3fb','looks_4 e3fd','looks_5 e3fe','looks_6 e3ff','looks_one e400','looks_two e401','loop e028','loupe e402','low_priority e16d','loyalty e89a','mail e158','mail_outline e0e1','map e55b','markunread e159','markunread_mailbox e89b','memory e322','menu e5d2','merge_type e252','message e0c9','mic e029','mic_none e02a','mic_off e02b','mms e618','mode_comment e253','mode_edit e254','monetization_on e263','money_off e25c','monochrome_photos e403','mood e7f2','mood_bad e7f3','more e619','more_horiz e5d3','more_vert e5d4','motorcycle e91b','mouse e323','move_to_inbox e168','movie e02c','movie_creation e404','movie_filter e43a','multiline_chart e6df','music_note e405','music_video e063','my_location e55c','nature e406','nature_people e407','navigate_before e408','navigate_next e409','navigation e55d','near_me e569','network_cell e1b9','network_check e640','network_locked e61a','network_wifi e1ba','new_releases e031','next_week e16a','nfc e1bb','no_encryption e641','no_sim e0cc','not_interested e033','note e06f','note_add e89c','notifications e7f4','notifications_active e7f7','notifications_none e7f5','notifications_off e7f6','notifications_paused e7f8','offline_pin e90a','ondemand_video e63a','opacity e91c','open_in_browser e89d','open_in_new e89e','open_with e89f','pages e7f9','pageview e8a0','palette e40a','pan_tool e925','panorama e40b','panorama_fish_eye e40c','panorama_horizontal e40d','panorama_vertical e40e','panorama_wide_angle e40f','party_mode e7fa','pause e034','pause_circle_filled e035','pause_circle_outline e036','payment e8a1','people e7fb','people_outline e7fc','perm_camera_mic e8a2','perm_contact_calendar e8a3','perm_data_setting e8a4','perm_device_information e8a5','perm_identity e8a6','perm_media e8a7','perm_phone_msg e8a8','perm_scan_wifi e8a9','person e7fd','person_add e7fe','person_outline e7ff','person_pin e55a','person_pin_circle e56a','personal_video e63b','pets e91d','phone e0cd','phone_android e324','phone_bluetooth_speaker e61b','phone_forwarded e61c','phone_in_talk e61d','phone_iphone e325','phone_locked e61e','phone_missed e61f','phone_paused e620','phonelink e326','phonelink_erase e0db','phonelink_lock e0dc','phonelink_off e327','phonelink_ring e0dd','phonelink_setup e0de','photo e410','photo_album e411','photo_camera e412','photo_filter e43b','photo_library e413','photo_size_select_actual e432','photo_size_select_large e433','photo_size_select_small e434','picture_as_pdf e415','picture_in_picture e8aa','picture_in_picture_alt e911','pie_chart e6c4','pie_chart_outlined e6c5','pin_drop e55e','place e55f','play_arrow e037','play_circle_filled e038','play_circle_outline e039','play_for_work e906','playlist_add e03b','playlist_add_check e065','playlist_play e05f','plus_one e800','poll e801','polymer e8ab','pool eb48','portable_wifi_off e0ce','portrait e416','power e63c','power_input e336','power_settings_new e8ac','pregnant_woman e91e','present_to_all e0df','print e8ad','priority_high e645','public e80b','publish e255','query_builder e8ae','question_answer e8af','queue e03c','queue_music e03d','queue_play_next e066','radio e03e','radio_button_checked e837','radio_button_unchecked e836','rate_review e560','receipt e8b0','recent_actors e03f','record_voice_over e91f','redeem e8b1','redo e15a','refresh e5d5','remove e15b','remove_circle e15c','remove_circle_outline e15d','remove_from_queue e067','remove_red_eye e417','remove_shopping_cart e928','reorder e8fe','repeat e040','repeat_one e041','replay e042','replay_10 e059','replay_30 e05a','replay_5 e05b','reply e15e','reply_all e15f','report e160','report_problem e8b2','restaurant e56c','restaurant_menu e561','restore e8b3','restore_page e929','ring_volume e0d1','room e8b4','room_service eb49','rotate_90_degrees_ccw e418','rotate_left e419','rotate_right e41a','rounded_corner e920','router e328','rowing e921','rss_feed e0e5','rv_hookup e642','satellite e562','save e161','scanner e329','schedule e8b5','school e80c','screen_lock_landscape e1be','screen_lock_portrait e1bf','screen_lock_rotation e1c0','screen_rotation e1c1','screen_share e0e2','sd_card e623','sd_storage e1c2','search e8b6','security e32a','select_all e162','send e163','sentiment_dissatisfied e811','sentiment_neutral e812','sentiment_satisfied e813','sentiment_very_dissatisfied e814','sentiment_very_satisfied e815','settings e8b8','settings_applications e8b9','settings_backup_restore e8ba','settings_bluetooth e8bb','settings_brightness e8bd','settings_cell e8bc','settings_ethernet e8be','settings_input_antenna e8bf','settings_input_component e8c0','settings_input_composite e8c1','settings_input_hdmi e8c2','settings_input_svideo e8c3','settings_overscan e8c4','settings_phone e8c5','settings_power e8c6','settings_remote e8c7','settings_system_daydream e1c3','settings_voice e8c8','share e80d','shop e8c9','shop_two e8ca','shopping_basket e8cb','shopping_cart e8cc','short_text e261','show_chart e6e1','shuffle e043','signal_cellular_4_bar e1c8','signal_cellular_connected_no_internet_4_bar e1cd','signal_cellular_no_sim e1ce','signal_cellular_null e1cf','signal_cellular_off e1d0','signal_wifi_4_bar e1d8','signal_wifi_4_bar_lock e1d9','signal_wifi_off e1da','sim_card e32b','sim_card_alert e624','skip_next e044','skip_previous e045','slideshow e41b','slow_motion_video e068','smartphone e32c','smoke_free eb4a','smoking_rooms eb4b','sms e625','sms_failed e626','snooze e046','sort e164','sort_by_alpha e053','spa eb4c','space_bar e256','speaker e32d','speaker_group e32e','speaker_notes e8cd','speaker_notes_off e92a','speaker_phone e0d2','spellcheck e8ce','star e838','star_border e83a','star_half e839','stars e8d0','stay_current_landscape e0d3','stay_current_portrait e0d4','stay_primary_landscape e0d5','stay_primary_portrait e0d6','stop e047','stop_screen_share e0e3','storage e1db','store e8d1','store_mall_directory e563','straighten e41c','streetview e56e','strikethrough_s e257','style e41d','subdirectory_arrow_left e5d9','subdirectory_arrow_right e5da','subject e8d2','subscriptions e064','subtitles e048','subway e56f','supervisor_account e8d3','surround_sound e049','swap_calls e0d7','swap_horiz e8d4','swap_vert e8d5','swap_vertical_circle e8d6','switch_camera e41e','switch_video e41f','sync e627','sync_disabled e628','sync_problem e629','system_update e62a','system_update_alt e8d7','tab e8d8','tab_unselected e8d9','tablet e32f','tablet_android e330','tablet_mac e331','tag_faces e420','tap_and_play e62b','terrain e564','text_fields e262','text_format e165','textsms e0d8','texture e421','theaters e8da','thumb_down e8db','thumb_up e8dc','thumbs_up_down e8dd','time_to_leave e62c','timelapse e422','timeline e922','timer e425','timer_10 e423','timer_3 e424','timer_off e426','title e264','toc e8de','today e8df','toll e8e0','tonality e427','touch_app e913','toys e332','track_changes e8e1','traffic e565','train e570','tram e571','transfer_within_a_station e572','transform e428','translate e8e2','trending_down e8e3','trending_flat e8e4','trending_up e8e5','tune e429','turned_in e8e6','turned_in_not e8e7','tv e333','unarchive e169','undo e166','unfold_less e5d6','unfold_more e5d7','update e923','usb e1e0','verified_user e8e8','vertical_align_bottom e258','vertical_align_center e259','vertical_align_top e25a','vibration e62d','video_call e070','video_label e071','video_library e04a','videocam e04b','videocam_off e04c','videogame_asset e338','view_agenda e8e9','view_array e8ea','view_carousel e8eb','view_column e8ec','view_comfy e42a','view_compact e42b','view_day e8ed','view_headline e8ee','view_list e8ef','view_module e8f0','view_quilt e8f1','view_stream e8f2','view_week e8f3','vignette e435','visibility e8f4','visibility_off e8f5','voice_chat e62e','voicemail e0d9','volume_down e04d','volume_mute e04e','volume_off e04f','volume_up e050','vpn_key e0da','vpn_lock e62f','wallpaper e1bc','warning e002','watch e334','watch_later e924','wb_auto e42c','wb_cloudy e42d','wb_incandescent e42e','wb_iridescent e436','wb_sunny e430','wc e63d','web e051','web_asset e069','weekend e16b','whatshot e80e','widgets e1bd','wifi e63e','wifi_lock e1e1','wifi_tethering e1e2','work e8f9','wrap_text e25b','youtube_searched_for e8fa','zoom_in e8ff','zoom_out e900','zoom_out_map e56b');
			return $icons;
		}
	}
	function wpcast_icon_dropdown(){
		$list = wpcast_iconlist();
		$options = array();
		$n = 0;
		$options[] = '';
		foreach ( $list as $icon ) {
			$ia = explode(' ',$icon);
			$options[$ia[0]] = $ia[0];
			$n++;
		}
		// asort ($options);
		return $options;
	}
}

Kirki2_Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'wpcast_cta_i',
	'label'       => esc_html__( 'Icon', 'wpcast' ),
	'description' => esc_html__('Google material icons', "wpcast").' <a href="//'.'qantumthemes.xyz/cheatsheet/" target="_blank">See list</a>',
	'section'     => 'wpcast_cta_section',
	'default'     => 'rss_feed',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => wpcast_icon_dropdown()
) );



/* = Secondary Header
=============================================*/

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'switch',
	'settings'    => 'wpcast_sec_head_on',
	'label'       => esc_html__( 'Enable secondary header', "wpcast" ),
	'section'     => 'wpcast_secondary_header_section',
	'description' => esc_html__( 'Add header bar for optional menu and social icons', "wpcast" ),
	'priority'    => 10,
	'default'     => '1'
));




/* = Blog section
=============================================*/

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'switch',
	'settings'    => 'wpcast_postsidebar',
	'label'       => esc_html__( 'Post sidebar', "wpcast" ),
	'section'     => 'wpcast_blog_settings',
	'description' => esc_html__( 'Enable sidebar in single posts', "wpcast" ),
	'priority'    => 10,
));

/* = Header section
=============================================*/


Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'image',
	'settings'    => 'wpcast_logo_header',
	'label'       => esc_html__( 'Logo header', "wpcast" ),
	'section'     => 'wpcast_header_section',
	'description' => esc_html__( 'Max height: 95px', "wpcast" ),
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'image',
	'settings'    => 'wpcast_logo_header_mob',
	'label'       => esc_html__( 'Logo header mobile', "wpcast" ),
	'description' => esc_html__( 'Max height: 50px', "wpcast" ),
	'section'     => 'wpcast_header_section',
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'image',
	'settings'    => 'wpcast_header_bgimg',
	'label'       => esc_html__( 'Header background image', "wpcast" ),
	'description' => esc_html__( '1660x790', "wpcast" ),
	'section'     => 'wpcast_header_section',
	'priority'    => 10,
	'choices'     => array(
		'save_as' => 'id',
	),
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'switch',
	'settings'    => 'wpcast_header_parallax',
	'label'       => esc_html__( 'Parallax effect', "wpcast" ),
	'section'     => 'wpcast_header_section',
	'description' => esc_html__( 'Enable effect on scroll for archive and default headers', "wpcast" ),
	'priority'    => 10,
	'default'     => '0'
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'switch',
	'settings'    => 'wpcast_header_ol',
	'label'       => esc_html__( 'Header overlay tone', "wpcast" ),
	'section'     => 'wpcast_header_section',
	'description' => esc_html__( 'Add a color tone to the picture', "wpcast" ),
	'priority'    => 10,
	'default'     => '1'
));








// Header colors
// Kirki2_Kirki::add_field( 'wpcast_config', array(
// 	'type'        => 'color',
// 	'settings'    => 'wpcast_header_bgcolor',
// 	'label'       => esc_html__( 'Header background', "wpcast" ),
// 	'section'     => 'wpcast_header_section',
// 	'transport'		=> 'refresh',
// 	'priority'    => 0
// ));
// Kirki2_Kirki::add_field( 'wpcast_config', array(
// 	'type'        => 'color',
// 	'settings'    => 'wpcast_header_textcolor',
// 	'label'       => esc_html__( 'Header text', "wpcast" ),
// 	'section'     => 'wpcast_header_section',
// 	'priority'    => 0
// ));
// Kirki2_Kirki::add_field( 'wpcast_config', array(
// 	'type'        => 'color',
// 	'settings'    => 'wpcast_header_linkcolor',
// 	'label'       => esc_html__( 'Header links', "wpcast" ),
// 	'section'     => 'wpcast_header_section',
// 	'priority'    => 0
// ));
// Kirki2_Kirki::add_field( 'wpcast_config', array(
// 	'type'        => 'color',
// 	'settings'    => 'wpcast_header_linkcolor_h',
// 	'label'       => esc_html__( 'Header links hover', "wpcast" ),
// 	'section'     => 'wpcast_header_section',
// 	'priority'    => 0
// ));


/* = Website background
=============================================*/
/*Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'image',
	'settings'    => 'wpcast_sitebg',
	'label'       => esc_html__( 'Default page background', "wpcast" ),
	'section'     => 'wpcast_website_bg_section',
	'description' => esc_html__( 'Global background. Suggested size 1600 x 900px', "wpcast" ),
	'priority'    => 10
));

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'text',
	'settings'    => 'wpcast_sitebg_video',
	'label'       => esc_html__( 'Default YouTube background (ID)', "wpcast" ),
	'section'     => 'wpcast_website_bg_section',
	'description' => esc_html__( 'Overwritten by single page\'s video background', "wpcast" ),
	'priority'    => 10
));

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'checkbox',
	'settings'    => 'wpcast_sitebg_fadeout',
	'label'       => esc_html__( 'Fade out background on scroll', "wpcast" ),
	'section'     => 'wpcast_website_bg_section',
	'description' => esc_html__( 'Background photo or video disappears on scroll.', "wpcast" ),
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'slider',
	'settings'    => 'qt_darken_background',
	'label'       => esc_attr__( 'Darken page background', 'wpcast' ),
	'section'     => 'wpcast_website_bg_section',
	'default'     => '30',
	'priority'    => 12,
	'choices'     => array(
		'min'  => '0',
		'max'  => '90',
		'step' => '10',
	),
));*/



/* = Footer section
=============================================*/


Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'image',
	'settings'    => 'wpcast_logo_footer',
	'label'       => esc_html__( 'Logo footer', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 0,
	
	'transport'		=> 'refresh'
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'image',
	'settings'    => 'wpcast_footer_bgimg',
	'label'       => esc_html__( 'Footer background image', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 0,
	'transport'		=> 'refresh'
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'switch',
	'settings'    => 'wpcast_overlay_tone',
	'label'       => esc_html__( 'Overlay color', "wpcast" ),
	'description' => esc_html__( 'Adds main tones to the footer background', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 0,
	'default'     => '1'
));


// footer menu

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_footer_bg',
	'label'       => esc_html__( 'Footer background', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_footer_t',
	'label'       => esc_html__( 'Footer text', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_footer_l',
	'label'       => esc_html__( 'Footer links', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_footer_lh',
	'label'       => esc_html__( 'Footer links hover', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 0
));


// copyright bar
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'text',
	'settings'    => 'wpcast_footer_text',
	'label'       => esc_html__( 'Copyright text', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_copy_bg',
	'label'       => esc_html__( 'Copyright bar background', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_copy_t',
	'label'       => esc_html__( 'Copyright bar text', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_copy_l',
	'label'       => esc_html__( 'Copyright bar links', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_copy_lh',
	'label'       => esc_html__( 'Copyright bar links hover', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'color',
	'settings'    => 'wpcast_copy_decor',
	'label'       => esc_html__( 'Copyright decoration line', "wpcast" ),
	'section'     => 'wpcast_footer_section',
	'priority'    => 10
));


/* = Social section
=============================================*/
/* QT Socicons list
=============================================*/
if( !function_exists( 'wpcast_qt_socicons_array' )){
	function wpcast_qt_socicons_array(){
		return array(
			'android' 			=> 'Android',
			'amazon' 			=> 'Amazon',
			'facebook' 			=> 'Facebook',
			'flickr' 			=> 'Flickr',
			'googleplus' 		=> 'Googleplus',
			'instagram' 		=> 'Instagram',
			'itunes' 			=> 'iTunes',
			'linkedin' 			=> 'Linkedin',
			'soundcloud' 		=> 'Soundcloud',
			'snapchat' 			=> 'Snapchat',
			'pinterest' 		=> 'Pinterest',
			'myspace' 			=> 'Myspace',
			'spotify' 			=> 'Spotify',
			'twitter' 			=> 'Twitter',
			'vimeo' 			=> 'Vimeo',
			'vk' 				=> 'VK.com',
			'youtube' 			=> 'YouTube',
		);
	}
}

$qt_socicons_array = wpcast_qt_socicons_array();
ksort($qt_socicons_array);
foreach ( $qt_socicons_array as $var => $val ){
	Kirki2_Kirki::add_field( 'wpcast_config', array( 'settings' => 'wpcast_social_'.$var, 'type' => 'text', 'label' => $val, 'section' => 'wpcast_social_section',));
}




/* = Typography section
=============================================*/

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'typography',
	'settings'    => 'wpcast_typography_text',
	'label'       => esc_html__( 'Contents', "wpcast" ),
	'section'     => 'wpcast_typo_section',
	'default'     => array(
		'font-family'    => 'Karla',
		'variant'        => 'regular',
		'subsets'        => array( 'latin-ext' ),
		'letter-spacing' => '0em',
	),
	'priority'    => 10,
	'description' => esc_html__('Default: Karla 400. Be sure your language is supported by the font you choose on fonts.google.com', 'wpcast'),
	'output'      => array(
		array(
			'element' => 'body, html',
			'property' => 'font-family'
		),
	),
) );

Kirki2_Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'wpcast_typography_text_r',
	'label'       => esc_html__( 'Global text rendering', 'wpcast' ),
	'section'     => 'wpcast_typo_section',
	'default'     => 'geometricPrecision',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'geometricPrecision'   	=> esc_attr__( 'geometricPrecision', 'wpcast' ),
			'auto' 	=> esc_attr__( 'auto', 'wpcast' ),
			'optimizeSpeed' 	=> esc_attr__( 'optimizeSpeed', 'wpcast' ),
			'optimizeLegibility' 	=> esc_attr__( 'optimizeLegibility', 'wpcast' ),
			'initial' 	=> esc_attr__( 'initial', 'wpcast' ),
		)
) );


Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'typography',
	'settings'    => 'wpcast_typography_text_bold',
	'label'       => esc_html__( 'Bold', "wpcast" ),
	'section'     => 'wpcast_typo_section',
	'default'     => array(
		'font-family'    => 'Karla',
		'variant'        => '700',
		'subsets'        => array( 'latin-ext' ),
		'letter-spacing' => '-0.02em',
	),
	'description' => esc_html__('Default: Karla 700. Be sure your language is supported by the font you choose on fonts.google.com', 'wpcast'),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'strong',
			'property' => 'font-family'
		),
	),
) );

Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'typography',
	'settings'    => 'wpcast_typography_headings',
	'label'       => esc_html__( 'Headings', "wpcast" ),
	'section'     => 'wpcast_typo_section',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => '500',
		'letter-spacing' => '-0.04em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none'
	),
	'description' => esc_html__('Default: Rubik 500. Be sure your language is supported by the font you choose on fonts.google.com', 'wpcast'),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6',
			'property' => 'font-family'
		),
	),
) );
Kirki2_Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'wpcast_typography_headings_r',
	'label'       => esc_html__( 'Heading rendering', 'wpcast' ),
	'section'     => 'wpcast_typo_section',
	'default'     => 'geometricPrecision',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'geometricPrecision'   	=> esc_attr__( 'geometricPrecision', 'wpcast' ),
			'auto' 	=> esc_attr__( 'auto', 'wpcast' ),
			'optimizeSpeed' 	=> esc_attr__( 'optimizeSpeed', 'wpcast' ),
			'optimizeLegibility' 	=> esc_attr__( 'optimizeLegibility', 'wpcast' ),
			'initial' 	=> esc_attr__( 'initial', 'wpcast' ),
		)
) );



Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'typography',
	'settings'    => 'wpcast_typography_menu',
	'label'       => esc_html__( 'Menu, buttons and metas', "wpcast" ),
	'section'     => 'wpcast_typo_section',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => '500',
		'letter-spacing' => '0.04em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'uppercase',
	),
	'description' => esc_html__('Default: Rubik 500. Be sure your language is supported by the font you choose on fonts.google.com', 'wpcast'),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.wpcast-btn, .wpcast-caption, .wpcast-itemmetas, .wpcast-menu, .wpcast-secondaryhead, .wpcast-cats, .wpcast-menu-tree , button, input[type="button"], input[type="submit"], .button, .wpcast-meta, .wpcast-readm, .wpcast-navlink ',
			'property' => 'font-family'
		),
	),
));


Kirki2_Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'wpcast_typography_menu_r',
	'label'       => esc_html__( 'Menu rendering', 'wpcast' ),
	'section'     => 'wpcast_typo_section',
	'default'     => 'geometricPrecision',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'geometricPrecision'   	=> esc_attr__( 'geometricPrecision', 'wpcast' ),
			'auto' 	=> esc_attr__( 'auto', 'wpcast' ),
			'optimizeSpeed' 	=> esc_attr__( 'optimizeSpeed', 'wpcast' ),
			'optimizeLegibility' 	=> esc_attr__( 'optimizeLegibility', 'wpcast' ),
			'initial' 	=> esc_attr__( 'initial', 'wpcast' ),
		)
) );

/* = PowerPress section
=============================================*/
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'switch',
	'settings'    => 'wpcast_powerpress_player_disable',
	'label'       => esc_html__( 'Hide Powerpress player', "wpcast" ),
	'section'     => 'wpcast_powerpress_section',
	'description' => esc_html__( 'If using QTM Player, we suggest to enable the option.', "wpcast" ),
	'priority'    => 10,
	'default'     => '0'
));

/* = Podcasting
=============================================*/
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'text',
	'settings'    => 'custom_feed_url',
	'label'       => esc_html__( 'Custom subscribe link', "wpcast" ),
	'description' => esc_html__( 'Override default WordPress RSS feed URL with any custom link', "wpcast" ),
	'section'     => 'wpcast_podcasting_section',
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'wpcast_config', array(
	'type'        => 'switch',
	'settings'    => 'display_subscribe',
	'label'       => esc_html__( 'Display subscribe button', "wpcast" ),
	'section'     => 'wpcast_podcasting_section',
	'description' => esc_html__( 'Display the link to the subscription page', "wpcast" ),
	'priority'    => 10,
	'default'     => '1'
));