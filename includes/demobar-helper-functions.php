<?php
/**
 * Helper functions.
 *
 * @package DemoBar/Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Find by key in multi-dimensional array.
 *
 * @since 1.0.0
 *
 * @param array  $array Main array.
 * @param string $field Field key.
 * @param string $value Value to compare.
 * @return string|int|bool If found return matched ID, else return FALSE.
 */
function demobar_array_find_by_key( $array, $field, $value ) {
	foreach ( $array as $key => $product ) {
		if ( $product[ $field ] === $value ) {
			return $key;
		}
	}
	return false;
}
