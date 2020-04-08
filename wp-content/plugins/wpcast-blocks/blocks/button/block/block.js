/** 
 * Simple dynamic block sample
 * 
 * Creates a block that doesn't render the save side, because it's rendered on PHP
 */

// Required components

// '[qt-button text="Click here" link="http" target="_blank" style="wpcast-btn-primary" alignment="left|center|right" class="custom-classes"]'
// 
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
	'wpcast-blocks/button', 
	{
		title: __('Button'), 
		icon: 'admin-links', 
		category: 'wpcast-blocks', 
		attributes: {
			text: {
				type: 'string',
				default: 'Click here',
			},
			link: {
				type: 'string',
			},
			target: {
				type: 'string',
				default: '', // if checked, open in new window
			},
			style: {
				type: 'string', // if checked, use accent color 
				default: '',
			},
			alignment: {
				type: 'string', // if checked, center 
				default: '',
			},
		},

		/**
		 * EDITOR controls
		 */
		edit ( props ) {
			

			//////////////////// VARIABLES
			///=================================================
			var text 	= props.attributes.text,
				link 	= props.attributes.link,
				target	= props.attributes.target,
				style	= props.attributes.style,
				alignment	= props.attributes.alignment;
			

			//////////////////// UPDATE FUNCTIONS
			///=================================================
			function onChangeText ( content ) {
				props.setAttributes({text: content})
			}
			function onChangeLink ( content ) {
				props.setAttributes({link: content})
			}
			function onChangeTarget() {
				if ( target ) {
					props.setAttributes( { target: '' } );
				} else {
					props.setAttributes( { target: '_blank' } );
				}
			} 
			function onChangeStyle() {
				if ( style ) {
					props.setAttributes( { style: '' } );
				} else {
					props.setAttributes( { style: 'wpcast-btn-primary' } );
				}
			} 
			function onChangeAlignment() {
				if ( alignment ) {
					props.setAttributes( { alignment: '' } );
				} else {
					props.setAttributes( { alignment: 'aligncenter' } );
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
						{ className: props.className+' '+alignment }, 
						el(
							TextControl,
							{
								key: 'editable',
								tagName: 'span',
								className: 'wpcast-btn '+alignment+' '+style,
								onChange: onChangeText,
								placeholder: __( "Text" ),
								value: text,
							}
						),
					),
					
					el(
						InspectorControls,
						{},
						el(
							'p',
							null,
							__('Button parameters')
						),
						el(
							TextControl,
							{
								label: __('Button text'),
								value: text,
								onChange: onChangeText
							}
						),
						el(
							TextControl,
							{
								label: __('Button link'),
								value: link,
								onChange: onChangeLink
							}
						),
						el(
							ToggleControl,
							{
								label: __('Target'),
								checked: !!target,
								onChange: onChangeTarget
							}
						),
						el(
							ToggleControl,
							{
								label: __('Accent colors'),
								checked: !!style,
								onChange: onChangeStyle
							}
						),
						el(
							ToggleControl,
							{
								label: __('Alignment'),
								checked: !!alignment,
								onChange: onChangeAlignment
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