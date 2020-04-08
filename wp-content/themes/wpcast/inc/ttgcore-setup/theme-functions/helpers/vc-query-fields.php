<?php
function wpcast_vc_query_fields(){

	
	$postTypes = get_post_types( array() );
	$postTypesList = array();
	$excludedPostTypes = array(
		'revision',
		'nav_menu_item',
		'custom_css',
		'customize_changeset',
		'vc_grid_item',
		'oembed_cache',
		'attachment',
	);
	if ( is_array( $postTypes ) && ! empty( $postTypes ) ) {
		foreach ( $postTypes as $postType ) {
			if ( ! in_array( $postType, $excludedPostTypes ) ) {
				$label = ucfirst( $postType );
				$postTypesList[] = array(
					$postType,
					$label,
				);
			}
		}
	}
	$postTypesList[] = array(
		'custom',
		__( 'Custom query', 'wpcast' ),
	);
	$postTypesList[] = array(
		'ids',
		__( 'List of IDs', 'wpcast' ),
	);

	$taxonomiesForFilter = array();

	if ( 'vc_edit_form' === vc_post_param( 'action' ) ) {
		$vcTaxonomiesTypes = vc_taxonomies_types();
		if ( is_array( $vcTaxonomiesTypes ) && ! empty( $vcTaxonomiesTypes ) ) {
			foreach ( $vcTaxonomiesTypes as $t => $data ) {
				if ( 'post_format' !== $t && is_object( $data ) ) {
					$taxonomiesForFilter[ $data->labels->name . '(' . $t . ')' ] = $t;
				}
			}
		}
	}
	$fields = array(
		array(
		   "type" => "textfield",
		   'group' => esc_html__( 'Data Settings', 'wpcast' ),
		   "heading" => esc_html__( "Posts by ID", "wpcast" ),
		   "description" => esc_html__( "Display only the contents with these IDs. All other parameters will be ignored.", "wpcast" ),
		   "param_name" => "include_by_id",
		   'value' => ''
		),

		array(
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'type' => 'textfield',
			'heading' => esc_html__( 'Total items', 'wpcast' ),
			'admin_label' => true,
			'param_name' => 'items_per_page',
			'std' => 10,
			'value' => 10,
			// default value
			'param_holder_class' => 'vc_not-for-custom',
			'description' => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'wpcast' ),
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),
		// Category filtering ===================================================================================================
		array(
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'type' 			=> 'autocomplete',
			'heading' => esc_html__( 'Narrow data source', 'wpcast' ),
			'description' => esc_html__( 'Enter categories, tags, formats or custom taxonomies.', 'wpcast' ),
			'param_name' 	=> 'tax_filter',
			'settings'		=> array( 
				'values' 		 => wpcast_get_terms_array() ,
				'multiple'       => true,
				'sortable'       => true,
	      		'min_length'     => 1,
	      		'groups'         => false,  // In UI show results grouped by groups
	      		'unique_values'  => true,  // In UI show results except selected. NB! You should manually check values in backend
	      		'display_inline' => true, // In UI show results inline view),
			),
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),

		// Custom query tab ===================================================================================================
		array(
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'type' => 'textarea_safe',
			'heading' => esc_html__( 'Custom query', 'wpcast' ),
			'param_name' => 'custom_query',
			'description' => esc_html__( 'Build custom query according to WordPress.', 'wpcast' ).' <a href="http://codex.wordpress.org/Function_Reference/query_posts" target="_blank">WordPress Codex</a>',
			'dependency' => array(
				'element' => 'post_type',
				'value' => array( 'custom' ),
			),
		),


		// Data settings ===================================================================================================
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order by', 'wpcast' ),
			'param_name' => 'orderby',
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'value' => array(
				esc_html__( 'Date', 'wpcast' ) => 'date',
				esc_html__( 'Order by post ID', 'wpcast' ) => 'ID',
				esc_html__( 'Author', 'wpcast' ) => 'author',
				esc_html__( 'Title', 'wpcast' ) => 'title',
				esc_html__( 'Last modified date', 'wpcast' ) => 'modified',
				esc_html__( 'Post/page parent ID', 'wpcast' ) => 'parent',
				esc_html__( 'Number of comments', 'wpcast' ) => 'comment_count',
				esc_html__( 'Menu order/Page Order', 'wpcast' ) => 'menu_order',
				esc_html__( 'Meta value', 'wpcast' ) => 'meta_value',
				esc_html__( 'Meta value number', 'wpcast' ) => 'meta_value_num',
				esc_html__( 'Random order', 'wpcast' ) => 'rand',
			),
			'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'wpcast' ),
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Sort order', 'wpcast' ),
			'param_name' => 'order',
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'value' => array(
				esc_html__( 'Descending', 'wpcast' ) => 'DESC',
				esc_html__( 'Ascending', 'wpcast' ) => 'ASC',
			),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'description' => esc_html__( 'Select sorting order.', 'wpcast' ),
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Meta key', 'wpcast' ),
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'param_name' => 'meta_key',
			'description' => esc_html__( 'Input meta key for grid ordering.', 'wpcast' ),
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'dependency' => array(
				'element' => 'orderby',
				'value' => array(
					'meta_value',
					'meta_value_num',
				),
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Offset', 'wpcast' ),
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'param_name' => 'offset',
			'description' => esc_html__( 'Number of grid elements to displace or pass over.', 'wpcast' ),
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Exclude', 'wpcast' ),
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'param_name' => 'exclude',
			'description' => esc_html__( 'Exclude posts, pages, etc. by ID.', 'wpcast' ),
			'group' => esc_html__( 'Data Settings', 'wpcast' ),
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
				'callback' => 'vc_grid_exclude_dependency_callback',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'wpcast' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wpcast' ),
		),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Container ID', 'wpcast' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'wpcast' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'vc_grid_id',
			'param_name' => 'grid_id',
		),
	);


	return $fields;
}