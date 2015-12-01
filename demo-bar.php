<?php
/**
 * Plugin Name: Demo Bar
 * Plugin URI: https://github.com/ernilambar/demo-bar
 * Description: This plugin helps to add demo bar for displaying your different theme demos.
 * Version: 1.0.0
 * Author: Nilambar Sharma
 * Author URI: http://www.nilambar.net
 * Requires at least: 4.1
 * Tested up to: 4.4
 * Text Domain: demo-bar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Demo_Bar' ) ) {

	/**
	 * Main Class.
	 */
	class Demo_Bar {

		var $demo_bar_options;

		function __construct() {
		}
	}
}

$demo_bar_obj = new Demo_Bar();