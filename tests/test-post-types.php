<?php

class TestPostTypes extends WP_UnitTestCase {

	function test_post_type_dbsite() {
		global $wp_post_types;
		$this->assertArrayHasKey( 'dbsite', $wp_post_types );
	}
}

