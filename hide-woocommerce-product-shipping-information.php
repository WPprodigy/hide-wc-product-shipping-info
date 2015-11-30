<?php
/**
 * Plugin Name: Hide WooCommerce Product Shipping Information
 * Description: Control which products should display shipping information on the product page.
 * Version: 1.0
 * Author: Caleb Burks
 * Author URI: http://calebburks.com
 *
 * Text Domain: hide-woocommerce-product-shipping-information
 * Domain Path: /languages/
 *
 * Requires at least: 4.0
 * Tested up to: 4.4
 *
 * Copyright: (c) 2015 Caleb Burks
 * License: GPL v3 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-3.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'plugins_loaded', 'hide_woocommerce_product_shipping_information', 35 );
function hide_woocommerce_product_shipping_information() {
	if ( ! class_exists( "Hide_WC_Product_Shipping_Information" ) && class_exists( 'WooCommerce' ) ) {
		require_once( 'classes/class-hide-wc-product-shipping-information.php' );
		new Hide_WC_Product_Shipping_Information;
	}
}

/* Silence is Golden */