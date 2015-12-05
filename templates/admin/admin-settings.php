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
				<form action="" method="post">
					<?php settings_fields( 'demobar-plugin-options-group' ); ?>
					<div class="meta-box-sortables ui-sortable">
						<div class="postbox">
							<div class="inside">
								<?php do_settings_sections( 'demo-bar-general' ); ?>
							</div> <!-- .inside -->
						</div> <!-- .postbox -->
					</div> <!-- .meta-box-sortables .ui-sortable -->
					<?php submit_button( __( 'Save Changes', 'demo-bar' ) ); ?>
				</form>
			</div><!-- #post-body-content -->

			<div id="postbox-container-1" class="postbox-container">
				<h3>Sidebar</h3>
			</div> <!-- #postbox-container-1 .postbox-container -->
		</div><!-- #post-body -->
	</div> <!-- #poststuff -->
</div> <!-- .wrap -->
