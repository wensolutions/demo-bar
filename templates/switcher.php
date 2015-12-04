<?php
/**
 * Switcher template
 *
 * @package DemoBar
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php bloginfo( 'name' ); ?> - <?php the_title(); ?></title>
	<link rel="stylesheet" href="<?php echo DEMOBAR_PLUGIN_URL; ?>/css/front.css">
	<script src="<?php echo esc_url( site_url() ); ?>/wp-includes/js/jquery/jquery.js"></script>
	<script src="<?php echo esc_url( site_url() ); ?>/wp-includes/js/jquery/jquery-migrate.min.js"></script>
	<script src="<?php echo DEMOBAR_PLUGIN_URL; ?>/js/front.js"></script>
</head>
<body>
	<div id="db-switcher">
		<a href="#"><?php _e( 'Select', 'demo-bar' ); ?></a>
		<a href="#" class="btn btn-close"><?php _e( 'Close', 'demo-bar' ); ?></a>
	</div>
</body>
</html>
