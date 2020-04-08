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
	'wpcast-blocks/category-grid', 
	{
		title: __('Category grid'), 
		icon: 'category', 
		category: 'wpcast-blocks', 
	
	
		attributes: {
			hide_empty: {
				type: 'string',
				default: '', 
			},
			label: {
				type: 'string',
				default: 'episodes',
			},
			include: {
				type: 'string',
			},
			
			exclude: {
				type: 'string', 
			},
			parent: {
				type: 'string',
			},
			child_of: {
				type: 'string',
			},
		},

		/**
		 * EDITOR controls
		 */
		edit ( props ) {
			

			//////////////////// VARIABLES
			///=================================================
			var hide_empty	= props.attributes.hide_empty,
				label 		= props.attributes.label,
				include 	= props.attributes.include,
				exclude		= props.attributes.exclude,
				parent		= props.attributes.parent,
				child_of	= props.attributes.child_of;
			

			//////////////////// UPDATE FUNCTIONS
			///=================================================
			function onChangeLabel ( content ) {
				props.setAttributes({label: content})
			}
			function onChangeInclude ( content ) {
				props.setAttributes({include: content})
			}
			function onChangeExclude ( content ) {
				props.setAttributes({exclude: content})
			}
	
			function onChangeChildOf ( content ) {
				props.setAttributes({child_of: content})
			}
			function onChangeHideEmpty() {
				if ( hide_empty ) {
					props.setAttributes( { hide_empty: '' } );
				} else {
					props.setAttributes( { hide_empty: '1' } );
				}
			} 
			function onChangeParent() {
				if ( parent ) {
					props.setAttributes( { parent: '' } );
				} else {
					props.setAttributes( { parent: '1' } );
				}
			} 


			//////////////////// RETURN
			///=================================================
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
							__('Category Grid')
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
							'p',
							{ className: 'editor-block-inspector__card-description'},
							__('Category Grid Parameters')
						),
						el(
							ToggleControl,
							{
								label: __('Hide empty categories'),
								checked: !!hide_empty,
								onChange: onChangeHideEmpty
							}
						),
						el(
							ToggleControl,
							{
								label: __('Only parent categories (ignore Child Of)'),
								checked: !!parent,
								onChange: onChangeParent
							}
						),
						el(
							TextControl,
							{
								label: __('Posts count label'),
								value: label,
								onChange: onChangeLabel,
								default: __( 'Episodes' )
							}
						),
						el(
							TextControl,
							{
								label: __('Include only following ID'),
								value: include,
								onChange: onChangeInclude
							}
						),
						el(
							TextControl,
							{
								label: __('Exclude only following ID'),
								value: exclude,
								onChange: onChangeExclude
							}
						),
						el(
							TextControl,
							{
								label: __('Only child of these IDs'),
								value: child_of,
								onChange: onChangeChildOf
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