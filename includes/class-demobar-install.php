<?php
/**
 * Installation related functions and actions
 *
 * @package DemoBar/Classes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * DemoBar_Install Class.
 */
class DemoBar_Install {


	/**
	 * Install.
	 */
	public static function install() {
		// Register post types.
		DemoBar_Post_Types::register_post_types();
		// Flush rules after install.
		flush_rewrite_rules();
	}
}
