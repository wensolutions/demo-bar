<?php
/**
 * Helper functions.
 *
 * @package DemoBar/Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function demobar_array_find_by_key( $products, $field, $value ) {
	foreach( $products as $key => $product ) {
		if ( $product[ $field ] === $value ){
			return $key;
		}
	}
	return false;
}
