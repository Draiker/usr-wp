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
	createElement     	= wp.element.createElement,
	ToggleControl     	= wp.components.ToggleControl,
	{ __ } 				= wp.i18n;

/**
 * Registers and creates block
 * 
 * Compatible with Gutenberg 2.2.0+
 * 
 * @param Name Name of the block with a required name space
 * @param ObjectArgs Block configuration {
 *      title - Title, displayed in the editor
 *      icon - Icon, from WP icons
 *      category - Block category, where the block will be added in the editor
 *      attributes - Object with all binding elements between the view HTML and the functions 
 *      edit function - Returns the markup for the editor interface.
 *      save function - Returns the markup that will be rendered on the site page
 * }
 * 
 */
registerBlockType(
	'wpcast-blocks/authors-small', // Name of the block with a required name space
	{
		title: __('Authors small'), // Title, displayed in the editor
		icon: 'megaphone', // Icon, from WP icons
		category: 'common', // Block category, where the block will be added in the editor
	
		/**
		 * Object with all binding elements between the view HTML and the functions
		 * It lets you bind data from DOM elements and storage attributes
		 */
		attributes: {
			// Number 1
			// It doesn't use source attribute, so it doesn't come from save() rendered DOM
			// They'll be saved on the block's source code as a JSON
			number: {
				type: 'string',
			},
			// Number 2
			// It doesn't use source attribute, so it doesn't come from save() rendered DOM
			// They'll be saved on the block's source code as a JSON
			orderby: {
				type: 'string',
			},

			applyStyles: {
				type: 'string',
				default: '',
			},
		},

		/**
		 * edit function
		 * 
		 * Makes the markup for the editor interface.
		 * 
		 * @param object props Let's you bind markup and attributes as well as other controls
		 * 
		 * @return JSX ECMAScript Markup for the editor 
		 */
		edit ( props ) {
			
			var number = props.attributes.number;
			var orderby = props.attributes.orderby; 
			var applyStyles = props.attributes.applyStyles; 
			
			function onChangeNumber ( content ) {
				props.setAttributes({number: content})
			}

			function onChangeOrder ( content ) {
				props.setAttributes({orderby: content})
			}             

			function onChangeStyleSettings() {
				if ( applyStyles ) {
					props.setAttributes( { applyStyles: '' } );
				} else {
					props.setAttributes( { applyStyles: 'styled' } );
				}
			} 
			 
			var controls = [
				createElement(
					InspectorControls,
					{},
					createElement(
						ToggleControl,
						{
							label: __('Apply Styles'),
							checked: !!applyStyles,
							onChange: onChangeStyleSettings
						}
					),
				),
			];

			return (
				el(
					Fragment,
					null,
					el (
						Text,
						{
							key: 'editable',
							tagName: 'p',
							className: props.className,
							onChange: onChangeNumber,
							placeholder: "Number of items",
							value: number,
						}
					),
						el(
					
						InspectorControls,
						{},
						createElement(
							ToggleControl,
							{
								label: __('Apply Styles'),
								checked: !!applyStyles,
								onChange: onChangeStyleSettings
							}
						),
					
				),
					/*el(
						Text,
						{
							key: 'editable',
							tagName: 'p',
							className: props.className,
							onChange: onChangeNumber,
							placeholder: "Number of items",
							value: number,
						}
					),
					el(
						Text,
						{
							key: 'editable',
							tagName: 'p',
							className: props.className,
							onChange: onChangeOrder,
							placeholder: "Ordering",
							value: orderby,
						}
					)*/
				)
			
			)
		},
 
		/**
		 * save function
		 * 
		 * Makes the markup that will be rendered on the site page
		 * 
		 * In this case, it does not render, because this block is rendered on server side
		 * 
		 * @param object props Let's you bind markup and attributes as well as other controls
		 * @return JSX ECMAScript Markup for the site
		 */
		save ( props ) {
			return null // See PHP side. This block is rendered on PHP.
		},
	} 
);