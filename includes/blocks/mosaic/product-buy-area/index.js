/**
 * Block Styles Example
 *
 * https://github.com/modularwp/gutenberg-block-styles-example
 */
( function () {
	let __ = wp.i18n.__; // The __() function for internationalization.
	let createElement = wp.element.createElement; // The wp.element.createElement() function to create elements.
	let registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() function to register blocks.
	let ServerSideRender = wp.serverSideRender; // For displaying server rendered elements.

	/**
	 * Register block
	 *
	 * @param  {string}   name     Block name.
	 * @param  {Object}   settings Block settings.
	 * @return {?WPBlock}          Block itself, if registered successfully,
	 *                             otherwise "undefined".
	 */
	registerBlockType(
		'mosaic-for-woocommerce/product-buy-area', // Block name. Must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
		{
			title: __( 'Buy area' ), // Block title. __() function allows for internationalization.
			icon: 'cart', // Block icon from Dashicons. https://developer.wordpress.org/resource/dashicons/.
			category: 'mosaic-for-woocommerce-custom', // Block category.
			keywords: [ __( 'add to cart' ), __( 'buy' ), __( 'price' ) ],

			supports: {
				html: true,
			},

			attributes: {},

			// Defines the block within the editor.
			edit: function ( {attributes, setAttributes} ) {
				return [
					createElement(
						ServerSideRender,
						{
							block: 'mosaic-for-woocommerce/product-buy-area',
							attributes: attributes,
						}
					),
				];
			},

			// Defines the saved block.
			save: function ( {attributes} ) {
				return null;
			},
		}
	);
} )();
