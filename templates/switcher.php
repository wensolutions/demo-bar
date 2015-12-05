<?php
/**
 * Switcher template
 *
 * @package DemoBar
 */

$demobar_options = get_option( 'demobar_options' );
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
<?php
	$current_demo = '';
	$sites = DemoBar_Switcher::get_sites();
	$site_param = ( isset( $_REQUEST['demo'] ) ) ? sanitize_key( $_REQUEST['demo'] ) : '';
	$valid_key = false;
if ( ! empty( $sites ) ) {
	$valid_key = demobar_array_find_by_key( $sites, 'slug', $site_param );
	if ( false === $valid_key ) {
		$first_element = reset( $sites );
		$valid_key = $first_element['ID'];
	}
}
if ( false !== $valid_key ) {
	$current_demo = $valid_key;
}
?>
<body>
	<div id="db-switcher">
		<div id="dropdown">
			<?php esc_html_e( 'Select', 'demo-bar' ); ?>
			<?php if ( ! empty( $sites ) ) : ?>
				<ul>
				<?php foreach ( $sites as $site ) : ?>
					<li>
						<a href="<?php echo esc_url( get_permalink() . '?demo='. esc_attr( $site['slug'] ) ); ?>"><?php echo esc_html( $site['title'] ); ?></a>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php endif ?>
		</div> <!-- #dropdown -->
		<div id="buttons">
			<?php if ( isset( $sites[ $current_demo ]['download_url'] ) && ! empty( $sites[ $current_demo ]['download_url'] ) && true === $demobar_options['show_purchase_button']) : ?>
				<a href="<?php echo esc_url( $sites[ $current_demo ]['download_url'] ); ?>" class="btn btn-download"><?php esc_html_e( 'Download', 'demo-bar' ); ?></a>
			<?php endif ?>
			<?php if ( isset( $sites[ $current_demo ]['site_url'] ) && true === $demobar_options['show_close_button'] ) :  ?>
				<a href="<?php echo esc_url( $sites[ $current_demo ]['site_url'] ); ?>" class="btn btn-close"><?php esc_html_e( 'Close', 'demo-bar' ); ?></a>
			<?php endif ?>
		</div><!-- #buttons -->
	</div>
	<?php if ( isset( $sites[ $current_demo ]['site_url'] ) ) :  ?>
		<iframe id="frame-area" src="<?php echo esc_url( $sites[ $current_demo ]['site_url'] ); ?>" frameborder="0" width="100%"></iframe>
	<?php endif ?>
</body>
</html>
