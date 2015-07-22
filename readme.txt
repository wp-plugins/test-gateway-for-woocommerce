=== Plugin Name ===
Contributors: seanbarton
Requires at least: 4.0
Tested up to: 4.4.*
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a test payment gateway to WooCommerce available only to logged in administrators or when WP_DEBUG is enabled

== Description ==

Adds a test payment gateway to WooCommerce available only to logged in administrators or when WP_DEBUG is enabled. If you enable this and then look inside your available payment processors for WooCommerce you will see the basic settings for the plugin.

This can be safelty used in the live environment for telephone/email orders etc as only an administrator can see the gateway. I've been using it for testing conversion code from a variety of different affiliate systems.

Also when WP_DEBUG is set to true in your wp-config.php file this will show for everyone. Not recommended in the live environment but is useful when testing the user journey for new builds.

== Installation ==

1. Upload the entire directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Activate the payment processor in the WooCommerce settings

== Changelog ==

= 1.4 =
* Initial build. Has been used for a few versions but never version controlled
* Updates to follow if requested!