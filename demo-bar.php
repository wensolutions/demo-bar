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

			// Add meta box.
			add_action( 'add_meta_boxes', array( $this, 'add_site_meta_box' ) );
		}

		/**
		 * Plugin init.
		 *
		 * @since 1.0.0
		 */
		function init() {
			// Load plugin text domain.
			load_plugin_textdomain( 'demo-bar', false, basename( dirname( __FILE__ ) ) . '/languages' );

			// Register post types.
			$this->register_post_types();
		}

		/**
		 * Add meta box.
		 *
		 * @since 1.0.0
		 */
		function add_site_meta_box() {
			add_meta_box(
				'dbsite-settings',
				esc_html__( 'Site Info', 'demo-bar' ),
				array( $this, 'render_site_settings_metabox' ),
				'dbsite'
			);
		}

		/**
		 * Render site settings metabox.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Post $post    WP_Post object.
		 * @param array   $metabox Metabox arguments.
		 */
		function render_site_settings_metabox( $post, $metabox ) {
			// Meta box nonce for verification.
			wp_nonce_field( basename( __FILE__ ), 'demo_bar_site_settings_meta_box_nonce' );

			$demo_bar_site_url     = get_post_meta( $post->ID, 'demo_bar_site_url', true );
			$demo_bar_download_url = get_post_meta( $post->ID, 'demo_bar_download_url', true );
			?>
			<p>
				<label for="demo_bar_site_url"><?php echo esc_html__( 'Site URL', 'demo-bar' ); ?><br /><input type="text" value="<?php echo esc_url( $demo_bar_site_url ); ?>" class="regular-text" name="demo_bar_site_url" id="demo_bar_site_url" /></label>
			</p>
			<p>
				<label for="demo_bar_download_url"><?php echo esc_html__( 'Download URL', 'demo-bar' ); ?><br /><input type="text" value="<?php echo esc_url( $demo_bar_download_url ); ?>" class="regular-text" name="demo_bar_download_url" id="demo_bar_download_url" /></label>
			</p>
			<?php

		}

		/**
		 * Register post types.
		 *
		 * @since 1.0.0
		 */
		function register_post_types() {
			$labels = array(
				'name'                  => __( 'Sites', 'demo-bar' ),
				'singular_name'         => __( 'Site', 'demo-bar' ),
				'menu_name'             => _x( 'Sites', 'Admin menu name', 'demo-bar' ),
				'add_new'               => __( 'Add Site', 'demo-bar' ),
				'add_new_item'          => __( 'Add New Site', 'demo-bar' ),
				'edit'                  => __( 'Edit', 'demo-bar' ),
				'edit_item'             => __( 'Edit Site', 'demo-bar' ),
				'new_item'              => __( 'New Site', 'demo-bar' ),
				'view'                  => __( 'View Site', 'demo-bar' ),
				'view_item'             => __( 'View Site', 'demo-bar' ),
				'search_items'          => __( 'Search Sites', 'demo-bar' ),
				'not_found'             => __( 'No Sites found', 'demo-bar' ),
				'not_found_in_trash'    => __( 'No Sites found in trash', 'demo-bar' ),
				'parent'                => __( 'Parent Site', 'demo-bar' ),
				'featured_image'        => __( 'Site Image', 'demo-bar' ),
				'set_featured_image'    => __( 'Set site image', 'demo-bar' ),
				'remove_featured_image' => __( 'Remove site image', 'demo-bar' ),
				'use_featured_image'    => __( 'Use as site image', 'demo-bar' ),
			);
			$args = array(
				'public'    => true,
				'labels'    => $labels,
				'menu_icon' => 'dashicons-admin-site',
				'supports'  => array( 'title', 'thumbnail' ),
			);
			$args = apply_filters( 'demo_bar_register_post_type_dbsite', $args );
			register_post_type( 'dbsite', $args );
		}
	}
}

$demo_bar_obj = new Demo_Bar();
