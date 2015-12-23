<?php
/**
 * Post Types
 *
 * Registers post types and taxonomies.
 *
 * @package DemoBar/Classes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * DemoBar_Post_Types Class.
 */
class DemoBar_Post_Types {

	/**
	 * Hook in methods.
	 */
	public static function init() {

		// Register post types.
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
		// Add thumbnail support if not added by theme.
		add_action( 'after_setup_theme', array( __CLASS__, 'add_thumbnail_support' ), 99 );

	}

	/**
	 * Register core post types.
	 */
	public static function register_post_types() {
		if ( post_type_exists( 'dbsite' ) ) {
			return;
		}
		$labels = array(
			'name'                  => __( 'Demo Bar', 'demo-bar' ),
			'singular_name'         => __( 'Site', 'demo-bar' ),
			'menu_name'             => __( 'Demo Bar', 'demo-bar' ),
			'all_items'             => __( 'Sites', 'demo-bar' ),
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
			'public'             => true,
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => false,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_icon'          => 'dashicons-admin-site',
			'supports'           => array( 'title', 'thumbnail' ),
		);
		register_post_type( 'dbsite', $args );
	}

	/**
	 * Add extra theme support for thumbanil.
	 *
	 * @since 1.0.0
	 */
	public static function add_thumbnail_support() {
		$supportedTypes = get_theme_support( 'post-thumbnails' );
		if ( false === $supportedTypes ) {
			add_theme_support( 'post-thumbnails', array( 'dbsite' ) );
		} elseif ( is_array( $supportedTypes ) ) {
			$supportedTypes[0][] = 'dbsite';
			add_theme_support( 'post-thumbnails', $supportedTypes[0] );
		}
	}
}

DemoBar_Post_Types::init();
