<?php
/**
 * Class to test post types.
 * @package DemoBar\Tests\
 * @since 1.0.0
 */

class Tests_Post_Types extends WP_UnitTestCase {
	public function setUp() {
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * Test post type.
	 *
	 * @since 1.0.0
	 */
	public function test_dbsite_post_type() {
		global $wp_post_types;
		$this->assertArrayHasKey( 'dbsite', $wp_post_types );
	}
}
