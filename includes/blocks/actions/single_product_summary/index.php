<?php
/**
 * Register client-side assets (scripts and stylesheets) for the block.
 *
 * @package mosaic-for-woocommerce
 * @since 1.0.0
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 */
function mosaic_for_woocommerce_blocks_single_product_summary_block_init() {

	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	// Get file directory
	$dir = dirname( __FILE__ );

	/*
	 * Add main js file
	 */
	// Put main js file name into var
	$index_js = 'index.js';

	// Register main js file
	wp_register_script(
		'mosaic-for-woocommerce-blocks-single-product-summary-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-components',
			'wp-editor',
			'wp-server-side-render',
			'wp-compose',
			'wp-data',
			'wp-api',
		),
		filemtime( "$dir/$index_js" )
	);

	/*
	 * Add editor style
	 */
	// Put editor styles file name into var
	$editor_css = 'editor.css';

	// Add editor styles
	wp_register_style(
		'mosaic-for-woocommerce-blocks-single-product-summary-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	/*
	 * Frontend styles
	 */
	// Add frontend styles to var name
	$style_css = 'style.css';

	// Load frontend styles
	wp_register_style(
		'mosaic-for-woocommerce-blocks-single-product-summary',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	/*
	 * Add the block type
	 */
	register_block_type( 'mosaic-for-woocommerce/single-product-summary', array(
		'editor_script'   => 'mosaic-for-woocommerce-blocks-single-product-summary-editor',
		'editor_style'    => 'mosaic-for-woocommerce-blocks-single-product-summary-editor',
		'style'           => 'mosaic-for-woocommerce-blocks-single-product-summary',
		'render_callback' => 'mosaic_for_woocommerce_blocks_single_product_summary_render_callback',
		'attributes'      => array(),
	) );

}
add_action( 'init', 'mosaic_for_woocommerce_blocks_single_product_summary_block_init', 100 );

/**
 * Render callback for block.
 *
 * @param array $attributes
 * @param string $content
 *
 * @return string
 */
function mosaic_for_woocommerce_blocks_single_product_summary_render_callback( array $attributes, string $content ): string {

	// Collect classes
	$classes = array(
		'mosaic-for-woocommerce-blocks-single-product-summary',
	);
	if ( 'full' === $attributes['align'] ) {
		$classes[] = 'alignfull';
	}

	ob_start();
	?>

	<div id="single-product-summary" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php
		// Do the add to cart stuff
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	// Return the markup
	return ob_get_clean();
}
