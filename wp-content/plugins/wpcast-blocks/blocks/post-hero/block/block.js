// Required components


var el 					= wp.element.createElement,
	Fragment 			= wp.element.Fragment
	registerBlockType 	= wp.blocks.registerBlockType,
	RichText 			= wp.editor.RichText,
	Text 				= wp.editor.PlainText,
	BlockControls 		= wp.editor.BlockControls,
	AlignmentToolbar 	= wp.editor.AlignmentToolbar,
	InspectorControls 	= wp.editor.InspectorControls,
	TextControl			= wp.components.TextControl,
	createElement     	= wp.element.createElement,
	ToggleControl     	= wp.components.ToggleControl,
	{ __ } 				= wp.i18n;

/**
 * Registers and creates block
 */
registerBlockType(
	'wpcast-blocks/post-hero', 
	{
		title: __('Post Hero'), 
		icon: 'star-filled', 
		category: 'wpcast-blocks', 
	
	
		// attributes: {
		// 	id: {
		// 		type: 'string',
		// 	},
		// 	category: {
		// 		type: 'string',
		// 	},
		// 	category_exclude: {
		// 		type: 'string',
		// 	},
			
		// 	quantity: {
		// 		type: 'string', 
		// 	},
		// 	offset: {
		// 		type: 'string',
		// 	},
		// 	orderby: {
		// 		type: 'string',
		// 	},
		// },


		attributes: {
			post_type: {
				type: 'string',
			},
			include_by_id: {
				type: 'string',
			},
			custom_query: {
				type: 'string',
			},
			
			tax_filter: {
				type: 'string', 
			},
			items_per_page: {
				type: 'string',
			},
			orderby: {
				type: 'string',
			},
			order: {
				type: 'string',
			},
			meta_key: {
				type: 'string',
			},
			offset: {
				type: 'string',
			},
			exclude: {
				type: 'string',
			},
		},


		/**
		 * EDITOR controls
		 */
		edit ( props ) {

			//////////////////// VARIABLES
			///=================================================
			// var id	= props.attributes.id,
			// 	category 		= props.attributes.category,
			// 	category_exclude 	= props.attributes.category_exclude,
			// 	quantity		= props.attributes.quantity,
			// 	offset		= props.attributes.offset,
			// 	orderby	= props.attributes.orderby;
			
			var post_type		= props.attributes.post_type,
				include_by_id 	= props.attributes.include_by_id,
				custom_query 	= props.attributes.custom_query,
				tax_filter		= props.attributes.tax_filter,
				items_per_page	= props.attributes.items_per_page,
				orderby			= props.attributes.orderby,
				order			= props.attributes.order,
				meta_key		= props.attributes.meta_key,
				offset			= props.attributes.offset,
				exclude			= props.attributes.exclude;

			//////////////////// UPDATE FUNCTIONS
			///=================================================
			// function onChangeId ( content ) {
			// 	props.setAttributes({id: content})
			// }
			// function onChangeCategory ( content ) {
			// 	props.setAttributes({category: content})
			// }
			// function onChangeExclude ( content ) {
			// 	props.setAttributes({category_exclude: content})
			// }
	
			// function onChangeQuantity ( content ) {
			// 	props.setAttributes({quantity: content})
			// }
			// function onChangeoOffset() {
			// 	props.setAttributes({offset: content})
			// } 
			// function onChangeOrderby() {
			// 	props.setAttributes({orderby: content})
			// } 



			// return (
			// 	el(
			// 		Fragment,
			// 		null,
			// 		// Editor contents
			// 		el( 'div', 
			// 			{ className: props.className+' wpcast-blocks-placeholder ' }, 
			// 			el(
			// 				'h3',
			// 				null,
			// 				__('Hero Post')
			// 			),
			// 			el(
			// 				'p',
			// 				null,
			// 				__('Check block parameters to customize')
			// 			)
			// 		),
			// 		// Parameters
			// 		el(
			// 			InspectorControls,
			// 			{},
			// 			el(
			// 				TextControl,
			// 				{
			// 					label: __('Specific post by ID'),
			// 					value: id,
			// 					onChange: onChangeId,
			// 				}
			// 			),
			// 			el(
			// 				TextControl,
			// 				{
			// 					label: __('Category to include (slug)'),
			// 					value: category,
			// 					onChange: onChangeCategory
			// 				}
			// 			),
			// 			el(
			// 				TextControl,
			// 				{
			// 					label: __('Category to exclude (slug)'),
			// 					value: category_exclude,
			// 					onChange: onChangeExclude
			// 				}
			// 			),
			// 			el(
			// 				TextControl,
			// 				{
			// 					label: __('Quantity'),
			// 					value: quantity,
			// 					onChange: onChangeQuantity
			// 				}
			// 			),
			// 			el(
			// 				TextControl,
			// 				{
			// 					label: __('Offset - posts to skip'),
			// 					value: offset,
			// 					onChange: onChangeoOffset
			// 				}
			// 			),
			// 			el(
			// 				TextControl,
			// 				{
			// 					label: __('Order by [rand|date|id]'),
			// 					value: orderby,
			// 					onChange: onChangeOrderby
			// 				}
			// 			),
			// 		),
			// 	)
			// )
			
			return (
				el(
					Fragment,
					null,
					// Editor contents
					el( 'div', 
						{ className: props.className+' wpcast-blocks-placeholder ' }, 
						el(
							'h3',
							null,
							__('Post hero')
						),
						el(
							'p',
							null,
							__('Check block parameters to customize')
						)
					),
					// Parameters
					el(
						InspectorControls,
						{},
						el(
							TextControl,
							{
								label: __('Offset (posts to skip)'),
								value: offset,
								onChange:  function( new_val ) {
									props.setAttributes({offset: new_val})
								},
							}
						),
						el(
							TextControl,
							{
								label: __('Taxonomy filter [Example category:trending, post_tag:video]'),
								value: tax_filter,
								onChange:  function( new_val ) {
									props.setAttributes({tax_filter: new_val})
								},
							}
						),
						el(
							TextControl,
							{
								label: __('Items amount'),
								value: items_per_page,
								onChange:  function( new_val ) {
									props.setAttributes({items_per_page: new_val})
								},
							}
						),
						
						el(
							TextControl,
							{
								label: __('Specific posts by ID'),
								value: include_by_id,
								onChange:  function( new_val ) {
									props.setAttributes({include_by_id: new_val})
								},
							}
						),
						el(
							TextControl,
							{
								label: __('Post type'),
								value: post_type,
								onChange:  function( new_val ) {
									props.setAttributes({post_type: new_val})
								},
							}
						),
						
						
						el(
							TextControl,
							{
								label: __('Order by'),
								value: orderby,
								onChange:  function( new_val ) {
									props.setAttributes({orderby: new_val})
								},
							}
						),
						el(
							TextControl,
							{
								label: __('Order by'),
								value: order,
								onChange:  function( new_val ) {
									props.setAttributes({order: new_val})
								},
							}
						),
						el(
							TextControl,
							{
								label: __('Meta key'),
								value: meta_key,
								onChange:  function( new_val ) {
									props.setAttributes({meta_key: new_val})
								},
							}
						),
						el(
							TextControl,
							{
								label: __('Exclude (id list to exclude)'),
								value: exclude,
								onChange:  function( new_val ) {
									props.setAttributes({exclude: new_val})
								},
							}
						),
						el(
							TextControl,
							{
								label: __('Custom Query [Example year=2012]'),
								value: custom_query,
								onChange:  function( new_val ) {
									props.setAttributes({custom_query: new_val})
								},
							}
						),
						
						
					),
				)
			)
		},
		save ( props ) {
			return null // See PHP side. This block is rendered on PHP.
		},
	} 
);