<?php
/**
 * Switcher.
 *
 * @package DemoBar/Classes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * DemoBar_Switcher Class.
 */
class DemoBar_Switcher {

	/**
	 * Init.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		add_filter( 'template_include', array( __CLASS__, 'custom_template' ), 99 );
		add_filter( 'wp_enqueue_scripts', array( __CLASS__, 'front_scripts' ), 99 );
	}

	/**
	 * Load custom template.
	 *
	 * @since 1.0.0
	 *
	 * @param string $template Template.
	 */
	public static function custom_template( $template ) {
		$demobar_options = get_option( 'demobar_options' );
		if ( isset( $demobar_options['demo_page'] ) && absint( $demobar_options['demo_page'] ) > 0 ) {
			if ( is_page( absint( $demobar_options['demo_page'] ) ) ) {
				$new_template = plugin_dir_path( DEMOBAR_PLUGIN_FILE ) . 'templates/switcher.php';
				if ( $new_template ) {
					return $new_template;
				}
			}
		}
		return $template;
	}

	/**
	 * Load front scripts.
	 *
	 * @since 1.0.0
	 */
	public static function front_scripts() {
		$demobar_options = get_option( 'demobar_options' );
		if ( isset( $demobar_options['demo_page'] ) && absint( $demobar_options['demo_page'] ) > 0 ) {
			if ( is_page( absint( $demobar_options['demo_page'] ) ) ) {
				wp_enqueue_style( 'demobar-fontawesome', DEMOBAR_PLUGIN_URL . '/third-party/font-awesome/css/font-awesome.min.css', '', '4.4' );
				wp_enqueue_style( 'demobar-style', DEMOBAR_PLUGIN_URL . '/css/front.css', '', '1.0.0' );
				wp_enqueue_script( 'demobar-script', DEMOBAR_PLUGIN_URL . '/js/front.js', array( 'jquery' ), '1.0.0' );
			}
		}
	}

	/**
	 * Fetch site list.
	 *
	 * @since 1.0.0
	 */
	public static function get_sites() {
		$output = array();
		$qargs = array(
			'post_type'      => 'dbsite',
			'no_found_rows'  => true,
			'posts_per_page' => -1,
		);
		$all_posts = get_posts( $qargs );
		if ( $all_posts ) {
			foreach ( $all_posts as $p ) {
				$item = array();
				$item['ID']           = $p->ID;
				$item['title']        = apply_filters( 'the_title', $p->post_title );
				$item['slug']         = $p->post_name;
				$item['site_url']     = get_post_meta( $p->ID, 'demo_bar_site_url', true );
				$item['download_url'] = get_post_meta( $p->ID, 'demo_bar_download_url', true );
				$output[ $p->ID ] = $item;
			}
		}
		return $output;
	}
}

DemoBar_Switcher::init();
