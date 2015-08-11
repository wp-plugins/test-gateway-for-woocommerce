=== Plugin Name ===
Contributors: seanbarton
Requires at least: 4.0
Tested up to: 4.4.*
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: WooCommerce, Payment gateway, test gateway, paymentless gateway

A payment gateway plugin for Woocommerce to handle test or paymentless transactions. Shows for admin only by default, everyone in WP_DEBUG or using a variety of gateway settings

== Description ==

Adds a test payment gateway to WooCommerce. By default it is available only to logged in administrators or when WP_DEBUG is enabled. However, there is a setting which enables the gateway for everyone to use. This is especially useful where you want customers to enter their address info etc but for no money to change hands. Similar to the COD or BACS gateways except this will set their order as paid instead of pending. If you enable this and then look inside your available payment processors for WooCommerce you will see the basic settings for the plugin.

This can be safely used in the live environment for telephone/email orders etc as outside of the settings to enable for certain groups, only an administrator can see the gateway. I've been using it for testing conversion code from a variety of different affiliate systems.

Also when WP_DEBUG is set to true in your wp-config.php file this will show for everyone. Very useful when testing the user journey for new builds or in situations where payment is not needed

== Installation ==

1. Upload the entire directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Activate the payment processor in the WooCommerce settings

== Changelog ==

= 1.4 =
* Initial build. Has been used for a few versions but never version controlled
* Updates to follow if requested!

= 1.5 =
* Added 'enable for visitors' option in the settings
* Added 'enable for IP' option in the settings