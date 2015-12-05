<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package DemoBar
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Cleanup plugin options.
delete_option( 'demobar_options' );
