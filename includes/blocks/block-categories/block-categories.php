<?php
/**
 * Creating a custom block category for mosaic blocks.
 *
 * @param array $categories List of block categories.
 * @param WP_Post $post Post object.
 *
 * @return  array
 */
function mosaic_for_woocommerce_blocks_actions_category( array $categories, WP_Post $post ): array {

	// Prepare data
	$category_slugs = wp_list_pluck( $categories, 'slug' );

	// List of categories to add
	$block_categories = array(
		'actions_category'   => array(
			'title' => esc_html( sprintf( __( '%s: %s', 'mosaic-for-woocommerce' ), __( 'Mosaic', 'mosaic-for-woocommerce' ), __( 'WooCommerce Actions', 'mosaic-for-woocommerce' ) ) ),
			'slug'  => 'mosaic-for-woocommerce-actions',
			'icon'  => 'hammer',
		),
		'templates_category' => array(
			'title' => esc_html( sprintf( __( '%s: %s', 'mosaic-for-woocommerce' ), __( 'Mosaic', 'mosaic-for-woocommerce' ), __( 'WooCommerce Templates', 'mosaic-for-woocommerce' ) ) ),
			'slug'  => 'mosaic-for-woocommerce-templates',
			'icon'  => 'welcome-widgets-menus',
		),
		'customs_category'   => array(
			'title' => esc_html( sprintf( __( '%s: %s', 'mosaic-for-woocommerce' ), __( 'Mosaic', 'mosaic-for-woocommerce' ), __( 'Custom Blocks', 'mosaic-for-woocommerce' ) ) ),
			'slug'  => 'mosaic-for-woocommerce-custom',
			'icon'  => 'admin-tools',
		),
	);

	// Loop the categories
	foreach ( $block_categories as $category ) {
		// Check if adding is needed
		if ( ! in_array( $category['slug'], $category_slugs, true ) ) {
			$categories = array_merge(
				$categories,
				array(
					array(
						'title' => $category['title'], // Required
						'slug'  => $category['slug'], // Required
						'icon'  => $category['icon'], // Slug of a WordPress dashicon or custom SVG
					),
				)
			);
		}
	}

	return $categories;
}
add_filter( 'block_categories', 'mosaic_for_woocommerce_blocks_actions_category', 20, 2 );
