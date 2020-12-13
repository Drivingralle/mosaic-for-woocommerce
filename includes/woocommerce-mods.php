<?php

/**
 * Class Mosaic_for_WooCommerce_Mods.
 */
class Mosaic_for_WooCommerce_Mods {

	public function __construct() {

		add_filter( 'use_block_editor_for_post_type', array( $this, 'activate_block_editor_for_products' ), 100, 2 );

		add_filter( 'woocommerce_taxonomy_args_product_cat', array( $this, 'maybe_show_taxonomies_in_rest_api' ), 10, 1 );
		add_filter( 'woocommerce_taxonomy_args_product_tag', array( $this, 'maybe_show_taxonomies_in_rest_api' ), 10, 1 );

		add_action( 'add_meta_boxes', array( $this, 'remove_short_description' ), 999 );

		add_action( 'plugins_loaded', array( $this, 'remove_woocommerce_actions' ), 998 );

		add_filter( 'template_include', array( $this, 'portfolio_page_template' ), 99 );

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

	/**
	 * Remove short description meta box.
	 */
	public function remove_short_description() {
		remove_meta_box('postexcerpt', 'product', 'normal');
	}

	/**
	 * Remove default actions by WooCommerce Core.
	 */
	public function remove_woocommerce_actions() {

		// Clear product image hook
//		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
//		remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

		// Clear product details
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
//		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

		// Remove tabs from product page
//		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
//		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
//		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	}

	/**
	 * Use page template over WooCommerce plugin template.
	 *
	 * @param string $template
	 *
	 * @return string
	 */
	function portfolio_page_template( $template ) : string {

		// Check if view is a product
		if ( is_product()  ) {
			// Try to get new template
			$new_template = locate_template( array( 'page.php' ) );

			// Check if new template was found
			if ( '' != $new_template ) {
				// return new template path to be loaded
				return $new_template ;
			}
		}

		return $template;
	}

}
new Mosaic_for_WooCommerce_Mods();
