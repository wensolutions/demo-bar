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
<?php
	function demo_bar_find_by_key( $products, $field, $value ) {
		foreach( $products as $key => $product ) {
			if ( $product[$field] === $value ){
				return $key;
			}
		}
		return false;
	}
?>
<?php
	$current_theme = '';
	$sites = DemoBar_Switcher::get_sites();
	$site_param = sanitize_key( $_REQUEST['theme'] );
	$valid_key = false;
	if ( ! empty( $sites ) ) {
		$valid_key = demo_bar_find_by_key( $sites, 'slug', $site_param );
		if ( false === $valid_key ) {
			$first_element = reset( $sites );
			$valid_key = $first_element['ID'];
		}
	}
	if ( false !== $valid_key ) {
		$current_theme = $valid_key;
	}
?>
<body>
	<div id="db-switcher">
		<a href="#"><?php _e( 'Select', 'demo-bar' ); ?></a>
		<?php if ( ! empty( $sites ) ) : ?>
			<?php foreach ( $sites as $site ) : ?>
				<a href="<?php echo esc_url( get_permalink() . '?theme='. esc_attr( $site['slug'] ) ); ?>"><?php echo esc_html( $site['title'] ); ?></a>
			<?php endforeach; ?>
		<?php endif ?>
		<a href="#" class="btn btn-close"><?php _e( 'Close', 'demo-bar' ); ?></a>
	</div>
	<iframe id="frame-area" src="<?php echo esc_url( $sites[$current_theme]['site_url'] ); ?>" frameborder="0" width="100%"></iframe>
</body>
</html>
