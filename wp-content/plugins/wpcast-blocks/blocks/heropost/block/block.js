( function( wp ) {
	/**
	 * Registers a new block provided a unique name and an object defining its behavior.
	 * @see https://github.com/WordPress/gutenberg/tree/master/blocks#api
	 */
	var registerBlockType = wp.blocks.registerBlockType;
	/**
	 * Returns a new element of given type. Element is an abstraction layer atop React.
	 * @see https://github.com/WordPress/gutenberg/tree/master/packages/element#element
	 */
	var el = wp.element.createElement;
	/**
	 * Retrieves the translation of text.
	 * @see https://github.com/WordPress/gutenberg/tree/master/i18n#api
	 */
	var __ = wp.i18n.__;


	var withSelect = wp.data.withSelect;


	// https://gist.github.com/pento/cf38fd73ce0f13fcf0f0ae7d6c4b685d
	var TextControl = wp.components.TextControl;
	var InspectorControls = wp.editor.InspectorControls;




	/**
	 * Every block starts by registering a new block type definition.
	 * @see https://wordpress.org/gutenberg/handbook/block-api/
	 */
	registerBlockType( 'wpcast-blocks/heropost', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __( 'Hero Post' ),

		/**
		 * Blocks are grouped into categories to help users browse and discover them.
		 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
		 */
		category: 'embed',

		icon: 'megaphone',

	
		edit: withSelect( function( select ) {
			return {
				posts: select( 'core' ).getEntityRecords( 'postType', 'post' )
			};
		} )( function( props ) {

			if ( ! props.posts ) {
				return "Loading...";
			}

			if ( props.posts.length === 0 ) {
				return "No posts";
			}
			var className = props.className;
			var post = props.posts[ 0 ];

			return el(
				'a',
				{ className: className, href: post.link },
				post.title.rendered
			);
		} ),

		save: function() {
			// Rendering in PHP
			return null;
		},
	} );
} )(
	window.wp
);