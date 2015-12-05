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
	$current_demo = '';
	$sites = DemoBar_Switcher::get_sites();
	$site_param = ( isset( $_REQUEST['demo'] ) ) ? sanitize_key( $_REQUEST['demo'] ) : '';
	$valid_key = false;
	if ( ! empty( $sites ) ) {
		$valid_key = demo_bar_find_by_key( $sites, 'slug', $site_param );
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
			<?php _e( 'Select', 'demo-bar' ); ?>
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
			<a href="<?php echo esc_url( $sites[$current_demo]['site_url'] ); ?>" class="btn btn-close"><?php _e( 'Close', 'demo-bar' ); ?></a>
		</div><!-- #buttons -->
	</div>
	<iframe id="frame-area" src="<?php echo esc_url( $sites[$current_demo]['site_url'] ); ?>" frameborder="0" width="100%"></iframe>
</body>
</html>
