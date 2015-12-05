<?php
/**
 * Admin settings.
 *
 * @package DemoBar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">
	<h1><?php _e( 'Demo Bar', 'demo-bar' ); ?></h1>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">
				<form action="options.php" method="post">
					<?php settings_fields( 'demobar-plugin-options-group' ); ?>
					<div class="meta-box-sortables ui-sortable">
						<div class="postbox">
							<div class="inside">
								<?php do_settings_sections( 'demobar-general' ); ?>
							</div> <!-- .inside -->
						</div> <!-- .postbox -->
					</div> <!-- .meta-box-sortables .ui-sortable -->
					<div class="meta-box-sortables ui-sortable">
						<div class="postbox">
							<div class="inside">
								<?php do_settings_sections( 'demobar-page' ); ?>
							</div> <!-- .inside -->
						</div> <!-- .postbox -->
					</div> <!-- .meta-box-sortables .ui-sortable -->
					<?php submit_button( __( 'Save Changes', 'demo-bar' ) ); ?>
				</form>
			</div><!-- #post-body-content -->

			<div id="postbox-container-1" class="postbox-container">
				<?php
					include( DEMOBAR_PLUGIN_URI . '/templates/admin/admin-sidebar.php' );
				 ?>
			</div> <!-- #postbox-container-1 .postbox-container -->
		</div><!-- #post-body -->
	</div> <!-- #poststuff -->
</div> <!-- .wrap -->
