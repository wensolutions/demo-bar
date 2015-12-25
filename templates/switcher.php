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
	<link rel="stylesheet" href="<?php echo esc_url( DEMOBAR_PLUGIN_URL ); ?>/third-party/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo esc_url( DEMOBAR_PLUGIN_URL ); ?>/css/front.css">
	<?php if ( isset( $demobar_options['background_color'] ) && ! empty( $demobar_options['background_color'] ) ) : ?>
		<style>#db-switcher{background-color:<?php echo esc_attr( $demobar_options['background_color'] ); ?>;}</style>
	<?php endif ?>
	<script src="<?php echo esc_url( site_url() ); ?>/wp-includes/js/jquery/jquery.js"></script>
	<script src="<?php echo esc_url( site_url() ); ?>/wp-includes/js/jquery/jquery-migrate.min.js"></script>
	<script src="<?php echo esc_url( DEMOBAR_PLUGIN_URL ); ?>/js/front.js"></script>
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
			<?php
			$selected = esc_html( 'Select', 'demo-bar' );
			$dropdown_list = '';
			?>
			<?php if ( ! empty( $sites ) ) : ?>
				<?php $dropdown_list .= '<ul>'; ?>
				<?php foreach ( $sites as $site ) : ?>
					<?php
						$link = add_query_arg(
							array(
								'demo' => esc_attr( $site['slug'] ),
							),
							get_permalink()
						);

						if ( isset( $_GET['demo'] ) && $_GET['demo'] === $site['slug'] ) {
							$selected = esc_html( $site['title'] );
						}

						$dropdown_list .= '<li>';
						$dropdown_list .= sprintf( '<a href="%s">%s</a>', esc_url( $link ), esc_html( $site['title'] ) );
						$dropdown_list .= '</li>';
					?>
				<?php endforeach; ?>
				<?php $dropdown_list .= '</ul>'; ?>
			<?php endif ?>

			<?php
			// Display select box dropdown.
			echo wp_kses_post( $selected . $dropdown_list ); ?>
			
		</div> <!-- #dropdown -->
		
		<?php if ( isset( $demobar_options['show_responsive_button'] ) && 1 === $demobar_options['show_responsive_button'] ) :  ?>
		<div id="responsive">
			<a title="<?php esc_html_e( 'Desktop', 'demo-bar' ); ?>" rel="resp-desktop" href="#" class="current"><i class="fa fa-desktop fa-lg"></i></a>
			<a title="<?php esc_html_e( 'Tablet Landscape (1024x768)', 'demo-bar' ); ?>" rel="resp-tablet-landscape" href="#"><i class="fa fa-tablet fa-rotate-270 fa-lg"></i></a>
			<a title="<?php esc_html_e( 'Tablet Portrait (768x1024)', 'demo-bar' ); ?>" rel="resp-tablet-portrait" href="#"><i class="fa fa-tablet fa-lg"></i></a>
			<a title="<?php esc_html_e( 'Mobile Landscape (480x320)', 'demo-bar' ); ?>" rel="resp-mobile-landscape" href="#"><i class="fa fa-mobile fa-rotate-270 fa-lg"></i></a>
			<a title="<?php esc_html_e( 'Mobile Portrait (320x480)', 'demo-bar' ); ?>" rel="resp-mobile-portrait" href="#"><i class="fa fa-mobile fa-lg"></i></a>
		</div>
		<?php endif; ?>
		
		<div id="buttons">
			<?php if ( isset( $sites[ $current_demo ]['download_url'] ) && ! empty( $sites[ $current_demo ]['download_url'] ) && true === $demobar_options['show_purchase_button'] ) : ?>
				<a href="<?php echo esc_url( $sites[ $current_demo ]['download_url'] ); ?>" class="btn btn-download"><?php esc_html_e( 'Download', 'demo-bar' ); ?></a>
			<?php endif ?>
			<?php if ( isset( $sites[ $current_demo ]['site_url'] ) && true === $demobar_options['show_close_button'] ) :  ?>
				<a href="<?php echo esc_url( $sites[ $current_demo ]['site_url'] ); ?>" class="btn btn-close"><i class="fa fa-close fa-lg"></i><?php esc_html_e( 'Close', 'demo-bar' ); ?></a>
			<?php endif ?>
		</div><!-- #buttons -->
	</div>
	<?php if ( isset( $sites[ $current_demo ]['site_url'] ) ) :  ?>
		<iframe id="frame-area" src="<?php echo esc_url( $sites[ $current_demo ]['site_url'] ); ?>" frameborder="0" width="100%"></iframe>
	<?php endif ?>
</body>
</html>
