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
	'wpcast-blocks/featured-author', 
	{
		title: __('Featured author'), 
		icon: 'megaphone', 
		category: 'wpcast-blocks', 
	
	
		attributes: {
			id: {
				type: 'string',
			}
		},

		/**
		 * EDITOR controls
		 */
		edit ( props ) {
			

			//////////////////// VARIABLES
			///=================================================
			var id = props.attributes.id;
			

			//////////////////// UPDATE FUNCTIONS
			///=================================================
			function onChangeId ( content ) {
				props.setAttributes({id: content})
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
							__('Featured author')
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
								label: __('Author ID'),
								value: id,
								onChange: onChangeId
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