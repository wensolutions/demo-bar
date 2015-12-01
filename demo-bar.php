<?php
/**
 * Plugin Name: Demo Bar
 * Plugin URI: https://github.com/ernilambar/demo-bar
 * Description: This plugin helps to add demo bar for displaying your different theme demos.
 * Version: 1.0.0
 * Author: Nilambar Sharma
 * Author URI: http://www.nilambar.net
 * Requires at least: 4.1
 * Tested up to: 4.4
 * Text Domain: demo-bar
 *
 * @package Demo_Bar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Common constants.
 */
define( 'DEMO_BAR_VERSION', '1.0.0' );
define( 'DEMO_BAR_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'DEMO_BAR_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );


if ( ! class_exists( 'Demo_Bar' ) ) {

	/**
	 * Main Class.
	 */
	class Demo_Bar {

		/**
		 * Plugin options.
		 *
		 * @since 1.0.0
		 * @access private
		 * @var array
		 */
		var $demo_bar_options;

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			// Load plugin options.
			$this->demo_bar_options = get_option( 'demo_bar_options' );

			// Executes when init hook is fired.
			add_action( 'init', array( $this, 'init' ) );

		}

		/**
		 * Plugin init.
		 *
		 * @since 1.0.0
		 */
		function init(){

			// Load plugin text domain.
			load_plugin_textdomain( 'demo-bar', false, basename( dirname( __FILE__ ) ) . '/languages' );

		}

	}
}

$demo_bar_obj = new Demo_Bar();
