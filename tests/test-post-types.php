<?php
/**
 * Test Post Types.
 *
 * @since 1.0
 * @package Demo_Bar_Tests
 */

/**
 * Class TestPostTypes.
 */
class TestPostTypes extends WP_UnitTestCase {

	/**
	 * Test dbsite post type
	 *
	 * @since 1.0
	 */
	function test_post_type_dbsite() {
		global $wp_post_types;
		$this->assertArrayHasKey( 'dbsite', $wp_post_types );
	}
}
