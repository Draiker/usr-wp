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
	'wpcast-blocks/series-grid-small', 
	{
		title: __('Series grid small'), 
		icon: 'archive', 
		category: 'wpcast-blocks', 
	
		attributes: {
			hide_empty: {
				type: 'string',
			},
			columns: {
				type: 'string',
				default: '6'
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
				columns 		= props.attributes.columns,
				include 	= props.attributes.include,
				exclude		= props.attributes.exclude,
				parent		= props.attributes.parent,
				child_of	= props.attributes.child_of;
			

			//////////////////// UPDATE FUNCTIONS
			///=================================================
			
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


			var ColumnsRadio = el(
				RadioControl,
				{
					label: __('Columns'),
					selected: columns,
					options: [
						{ label: '1', value: '1' },
						{ label: '2', value: '2' },
						{ label: '3', value: '3'},
						{ label: '4', value: '4'},
						{ label: '6', value: '6'}
					] ,
					onChange: function( new_val ) {
		            	props.setAttributes( { columns: new_val } )
		            },
				}
			);


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
							__('Series grid small')
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
							__('Series grid parameters')
						),
						ColumnsRadio,
						el(
							ToggleControl,
							{
								label: __('Hide empty series'),
								checked: !!hide_empty,
								onChange: onChangeHideEmpty
							}
						),
						el(
							ToggleControl,
							{
								label: __('Only parent series (ignore Child Of)'),
								checked: !!parent,
								onChange: onChangeParent
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