<?php

/**
 * Class Mosaic_for_WooCommerce_Mods.
 */
class Mosaic_for_WooCommerce_Mods {

	public function __construct() {

		add_filter( 'use_block_editor_for_post_type', 'activate_block_editor_for_products', 10, 2 );

		add_filter( 'woocommerce_taxonomy_args_product_cat', 'maybe_show_taxonomies_in_rest_api', 10, 1 );
		add_filter( 'woocommerce_taxonomy_args_product_tag', 'maybe_show_taxonomies_in_rest_api', 10, 1 );

	}

	/**
	 * Enable Gutenberg for Product Descriptions
	 *
	 * @param bool $can_edit
	 * @param string $post_type
	 *
	 * @return bool
	 */
	public function activate_block_editor_for_products( bool $can_edit, string $post_type ): bool {

		// Just activate it for products
		if ( $post_type === 'product' ) {
			return true;
		}

		return $can_edit;
	}

	/**
	 * Show product tags and categories in rest API for product management.
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	public function maybe_show_taxonomies_in_rest_api( array $args ): array {

		// Check if current user can edit products
		if ( current_user_can( 'edit_products' ) ) {
			$args['show_in_rest'] = true;
		}

		return $args;
	}

}
new Mosaic_for_WooCommerce_Mods();
