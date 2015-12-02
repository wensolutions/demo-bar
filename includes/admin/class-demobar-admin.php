<?php
/**
 * WooCommerce Admin
 *
 * @class       DemoBar_Admin
 * @author      WooThemes
 * @category    Admin
 * @package     WooCommerce/Admin
 * @version     2.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * DemoBar_Admin class.
 */
class DemoBar_Admin {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
	}
	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		require_once( 'class-demobar-admin-post-types.php' );
	}

}

return new DemoBar_Admin();
