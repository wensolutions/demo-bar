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
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'template_include', array( $this, 'custom_template' ), 99 );
	}

	/**
	 * Load custom template.
	 */
	public function custom_template() {
		if ( is_page( array( 2, 'sample-page' ) )  ) {
			$new_template = plugin_dir_path( DEMOBAR_PLUGIN_FILE ) . 'templates/switcher.php';
			if ( $new_template ) {
				return $new_template;
			}
		}
		return $template;
	}
}

new DemoBar_Switcher();
