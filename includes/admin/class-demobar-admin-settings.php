<?php
/**
 * DemoBar Settings
 *
 * @package DemoBar/Admin/Classes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * DemoBar_Admin_Settings.
 */
class DemoBar_Admin_Settings {

	/**
	 * Plugin options.
	 *
	 * @var array
	 * @since 1.0.0
	 */

	public $options = array();

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->options = get_option( 'demobar_options' );
		add_action( 'admin_menu', array( $this, 'setup_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Setup admin menu.
	 *
	 * @since 1.0.0
	 */
	function setup_menu() {

		add_submenu_page( 'edit.php?post_type=dbsite', __( 'Demo Bar Settings', 'demo-bar' ), __( 'Settings', 'demo-bar' ), 'manage_options', 'demo-bar', array( &$this, 'settings_page_init' ) );

	}

	/**
	 * Initialize admin settings page.
	 *
	 * @since 1.0.0
	 */
	function settings_page_init() {

		include( sprintf( '%s/templates/admin/admin-settings.php', DEMOBAR_PLUGIN_URI ) );

	}

	/**
	 * Register plugin settings.
	 *
	 * @since 1.0.0
	 */
	function register_settings() {

		register_setting( 'demobar-plugin-options-group', 'demobar_options', array( $this, 'validate_plugin_options' ) );

		// General settings.
		add_settings_section( 'demobar_general_settings', __( 'General', 'demo-bar' ) , array( $this, 'plugin_section_general_text_callback' ), 'demobar-general' );
		add_settings_field( 'demobar_field_logo', __( 'Logo', 'demo-bar' ), array( $this, 'demobar_field_logo_callback' ), 'demobar-general', 'demobar_general_settings' );
	}

	/**
	 * Validate plugin options.
	 *
	 * @since 1.0.0
	 *
	 * @param array $input Input options.
	 * @return array Validated options.
	 */
	function validate_plugin_options( $input ) {
		$input['logo'] = esc_url_raw( $input['logo'] );
		return $input;
	}


	/**
	 * Callback function to display heading in general section.
	 *
	 * @since 1.0.0
	 */
	function plugin_section_general_text_callback() {
		return;
	}

	/**
	 * Callback function for settings field - logo.
	 *
	 * @since 1.0.0
	 */
	function demobar_field_logo_callback() {
		$logo = '';
		if ( isset( $this->options['logo'] ) ) {
			$logo = $this->options['logo'];
		}
		?>
		<input type="text" name="demobar_options[logo]" value="<?php echo esc_url( $logo ); ?>" />
		<?php
	}
}

new DemoBar_Admin_Settings();
