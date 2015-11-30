<?php
/**
 * Hide WooCommerce Product Shipping Information - Admin Settings
 *
 * Add a setting to the product's shipping tab and in the global products > display settings area.
 *
 * @class 	Hide_WC_Product_Shipping_Information_Admin
 * @version 1.0
 * @author 	Caleb Burks
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hide_WC_Product_Shipping_Information_Admin {

	/**
	 * Constructor for the admin class.
	 */
	public function __construct() {
		// Add and save the product setting
		add_action( 'woocommerce_product_options_dimensions', array( $this, 'add_product_settings_field' ) );
		add_action( 'woocommerce_process_product_meta', array( $this, 'save_product_settings_field' ) );

		// Add the global setting
		add_filter( 'woocommerce_product_settings', array( $this, 'add_global_settings_field' ) );
	}

	public function add_product_settings_field() {
		woocommerce_wp_checkbox( 
			array(  'id' => 'woocommerce_hide_product_shipping_information',
					'label' => __( 'Hide Shipping Info', 'hide-woocommerce-product-shipping-information' ),
					'description' => __( 'Prevent the shipping dimensions from showing on this product\'s page', 'hide-woocommerce-product-shipping-information' )
				)
		);
	}

	public function save_product_settings_field( $post_id ){
		$checkbox = isset( $_POST['woocommerce_hide_product_shipping_information'] ) ? 'yes' : 'no';
		update_post_meta( $post_id, 'woocommerce_hide_product_shipping_information', $checkbox );
	}

	public function add_global_settings_field( $settings ) {
		$settings['3'] = array(
			'title'         => __( 'Hide Shipping Info', 'hide-woocommerce-product-shipping-information' ),
			'desc'          => __( 'Hide product shipping information on all product pages', 'hide-woocommerce-product-shipping-information' ),
			'id'            => 'woocommerce_hide_product_shipping_information_global',
			'default'       => 'no',
			'type'          => 'checkbox',
		);
		return $settings;
	}

}
