/** 
 * Simple dynamic block sample
 * 
 * Creates a block that doesn't render the save side, because it's rendered on PHP
 */

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
	'wpcast-blocks/authors-small', 
	{
		title: __('Authors small'), 
		icon: 'megaphone', 
		category: 'wpcast-blocks', 
	
	
		attributes: {
			number: {
				type: 'string',
			},
			orderby: {
				type: 'string',
				default: '',
			},
		},

		/**
		 * EDITOR controls
		 */
		edit ( props ) {
			

			//////////////////// VARIABLES
			///=================================================
			var number = props.attributes.number;
			var orderby = props.attributes.orderby; 
			

			//////////////////// UPDATE FUNCTIONS
			///=================================================
			function onChangeNumber ( content ) {
				props.setAttributes({number: content})
			}
			function onChangeOrder() {
				if ( orderby ) {
					props.setAttributes( { orderby: '' } );
				} else {
					props.setAttributes( { orderby: 'display_name' } );
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
							__('Authors Grid Small')
						),
						el(
							'p',
							null,
							__('Check block parameters to customize')
						),
						el(
							'p',
							null,
							__('Item amount:')+' '+number
						)
					),
					// Parameters
					el(
						InspectorControls,
						{},
						el(
							'p',
							{ className: 'editor-block-inspector__card-description'},
							__('Parameters for the Authors Grid Small')
						),
						el(
							ToggleControl,
							{
								label: __('Order by name'),
								checked: !!orderby,
								onChange: onChangeOrder
							}
						),
						el(
							TextControl,
							{
								label: __('Number of items'),
								value: number,
								onChange: onChangeNumber
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