/** 
 * Simple dynamic block sample
 * 
 * Creates a block that doesn't render the save side, because it's rendered on PHP
 */

// Required components

// [qt-caption title="My Title" size="xs|s|m|l|xl" alignment="center|left"]
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
	RadioControl     	= wp.components.RadioControl,
	setState			= wp.compose.withState,
	{ __ } 				= wp.i18n;

/**
 * Registers and creates block
 */
registerBlockType(
	'wpcast-blocks/caption', 
	{
		title: __('Caption'), 
		icon: 'admin-links', 
		category: 'wpcast-blocks', 
		attributes: {
			title: {
				type: 'string',
				default: __('Caption Here'),
			},
			size: {
				type: 'string',
				default: 'm'
			},
			cssclass: {
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
			var title 	= props.attributes.title,
				size	= props.attributes.size,
				cssclass	= props.attributes.cssclass,
				alignment	= props.attributes.alignment,
				tag = 'h4',
				classes = '';
			

			//////////////////// UPDATE FUNCTIONS
			///=================================================
			function onChangeTitle ( content ) {
				props.setAttributes({title: content})
			}
	
			function onChangeCssClass ( content ) {
				props.setAttributes({cssclass: content})
			}
			
			

			function onChangeAlignment() {
				if ( alignment ) {
					props.setAttributes( { alignment: '' } );
				} else {
					props.setAttributes( { alignment: 'center' } );
				}
			} 

			

			var SizeRadio = el(
				RadioControl,
				{
					label: __('Size'),
					selected: size,
					options: [
						{ label: 'XS', value: 'xs' },
						{ label: 'S', value: 's' },
						{ label: 'M', value: 'm'},
						{ label: 'L', value: 'l'},
						{ label: 'XL', value: 'xl'},
					] ,
					onChange: function( new_val ) {
		            	props.setAttributes({size: new_val})
		            },
				}
			);

			function getTagSize(size){
				var tag;

				switch ( size ){
					case 'xs':
						tag = 'h6';
						break;
					case 's':
						tag = 'h5';
						break;
					case 'l':
						tag = 'h3';
						break;
					case 'xl':
						tag = 'h2';
						break;
					case 'm':
					default:
						tag = 'h4';
				}
				return tag;
			}
		

			//////////////////// RETURN
			///=================================================
			return (
				el(
					Fragment,
					null,
					// Editor contents
					el( 'div', 
						{ className: props.className }, 
						el(
							getTagSize( size ),
							{
								className: 'wpcast-element-caption wpcast-caption ' + ' wpcast-caption__'+size+ ' '+( (alignment === 'center')? ' wpcast-center wpcast-caption__c ': '' ),
							},
							title
						),
					),
					
					el(
						InspectorControls,
						{},
						el(
							'p',
							null,
							__('Caption parameters')
						),
						el(
							TextControl,
							{
								label: __('Caption title'),
								value: title,
								onChange: onChangeTitle
							}
						),
						el(
							TextControl,
							{
								label: __('Extra CSS classes'),
								value: cssclass,
								onChange: onChangeCssClass
							}
						),
						
						el(
							ToggleControl,
							{
								label: __('Center'),
								checked: !!alignment,
								onChange: onChangeAlignment
							}
						),
						SizeRadio
						
					),
				)
			)
		},
		save ( props ) {
			return null // See PHP side. This block is rendered on PHP.
		},
	} 
);