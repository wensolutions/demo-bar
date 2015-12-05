<?php
/**
 * Post Types Admin
 *
 * @package DemoBar/Admin/Classes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'DemoBar_Admin_Post_Types' ) ) :

/**
 * DemoBar_Admin_Post_Types Class.
 *
 * Handles the edit posts views and some functionality on the edit post screen for WC post types.
 */
class DemoBar_Admin_Post_Types {
	/**
	 * Constructor.
	 */
	public function __construct() {
		// Load Meta Box Class.
		require_once( 'class-demobar-admin-meta-boxes.php' );

		// Add Admin column.
		add_filter( 'manage_dbsite_posts_columns', array( $this, 'custom_column_head' ) );
		add_action( 'manage_dbsite_posts_custom_column', array( $this, 'custom_column_content' ), 10, 2 );

		// Hide publishing actions.
		add_action( 'admin_head-post.php', array( $this, 'hide_publishing_actions' ) );
		add_action( 'admin_head-post-new.php', array( $this, 'hide_publishing_actions' ) );

		// Customize Row actions.
		add_filter( 'post_row_actions', array( $this, 'customize_row_actions' ), 10, 2 );

		// Customize post updated messages.
		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );
	}

	/**
	 * Hide publishing actions.
	 *
	 * @since 1.0.0
	 */
	function hide_publishing_actions() {
		global $post;
		if ( 'dbsite' !== $post->post_type ) {
			return;
		}
		?>
		<style type="text/css">
			#misc-publishing-actions,#minor-publishing-actions{
				display:none;
			}
		</style>
		<?php
		return;
	}

	/**
	 * Customize column names.
	 *
	 * @since 1.0.0
	 *
	 * @param array $columns An array of column names.
	 */
	function custom_column_head( $columns ) {
		$new_columns['cb']           = '<input type="checkbox" />';
		$new_columns['title']        = $columns['title'];
		$new_columns['thumb']        = _x( 'Image', 'column name', 'demo-bar' );
		$new_columns['site_url']     = _x( 'Site URL', 'column name', 'demo-bar' );
		$new_columns['download_url'] = _x( 'Download URL',  'column name', 'demo-bar' );
		$new_columns['date']         = $columns['date'];
		return $new_columns;
	}
	/**
	 * Customize column content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $column_name The name of the column to display.
	 * @param int    $post_ID     The current post ID.
	 */
	function custom_column_content( $column_name, $post_ID ) {
		switch ( $column_name ) {
			case 'site_url':
				echo esc_url( get_post_meta( $post_ID, 'demo_bar_site_url', true ) );
				break;
			case 'download_url':
				echo esc_url( get_post_meta( $post_ID, 'demo_bar_download_url', true ) );
				break;
			case 'thumb':
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_ID ), 'thumbnail' );
				if ( ! empty( $image ) ) {
					echo '<a href="' . esc_url( get_edit_post_link( $post_ID ) ) . '">';
					echo '<img src="' . esc_url( $image[0] ) . '" width="50"/>';
					echo '</a>';
				}
				break;
			default:
				break;
		}
	}

	/**
	 * Customize row actions.
	 *
	 * @since 1.0.0
	 *
	 * @param array   $actions An array of row action links.
	 * @param WP_Post $post    The post object.
	 */
	function customize_row_actions( $actions, $post ) {
		if ( 'dbsite' === $post->post_type ) {
			unset( $actions['inline hide-if-no-js'] );
		}
		return $actions;
	}

	/**
	 * Customize post updated messages.
	 *
	 * @since 1.0.0
	 *
	 * @param array $messages Existing post update messages.
	 * @return array Amended post update messages with new CPT update messages.
	 */
	function updated_messages( $messages ) {

		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages['dbsite'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Site updated.', 'demo-bar' ),
			2  => __( 'Custom field updated.', 'demo-bar' ),
			3  => __( 'Custom field deleted.', 'demo-bar' ),
			4  => __( 'Site updated.', 'demo-bar' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Site restored to revision from %s', 'demo-bar' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Site published.', 'demo-bar' ),
			7  => __( 'Site saved.', 'demo-bar' ),
			8  => __( 'Site submitted.', 'demo-bar' ),
			9  => sprintf(
				__( 'Site scheduled for: <strong>%1$s</strong>.', 'demo-bar' ),
				// translators: Publish box date format, see http://php.net/date
				date_i18n( __( 'M j, Y @ G:i', 'demo-bar' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Site draft updated.', 'demo-bar' ),
		);

		return $messages;
	}
}
endif;

new DemoBar_Admin_Post_Types();
