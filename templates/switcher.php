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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title><?php bloginfo( 'name' ); ?> - <?php the_title(); ?></title>
	<?php if ( isset( $demobar_options['page_meta_description'] ) && ! empty( $demobar_options['page_meta_description'] ) ) : ?>
	<meta name="description" content="<?php echo esc_attr( $demobar_options['page_meta_description'] ); ?>" >
	<?php endif ?>
	<?php if ( isset( $demobar_options['page_meta_keywords'] ) && ! empty( $demobar_options['page_meta_keywords'] ) ) : ?>
	<meta name="keywords" content="<?php echo esc_attr( $demobar_options['page_meta_keywords'] ); ?>" >
	<?php endif ?>
	<link rel="stylesheet" href="<?php echo DEMOBAR_PLUGIN_URL; ?>/third-party/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo DEMOBAR_PLUGIN_URL; ?>/css/front.css">
	<?php if ( isset( $demobar_options['background_color'] ) && ! empty( $demobar_options['background_color'] ) ) : ?>
		<style>#db-switcher{background-color:<?php echo esc_attr( $demobar_options['background_color'] ); ?>;}</style>
	<?php endif ?>
	<?php if ( isset( $demobar_options['custom_css'] ) && ! empty( $demobar_options['custom_css'] ) ) : ?>
		<style><?php echo esc_textarea( $demobar_options['custom_css'] ); ?></style>
	<?php endif ?>

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
		<?php if ( isset( $demobar_options['logo'] ) && ! empty( $demobar_options['logo'] ) ) : ?>
			<div id="branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $demobar_options['logo'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
			</div><!-- #branding -->
		<?php endif ?>
		<div id="dropdown">
			<?php esc_html_e( 'Select', 'demo-bar' ); ?>
			<?php if ( ! empty( $sites ) ) : ?>
				<ul>
				<?php foreach ( $sites as $site ) : ?>
					<?php
						$link = add_query_arg(
							array(
								'demo' => esc_attr( $site['slug'] ),
							),
							get_permalink()
						);
					?>
					<li>
						<a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $site['title'] ); ?></a>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php endif ?>
		</div> <!-- #dropdown -->
		<div id="responsive">
			<a title="View Desktop Version" rel="resp-desktop" href="#"><i class="fa fa-desktop fa-lg"></i></a>
			<a title="View Tablet Landscape (1024x768)" rel="resp-tablet-landscape" href="#"><i class="fa fa-tablet fa-rotate-90 fa-lg"></i></a>
			<a title="View Tablet Portrait (768x1024)" rel="resp-tablet-portrait" href="#"><i class="fa fa-tablet fa-lg"></i></a>
			<a title="View Mobile Landscape (480x320)" rel="resp-mobile-landscape" href="#"><i class="fa fa-mobile fa-rotate-90 fa-lg"></i></a>
			<a title="View Mobile Portrait (320x480)" rel="resp-mobile-portrait" href="#"><i class="fa fa-mobile fa-lg"></i></a>
		</div>
		<div id="buttons">
			<?php if ( isset( $sites[ $current_demo ]['download_url'] ) && ! empty( $sites[ $current_demo ]['download_url'] ) && true === $demobar_options['show_purchase_button'] ) : ?>
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
