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
	 *
	 * @since 1.0.0
	 */
	public static function install() {
		// Register post types.
		DemoBar_Post_Types::register_post_types();
		// Flush rules after install.
		flush_rewrite_rules();
		// Set default options.
		self::set_default_plugin_options();
	}

	/**
	 * Set default settings.
	 *
	 * @since 1.0.0
	 */
	public static function set_default_plugin_options() {
		$default_settings = self::get_default_settings();
		if ( ! get_option( 'demobar_options' ) ) {
			update_option( 'demobar_options', $default_settings );
		}
	}

	/**
	 * Fetch default settings.
	 *
	 * @since 1.0.0
	 *
	 * @return array Defaults options.
	 */
	public static function get_default_settings() {
		$default = array(
			// General options.
			'logo'                   => '',
			'background_color'       => '#363636',
			'show_responsive_button' => true,
			'show_purchase_button'   => true,
			'show_close_button'      => true,
			// Page options.
			'demo_page'              => '',
			'page_meta_description'  => '',
			'page_meta_keywords'     => '',
			// Advance options.
			'custom_css'             => '',
		);
		return $default;
	}
}
