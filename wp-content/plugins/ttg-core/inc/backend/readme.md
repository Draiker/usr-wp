Conditional fields
---------


	array (
			'label' => esc_html__('Disable Page Background',"kentha"),
			'id' => 'kentha_disable_bg',
			'class' => 'qw-conditional-fields',
			'type' => 'chosen',
			'options' => array(
			  	array(
			   		'label' => __('Show background','_s'),
					'value' => 1,
					'revealfields'=>array('#kentha_image_bg','#kentha_video_bg','#kentha_video_start','#kentha_fadeout'),
					'hidefields'=>array()
					),
			    array(
			   		'label' => __('Hide background','_s'),
					'value' => 0,
					'hidefields'=>array('#kentha_image_bg','#kentha_video_bg','#kentha_video_start','#kentha_fadeout'),
					'revealfields'=>array()
					),
			)
		),