<?php

/**
 * Plugin Name: Test Payment Module for Woocommerce
 * Plugin URI:  http://www.tortoise-it.co.uk
 * Description: A payment gateway plugin for Woocommerce to handle test or paymentless transactions. Shows for admin only by default or everyone in WP_DEBUG or using a gateway setting
 * Author:      Sean Barton (Tortoise IT)
 * Author URI:  http://www.tortoise-it.co.uk
 * Version:     1.5
 */

function sb_wc_test_init() {
	if (!class_exists('WC_Payment_Gateway')) {
		return;
	}
	
	class WC_Gateway_sb_test extends WC_Payment_Gateway {
	
		public function __construct() {
			$this->id = 'sb_test';
			$this->has_fields = false;
			$this->method_title = __( 'Test/Paymentless', 'woocommerce' );
			$this->init_form_fields();
			$this->init_settings();
			$this->title = 'Test/Paymentless gateway';
	
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		}
		
		function init_form_fields() {
			$this->form_fields = array(
				'enabled' => array(
					'title' => __( 'Enable/Disable', 'woocommerce' ),
					'type' => 'checkbox',
					'label' => __( 'Enable test gateway', 'woocommerce' ),
					'default' => 'yes'
				),
				'enabled_visitors' => array(
					'title' => __( 'Enable for visitors', 'woocommerce' ),
					'type' => 'checkbox',
					'label' => __( 'Allow non admins to use this gateway (for testing or for paymentless stores)', 'woocommerce' ),
					'default' => 'no'
				),
				'enabled_ip' => array(
					'title' => __( 'Enable for specific IP addresses', 'woocommerce' ),
					'type' => 'textarea',
					'label' => __( 'In the following field enter IP addresses (one per line) to enable this gateway for specific IPs', 'woocommerce' ),
					'default' => ''
				)
			);
		}
	    
		
		public function admin_options() {
			echo '	<h3>Test/Paymentless gateway</h3>
				<table class="form-table">';
				
			$this->generate_settings_html();
			
			echo '	</table>';
		}
	
		public function process_payment( $order_id ) {
			global $woocommerce;
	    
			$order = new WC_Order( $order_id );
			$order->payment_complete();
			$order->reduce_order_stock();
			$woocommerce->cart->empty_cart();
	
			return array(
				'result' => 'success',
				//'redirect' => add_query_arg('key', $order->order_key, add_query_arg('order', $order->id, get_permalink(woocommerce_get_page_id('thanks')))),
				'redirect' => $order->get_checkout_order_received_url()
			);
		}
	
	}	

	function add_sb_test_gateway( $methods ) {
		
		$show_visitors = $show_ip = false;
		
		if ($settings = get_option('woocommerce_sb_test_settings')) {
			if (isset($settings['enabled_visitors']) && $settings['enabled_visitors'] == 'yes') {
				$show_visitors = true;
			}
			if (isset($settings['enabled_ip'])) {
				if ($ips = explode("\n", $settings['enabled_ip'])) {
					foreach ($ips as $ip) {
						$ip = trim($ip);
						if ($_SERVER['REMOTE_ADDR'] == $ip) {
							$show_ip = true;
							break;
						}
					}
				}
			}
		}
		
		if (current_user_can('administrator') || WP_DEBUG || $show_visitors || $show_ip) {
			$methods[] = 'WC_Gateway_sb_test';
		}
		
		return $methods;
	}
	
	add_filter('woocommerce_payment_gateways', 'add_sb_test_gateway' );
	
}

add_filter('plugins_loaded', 'sb_wc_test_init' );

?>