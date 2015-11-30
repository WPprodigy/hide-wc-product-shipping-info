<?php
/**
 * Hide WooCommerce Product Shipping Information
 *
 * Control whether the shipping information is shown or hidden.
 *
 * @class 	Hide_WC_Product_Shipping_Information
 * @version 1.0
 * @author 	Caleb Burks
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hide_WC_Product_Shipping_Information {

	/**
	 * Constructor for the main class.
	 *
	 * @access public
	 */
	public function __construct() {
		if ( is_admin() ) {
			// Admin Settings
			require_once 'admin/class-hide-wc-product-shipping-information-admin.php';
			new Hide_WC_Product_Shipping_Information_Admin;
		}

		// Hook into the page to add the 'wc_product_enable_dimensions_display' filter.
		add_action( 'wp', array( $this, 'display_shipping_info' ), 30 );
	}

	/**
	 * Get the current product's ID.
	 *
	 * @access public
	 */
	public function get_product_id() {
		$product_id = get_the_ID();
		return $product_id;
	}

	/**
	 * Get the product setting.
	 *
	 * @access public
	 */
	public function product_set_to_hide() {
		$product_hide_shipping = get_post_meta( $this->get_product_id(), 'woocommerce_hide_product_shipping_information', true );

		if ( 'yes' == $product_hide_shipping ) {
			$hide = true;
		} else {
			$hide = false;
		}

		return $hide;
	}

	/**
	 * Get the global admin setting.
	 *
	 * @access public
	 */
	public function global_set_to_hide() {
		$global_hide_shipping = get_option( 'woocommerce_hide_product_shipping_information_global', 'no' );

		if ( 'yes' == $global_hide_shipping ) {
			$hide = true;
		} else {
			$hide = false;
		}

		return $hide;
	}

	/**
	 * Add filter for hiding the shipping information based on the settings above.
	 *
	 * @access public
	 */
	public function display_shipping_info() {
		if ( $this->product_set_to_hide() || $this->global_set_to_hide() ) {
			add_filter( 'wc_product_enable_dimensions_display', '__return_false', 15 );
		}
	}

}
