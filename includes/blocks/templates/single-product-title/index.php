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
function mosaic_for_woocommerce_blocks_single_product_title_block_init() {

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
		'mosaic-for-woocommerce-blocks-single-product-title-editor',
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
		'mosaic-for-woocommerce-blocks-single-product-title-editor',
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
		'mosaic-for-woocommerce-blocks-single-product-title',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	/*
	 * Add the block type
	 */
	register_block_type( 'mosaic-for-woocommerce/single-product-title', array(
		'editor_script'   => 'mosaic-for-woocommerce-blocks-single-product-title-editor',
		'editor_style'    => 'mosaic-for-woocommerce-blocks-single-product-title-editor',
		'style'           => 'mosaic-for-woocommerce-blocks-single-product-title',
		'render_callback' => 'mosaic_for_woocommerce_blocks_single_product_title_render_callback',
		'attributes'      => array(
			'align'           => array(
				'type' => 'string',
			),
			'backgroundColor' => array(
				'type' => 'string',
			),
			'textColor'       => array(
				'type' => 'string',
			),
		),
	) );

}
add_action( 'init', 'mosaic_for_woocommerce_blocks_single_product_title_block_init', 100 );

/**
 * Render callback for block.
 *
 * @param array $attributes
 * @param string $content
 *
 * @return string
 */
function mosaic_for_woocommerce_blocks_single_product_title_render_callback( array $attributes, string $content ): string {

	// Collect classes
	$classes = array(
		'wp-block',
		'mosaic-for-woocommerce-blocks-single-product-title',
	);

	if ( isset( $attributes['align'] ) ) {
		$classes[] = esc_attr( 'has-text-align-' . $attributes['align'] );
	}

	if ( isset( $attributes['backgroundColor'] ) ) {
		$classes[] = 'has-background';
		$classes[] = esc_attr( 'has-' . $attributes['backgroundColor'] . '-background-color' );
	}

	if ( isset( $attributes['textColor'] ) ) {
		$classes[] = 'has-text-color';
		$classes[] = esc_attr( 'has-' . $attributes['textColor'] . '-color' );
	}

	ob_start();
	?>

	<div id="single-product-title" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php
		// Do the add to cart stuff
		woocommerce_template_single_title();
		?>
	</div>

	<?php
	// Return the markup
	return ob_get_clean();
}
