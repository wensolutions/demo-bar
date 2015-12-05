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
		add_settings_section( 'demobar_general_settings', __( 'General Settings', 'demo-bar' ) , array( $this, 'plugin_section_general_text_callback' ), 'demobar-general' );
		add_settings_field( 'demobar_field_logo', __( 'Logo', 'demo-bar' ), array( $this, 'demobar_field_logo_callback' ), 'demobar-general', 'demobar_general_settings' );
		add_settings_field( 'demobar_field_show_responsive_button', __( 'Show Responsive', 'demo-bar' ), array( $this, 'demobar_field_show_responsive_button_callback' ), 'demobar-general', 'demobar_general_settings' );
		add_settings_field( 'demobar_field_show_purchase_button', __( 'Show Purchase', 'demo-bar' ), array( $this, 'demobar_field_show_purchase_button_callback' ), 'demobar-general', 'demobar_general_settings' );
		add_settings_field( 'demobar_field_show_close_button', __( 'Show Close', 'demo-bar' ), array( $this, 'demobar_field_show_close_button_callback' ), 'demobar-general', 'demobar_general_settings' );

		// Page settings.
		add_settings_section( 'demobar_page_settings', __( 'Page Settings', 'demo-bar' ) , array( $this, 'plugin_section_page_text_callback' ), 'demobar-page' );
		add_settings_field( 'demobar_field_demo_page', __( 'Demo Page', 'demo-bar' ), array( $this, 'demobar_field_demo_page_callback' ), 'demobar-page', 'demobar_page_settings' );
		add_settings_field( 'demobar_field_page_meta_description', __( 'Meta Description', 'demo-bar' ), array( $this, 'demobar_field_page_meta_description_callback' ), 'demobar-page', 'demobar_page_settings' );
		add_settings_field( 'demobar_field_page_meta_keywords', __( 'Meta Keywords', 'demo-bar' ), array( $this, 'demobar_field_page_meta_keywords_callback' ), 'demobar-page', 'demobar_page_settings' );
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
		$input['demo_page']              = absint( $input['demo_page'] );
		$input['page_meta_description']  = wp_filter_nohtml_kses( $input['page_meta_description'] );
		$input['page_meta_keywords']     = wp_filter_nohtml_kses( $input['page_meta_keywords'] );
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
	 * Callback function to display heading in page section.
	 *
	 * @since 1.0.0
	 */
	function plugin_section_page_text_callback() {
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
		<p class="description"><?php esc_html_e( 'Enter full URL', 'demo-bar' ) ?></p><!-- .description -->
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

	/**
	 * Callback function for settings field - demo_page.
	 *
	 * @since 1.0.0
	 */
	function demobar_field_demo_page_callback() {
		$demo_page = '';
		if ( isset( $this->options['demo_page'] ) ) {
			$demo_page = $this->options['demo_page'];
		}
		wp_dropdown_pages(
			array(
				'selected' => $demo_page,
				'name'     => 'demobar_options[demo_page]',
			)
		);
	}

	/**
	 * Callback function for settings field - page_meta_description.
	 *
	 * @since 1.0.0
	 */
	function demobar_field_page_meta_description_callback() {
		$page_meta_description = '';
		if ( isset( $this->options['page_meta_description'] ) ) {
			$page_meta_description = $this->options['page_meta_description'];
		}
		?>
		<textarea name="demobar_options[page_meta_description]" rows="5" class="large-text"><?php echo esc_textarea( $page_meta_description ); ?></textarea>
		<?php
	}

	/**
	 * Callback function for settings field - page_meta_keywords.
	 *
	 * @since 1.0.0
	 */
	function demobar_field_page_meta_keywords_callback() {
		$page_meta_keywords = '';
		if ( isset( $this->options['page_meta_keywords'] ) ) {
			$page_meta_keywords = $this->options['page_meta_keywords'];
		}
		?>
		<textarea name="demobar_options[page_meta_keywords]" rows="5" class="large-text"><?php echo esc_textarea( $page_meta_keywords ); ?></textarea>
		<?php
	}
}

new DemoBar_Admin_Settings();
