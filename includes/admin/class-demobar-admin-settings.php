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
		add_settings_field( 'demobar_field_show_responsive_button', __( 'Show Responsive', 'demo-bar' ), array( $this, 'demobar_field_show_responsive_button_callback' ), 'demobar-general', 'demobar_general_settings' );
		add_settings_field( 'demobar_field_show_purchase_button', __( 'Show Purchase', 'demo-bar' ), array( $this, 'demobar_field_show_purchase_button_callback' ), 'demobar-general', 'demobar_general_settings' );
		add_settings_field( 'demobar_field_show_close_button', __( 'Show Close', 'demo-bar' ), array( $this, 'demobar_field_show_close_button_callback' ), 'demobar-general', 'demobar_general_settings' );
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
		$input['logo']                   = esc_url_raw( $input['logo'] );
		$input['show_responsive_button'] = isset( $input['show_responsive_button'] ) ? true : false;
		$input['show_purchase_button']   = isset( $input['show_purchase_button'] ) ? true : false;
		$input['show_close_button']      = isset( $input['show_close_button'] ) ? true : false;
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

	/**
	 * Callback function for settings field - show_responsive_button.
	 *
	 * @since 1.0.0
	 */
	function demobar_field_show_responsive_button_callback() {
		$show_responsive_button = '';
		if ( isset( $this->options['show_responsive_button'] ) ) {
			$show_responsive_button = $this->options['show_responsive_button'];
		}
		?>
		<input type="checkbox" name="demobar_options[show_responsive_button]" <?php checked( $show_responsive_button, true ); ?>/>
		<?php
	}

	/**
	 * Callback function for settings field - show_purchase_button.
	 *
	 * @since 1.0.0
	 */
	function demobar_field_show_purchase_button_callback() {
		$show_purchase_button = '';
		if ( isset( $this->options['show_purchase_button'] ) ) {
			$show_purchase_button = $this->options['show_purchase_button'];
		}
		?>
		<input type="checkbox" name="demobar_options[show_purchase_button]" <?php checked( $show_purchase_button, true ); ?>/>
		<?php
	}

	/**
	 * Callback function for settings field - show_close_button.
	 *
	 * @since 1.0.0
	 */
	function demobar_field_show_close_button_callback() {
		$show_close_button = '';
		if ( isset( $this->options['show_close_button'] ) ) {
			$show_close_button = $this->options['show_close_button'];
		}
		?>
		<input type="checkbox" name="demobar_options[show_close_button]" <?php checked( $show_close_button, true ); ?>/>
		<?php
	}
}

new DemoBar_Admin_Settings();
