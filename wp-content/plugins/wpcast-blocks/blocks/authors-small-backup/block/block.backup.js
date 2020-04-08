// ( function( wp ) {
	// License: GPLv2+

	var el = wp.element.createElement,
		registerBlockType = wp.blocks.registerBlockType,
		ServerSideRender = wp.components.ServerSideRender,
		TextControl = wp.components.TextControl,
		RichText = wp.editor.RichText,
		InspectorControls = wp.editor.InspectorControls;

	/*
	 * Here's where we register the block in JavaScript.
	 *
	 * It's not yet possible to register a block entirely without JavaScript, but
	 * that is something I'd love to see happen. This is a barebones example
	 * of registering the block, and giving the basic ability to edit the block
	 * attributes. (In this case, there's only one attribute, 'foo'.)
	 */
	registerBlockType( 'wpcast-blocks/authors-small', {
		title: 'Authors small',
		icon: 'megaphone',
		category: 'widgets',

		/*
		 * In most other blocks, you'd see an 'attributes' property being defined here.
		 * We've defined attributes in the PHP, that information is automatically sent
		 * to the block editor, so we don't need to redefine it here.
		 */

		edit: function( props ) {

			var number = props.attributes.number

			function onChangeNumber( newNumber ) {
				props.setAttributes( { number: newNumber } );
			}

			return (
				el(
					RichText,
					{
						key: 'editable',
						tagName: 'p',
						className: props.className,
						onChange: onChangeNumber,
						value: number,
					}
				)
			);
				
			// return [
				
			// 	el( ServerSideRender, {
			// 		block: 'wpcast-blocks/authors-small',
			// 		attributes: props.attributes,
			// 	} ),
				
			// 	el( InspectorControls, {},
			// 		el( TextControl, {
			// 			label: 'Number',
			// 			value: props.attributes.number,
			// 			onChange: ( value ) => { props.setAttributes( { number: value } ); },
			// 		} )
			// 	),
			// ];
		},

		// We're going to be rendering in PHP, so save() can just return null.
		save: function(props) {
			var number = props.attributes.number;

	        return el( RichText.Content, {
	            tagName: 'p',
	            className: props.className,
	            
	            value: number
	        } );
			// return null;
		},
	} );
// });
