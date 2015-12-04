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
 * @package DemoBar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'DemoBar' ) ) :

	/**
	 * Main Class.
	 */
	class DemoBar {

		/**
		 * Plugin version.
		 *
		 * @var string
		 * @since 1.0.0
		 */
		public $version = '1.0.0';

		/**
		 * Plugin instance.
		 *
		 * @var DemoBar The single instance of the class.
		 * @since 1.0.0
		 */
		protected static $_instance = null;


		/**
		 * Main DemoBar Instance.
		 *
		 * Ensures only one instance of DemoBar is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 * @return DemoBar - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}


		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();

			do_action( 'demobar_loaded' );
		}

		/**
		 * Define Constants.
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function define_constants() {
			$this->define( 'DEMOBAR_PLUGIN_FILE', __FILE__ );
			$this->define( 'DEMOBAR_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'DEMOBAR_VERSION', $this->version );
			$this->define( 'DEMOBAR_PLUGIN_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
			$this->define( 'DEMOBAR_PLUGIN_URI', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
		}

		/**
		 * Define constant if not already set.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @param string      $name Define key.
		 * @param string|bool $value Define value.
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @since 1.0.0
		 */
		public function includes() {
			include_once( 'includes/class-demobar-post-types.php' );
			include_once( 'includes/class-demobar-install.php' );
			include_once( 'includes/class-demobar-switcher.php' );

			if ( $this->is_request( 'admin' ) ) {
				require_once( 'includes/admin/class-demobar-admin.php' );
			}
		}

		/**
		 * What type of request is this?
		 * string $type ajax, frontend or admin.
		 *
		 * @since 1.0.0
		 *
		 * @param string $type Request type.
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin' :
					return is_admin();
				case 'ajax' :
					return defined( 'DOING_AJAX' );
				case 'cron' :
					return defined( 'DOING_CRON' );
				case 'frontend' :
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
			}
		}

		/**
		 * Hook into actions and filters.
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function init_hooks() {
			register_activation_hook( __FILE__, array( 'DemoBar_Install', 'install' ) );
			add_action( 'init', array( $this, 'init' ), 0 );
		}

		/**
		 * Plugin init.
		 *
		 * @since 1.0.0
		 */
		function init() {
			// Load plugin text domain.
			load_plugin_textdomain( 'demo-bar', false, basename( dirname( __FILE__ ) ) . '/languages' );
		}
}
endif;

/**
 * Main instance of DemoBar.
 *
 * Returns the main instance of DBR to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return DemoBar
 */
function DBR() {
	return DemoBar::instance();
}

// Global for backwards compatibility.
$GLOBALS['demobar'] = DBR();
