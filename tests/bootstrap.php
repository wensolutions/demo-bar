<?php
/**
 * Unit Tests Bootstrap.
 *
 * @since 1.0
 * @package Demo_Bar_Tests
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) { $_tests_dir = '/tmp/wordpress-tests-lib'; }

require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load plugin
 *
 * @since 1.0
 */
function _manually_load_plugin() {
	require dirname( __FILE__ ) . '/../demo-bar.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

require $_tests_dir . '/includes/bootstrap.php';

