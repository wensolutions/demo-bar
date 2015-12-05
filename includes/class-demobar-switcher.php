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
