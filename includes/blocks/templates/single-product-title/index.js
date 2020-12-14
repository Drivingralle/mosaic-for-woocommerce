/**
 * Block Main JS file
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
		'mosaic-for-woocommerce/single-product-title', // Block name. Must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
		{
			title: __('Mosaic') + ': ' + __( 'Tempalte' ) + ': ' + __( 'Single Product Title' ), // Block title.
			icon: 'tag', // Block icon from Dashicons. https://developer.wordpress.org/resource/dashicons/.
			category: 'mosaic-for-woocommerce-templates', // Block category. Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
			keywords: [ __( 'title' ), __( 'headline' ), __( 'name' ) ],

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
							block: 'mosaic-for-woocommerce/single-product-title',
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
