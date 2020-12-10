<?php
/**
 * Plugin Name: Mosaic for WooCommerce
 * Description: Serverside driven blocks for WooCommerce
 * Version:     1.0.0
 * Author:      Drivingralle
 * Author URI:  https://www.drivingralle.de
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mosaic-for-woocommerce
 * Domain Path: /languages/
 */

 if( ! defined( 'ABSPATH' ) ) {
 	exit;
 }

/**
  * Load plugin text domain
  *
  * @since 1.0.0
  */
function mosaic_for_woocommerce_load_textdomain() {

	load_plugin_textdomain( 'mosaic-for-woocommerce', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

}
add_action( 'plugins_loaded', 'mosaic_for_woocommerce_load_textdomain' );

/**
  * Function to run after plugin activation
  *
  * @since 1.0.0
  */
function mosaic_for_woocommerce_activate() {

    // Activation code here...

}
register_activation_hook( __FILE__, 'mosaic_for_woocommerce_activate' );

/**
  * Function to run after plugin deactivation
  *
  * @since 1.0.0
  */
function mosaic_for_woocommerce_deactivate() {

    // Activation code here...

}
register_deactivation_hook( __FILE__, 'mosaic_for_woocommerce_deactivate' );

/*
 * Load features
 */
require_once 'includes/woocommerce-mods.php';
require_once 'includes/blocks/blocks.php';
